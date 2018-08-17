<?php

namespace Quiz\Tests;

use Mockery;
use PHPUnit\Framework\TestCase;
use Quiz\Models\QuestionModel;
use Quiz\Models\QuizAnswerModel;
use Quiz\Models\QuizModel;
use Quiz\Repositories\QuizAnswerRepository;
use Quiz\Repositories\QuizRepository;

class QuizRepositoryTest extends TestCase
{
    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }
//    public function test_withRightData_insertsUser()
//    {
//        $email = 'foo@bar.lv';
//        $password = 'super secret';
//
//        $repo = \Mockery::mock(new UserRepository());
//        $repo->shouldReceive('addUser')->with($email, $password)->once()->andReturn(3);
//        $service = new UserRegistrationService($repo);
//        $id = $service->registerUser($email, $password);
//
//        $this->assertEquals(3, $id);
//
//    }

    public function testSearchQuizById()
    {
        $abc = new QuizRepository;
        $repo = Mockery::mock(new QuizRepository());
        $model       = new QuizModel;
        $model->id   = '1';
        $model->name = 'Cats';
//        $repo->shouldReceive('addQuiz')->with($model)->once()->andReturn(2);
        $repo->shouldReceive('addQuiz')->with($model);


        $tests = $abc->getById($model->id);

        self::assertEquals($model, $tests);

    }

//    public function testGetAnswers()
//    {
//        $repo              = new QuizAnswerRepository();
//        $model             = new QuizAnswerModel;
//        $model->id         = '1';
//        $model->answer     = 'Cats';
//        $model->questionId = '2';
//        $model->isCorrect  = '1';
//        $repo->save($model);
//        $getAnswers = $repo->getQuizAnswers($model->questionId);
//        $answer     = array_shift($getAnswers);
//        self::assertEquals($model, $answer);
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
//        $model       = new QuizModel;
//        $model->id   = '1';
//        $model->name = 'Cats';
//        $repo->addQuiz($model);
//        $getQuiz = $repo->getList();
//        $getQuiz = array_shift($getQuiz);
//
//        self::assertEquals($model->name, $getQuiz);
//    }
}
