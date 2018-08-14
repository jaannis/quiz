<?php

namespace Quiz\Tests;

use PHPUnit\Framework\TestCase;
use Quiz\Models\QuestionModel;
use Quiz\Models\QuizAnswerModel;
use Quiz\Models\QuizModel;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserAnswerRepository;
use Quiz\Repositories\UserRepository;
use Quiz\Service\QuizService;

class QuizServiceTest extends TestCase
{

//    public function testSearchQuizById()
//    {
//        $repo        = new QuizRepository;
//        $model       = new QuizModel;
//        $model->id   = '1';
//        $model->name = 'Cats';
//        $repo->addQuiz($model);
//        $tests = $repo->getById($model->id);
//
//        self::assertEquals($model, $tests);
//
//    }

//    public function testGetAnswers()
//    {
//        $repo              = new QuizRepository;
//        $model             = new QuizAnswerModel;
//        $model->id         = '1';
//        $model->answer     = 'Cats';
//        $model->questionId = '2';
//        $model->isCorrect  = '1';
//        $repo->addAnswers($model);
//        $getAnswers = $repo->getAnswers($model->questionId);
//        $getAnswers = array_shift($getAnswers);
//        var_dump($model, $getAnswers);
//
//        self::assertEquals($model, $getAnswers);
//
//    }

//    public function testGetQuestions()
//    {
//        $repo            = new QuizRepository;
//        $model           = new QuestionModel;
//        $model->id       = '1';
//        $model->quizId   = '1';
//        $model->question = 'Sup';
//        $repo->addQuestion($model);
//        $getQuestions = $repo->getQuestions($model->quizId);
//        $getQuestions = array_shift($getQuestions);
//
//        self::assertEquals($model, $getQuestions);
//
//    }

//    public function testGetList()
//    {
//        $repo        = new QuizRepository;
//        $function    = new QuizService;
//        $model       = new QuizModel;
//        $model->id   = '1';
//        $model->name = 'Cats';
//        $repo->addQuiz($model);
//        $getQuiz = $function->getQuizes();
//        $getQuiz = array_shift($getQuiz);
//        var_dump($getQuiz,$model);
//
//        self::assertEquals($model->name, $getQuiz);
//    }
    public function getQuizTest()
    {
        $userAnswerRepo = new UserAnswerRepository;
        $userRepo       = new UserRepository;
        $quizRepo       = new QuizRepository;

        $service = new QuizService($quizRepo, $userRepo, $userAnswerRepo);

        // Add a quiz model to repositoru
        $quiz = new QuizModel; // TODO set multiple properties
        $quizRepo->addQuiz($quiz);

        // Check if service returns the quiz
        $quizes = $service->getQuizes();

        self::assertCount(1, $quizes);
    }

    public function registerUserTest()
    {

    }

    public function getQuestionsTest()
    {
        $userAnswerRepo = new UserAnswerRepository;
        $userRepo       = new UserRepository;
        $quizRepo       = new QuizRepository;

        $service = new QuizService($quizRepo, $userRepo, $userAnswerRepo);

        $questions = new QuestionModel;
        $questions->id       = '1';
        $questions->quizId   = '1';
        $questions->question = 'Sup';
        $quizRepo->addQuestion($questions);

        $questions = $service->getQuestions($questions->quizId);

        var_dump($questions);
        self::assertCount(1, $questions);


    }

}
