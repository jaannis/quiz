<?php

namespace Quiz\Tests;

use PHPUnit\Framework\TestCase;
use Quiz\Models\QuestionModel;
use Quiz\Models\QuizAnswerModel;
use Quiz\Models\QuizModel;
use Quiz\Models\UserAnswerModel;
use Quiz\Models\UserModel;
use Quiz\Repositories\QuestionRepositoryDatabase;
use Quiz\Repositories\QuizAnswerRepositoryDatabase;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\QuizRepositoryDatabase;
use Quiz\Repositories\UserAnswerRepositoryDatabase;
use Quiz\Repositories\UserRepositoryDatabase;
use Quiz\Service\QuizService;

class QuizServiceTest extends TestCase
{
    public $questionsRepo;
    public $usersRepo;
    public $userAnswersRepo;
    public $quizAnswersRepo;
    public $quizRepo;
    public $serviceRepo;

    public function setUp()
    {
        parent::setUp();

        $this->questionsRepo   = new QuestionRepositoryDatabase;
        $this->usersRepo       = new UserRepositoryDatabase;
        $this->userAnswersRepo = new UserAnswerRepositoryDatabase;
        $this->quizAnswersRepo = new QuizAnswerRepositoryDatabase;
        $this->quizRepo        = new QuizRepositoryDatabase;

        $this->serviceRepo = new QuizService(
            $this->questionsRepo,
            $this->usersRepo,
            $this->userAnswersRepo,
            $this->quizAnswersRepo,
            $this->quizRepo
        );
    }

    public function testGetQuiz()
    {

        $quiz = new QuizModel;
        $quizRepo->addQuiz($quiz);

        // Check if service returns the quiz
        $quizes = $this->serviceRepo->getList();
        self::assertCount(1, $quizes);
    }

    public function testRegisterUser()
    {
        $userAnswerRepo = new UserAnswerRepository;
        $userRepo       = new UserRepository;
        $quizRepo       = new QuizRepository;

        $service = new QuizService($quizRepo, $userRepo, $userAnswerRepo);

        $model       = new UserModel;
        $model->name = 'janis';
        $service->registerUser($model->name);

        $getAll = $userRepo->getAll();
        self::assertCount(1, $getAll);
    }

    public function testIsExistingUser()
    {
        $userAnswerRepo = new UserAnswerRepository;
        $userRepo       = new UserRepository;
        $quizRepo       = new QuizRepository;

        $service = new QuizService($quizRepo, $userRepo, $userAnswerRepo);

        $model       = new UserModel;
        $model->id   = '1';
        $model->name = 'janis';
        $trueOrFalse = $service->isExistingUser($model->id);

//        $getAll = $userRepo->getAll();
        self::assertTrue($trueOrFalse);

    }

    public function testGetQuestions()
    {
//        $userAnswerRepo = new UserAnswerRepository;
//        $userRepo       = new UserRepository;
//        $quizRepo       = new QuizRepository;
//
//        $service = new QuizService($quizRepo, $userRepo, $userAnswerRepo);

        $model           = new QuestionModel;
        $model->id       = '1';
        $model->quizId   = '1';
        $model->question = 'Sup';
        $quizRepo->addQuestion($model);

        $getAll = $this->serviceRepo->getQuestions($model->quizId);
        self::assertCount(1, $getAll);

    }

    public function testGetAnswers()
    {
        $userAnswerRepo = new UserAnswerRepository;
        $userRepo       = new UserRepository;
        $quizRepo       = new QuizRepository;

        $service           = new QuizService($quizRepo, $userRepo, $userAnswerRepo);
        $model             = new QuizAnswerModel();
        $model->id         = '1';
        $model->answer     = 'Cats';
        $model->questionId = '2';
        $model->isCorrect  = '1';
        $quizRepo->addAnswers($model);
        $getAnswers = $service->getAnswers($model->questionId);
        $getAnswers = array_shift($getAnswers);
        self::assertEquals($model, $getAnswers);
    }

    public function testSubmitAnswer()
    {
        $userAnswerRepo = new UserAnswerRepository;
        $userRepo       = new UserRepository;
        $quizRepo       = new QuizRepository;

        $service          = new QuizService($quizRepo, $userRepo, $userAnswerRepo);
        $answer           = new UserAnswerModel;
        $answer->id       = '1';
        $answer->userId   = '123';
        $answer->quizId   = '1';
        $answer->answerId = '1';

        $saveAnswer = $service->submitAnswer($answer);
        $getAnswers = $userAnswerRepo->getAnswers($answer->userId, $answer->quizId);
        $getAnswers = array_shift($getAnswers);
        self::assertEquals($saveAnswer, $getAnswers);
    }

    public function testIsQuizCompleted()
    {
        $userAnswerRepo = new UserAnswerRepository;
        $userRepo       = new UserRepository;
        $quizRepo       = new QuizRepository;

        $service          = new QuizService($quizRepo, $userRepo, $userAnswerRepo);
        $answer           = new UserAnswerModel;
        $answer->id       = '1';
        $answer->userId   = '123';
        $answer->quizId   = '1';
        $answer->answerId = '1';
        $userAnswerRepo->saveAnswer($answer);

        $model           = new QuestionModel();
        $model->id       = '1';
        $model->quizId   = '1';
        $model->question = '2';
        $quizRepo->addQuestion($model);

        $trueOrFalse = $service->isQuizCompleted($answer->userId, $answer->quizId);
        self::assertTrue($trueOrFalse);

    }

    public function testGetScore()
    {
        $userAnswerRepo = new UserAnswerRepository;
        $userRepo       = new UserRepository;
        $quizRepo       = new QuizRepository;

        $service            = new QuizService($quizRepo, $userRepo, $userAnswerRepo);
        $answer             = new UserAnswerModel;
        $answer->id         = '1';
        $answer->userId     = '123';
        $answer->quizId     = '1';
        $answer->answerId   = '1';
        $answer->questionId = '2';
        $userAnswerRepo->saveAnswer($answer);

        $model             = new QuizAnswerModel();
        $model->id         = '1';
        $model->answer     = 'Cats';
        $model->questionId = '2';
        $model->isCorrect  = 'true';
        $quizRepo->addAnswers($model);

        $results = $service->getScore($answer->userId, $answer->quizId);
//        var_dump($results);
//        die;

        self::assertEquals('1', $results);

    }

}
