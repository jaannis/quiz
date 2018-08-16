<?php

namespace Quiz\Tests;

use Mockery;
use PHPUnit\Framework\TestCase;
use Quiz\Models\UserAnswerModel;
use Quiz\Models\UserModel;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserAnswerRepository;
use Quiz\Repositories\UserAnswerRepositoryDatabase;
use Quiz\Repositories\UserRepository;
use Quiz\Service\QuizService;

class UserAnswerRepositoryTest extends TestCase
{
    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }

//    public function test_withRightData_insertsUser()
//    {
//        $email    = 'foo@bar.lv';
//        $password = 'super secret';
//
//        $repo = Mockery::mock(new UserRepository());
//        $repo->shouldReceive('addUser')->with($email, $password)->once()->andReturn(3);
//        $service = new UserRegistrationService($repo);
//        $id      = $service->registerUser($email, $password);
//
//        $this->assertEquals(3, $id);
//
//    }

    public function testAnswers()
    {
        $answer           = new UserAnswerModel;
        $answer->id       = '1';
        $answer->userId   = '123';
        $answer->quizId   = '1';
        $answer->answerId = '1';

        $repo = Mockery::mock(new UserAnswerRepositoryDatabase());
        $repo->shouldReceive('addModel')->with($answer);
        $service = new UserAnswerRepositoryDatabase();
        $saveAnswer = $service->addModel($answer);

        $getAnswers = $service->getAnswers('123', '1');
        $getAnswers = array_shift($getAnswers);
        self::assertEquals($saveAnswer, $getAnswers);

    }
}
