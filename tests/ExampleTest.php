<?php

namespace Quiz\Tests;

use Quiz\Models\QuizModel;
use Quiz\Models\UserAnswerModel;
use Quiz\Models\UserModel;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserAnswerRepository;
use Quiz\Repositories\UserRepository;

class ExampleTest extends \PHPUnit\Framework\TestCase
{
    public function testTrue()
    {
        self::assertTrue(true);
    }

    public function testUserCreation()
    {
        $repo        = new UserRepository;
        $user        = new UserModel;
        $user->name  = "Martins";
        $userCreated = $repo->saveOrCreate($user);
        self::assertFalse($userCreated->isNew(), 'User is not new');
        self::assertEquals($user->name, $userCreated->name, 'Names match');
    }

    public function testNameEdit()
    {
        $repo            = new UserRepository;
        $user            = new UserModel;
        $user->name      = 'Martins';
        $savedUser       = $repo->saveOrCreate($user);
        $savedUser->name = 'Janis';
        $editedUser      = $repo->saveOrCreate($savedUser);

        self::assertEquals($savedUser->name, $editedUser->name, 'Name is saved');
        self::assertEquals($savedUser->id, $editedUser->id, 'Same id');
    }

    public function testAnswers()
    {
        $repo = new UserAnswerRepository;

        $answer           = new UserAnswerModel;
        $answer->id       = '1';
        $answer->userId   = '123';
        $answer->quizId   = '1';
        $answer->answerId = '1';

        $saveAnswer = $repo->saveAnswer($answer);
        $getAnswers = $repo->getAnswers('123', '1');
        $getAnswers = array_shift($getAnswers);
        self::assertEquals($saveAnswer, $getAnswers);

    }

    public function testGetAllUsersAndSearchById()
    {
        $repo       = new UserRepository;
        $user       = new UserModel;
        $user->name = 'Martins';
        $save       = $repo->saveOrCreate($user);
        $user->name = 'Janis';
        $save       = $repo->saveOrCreate($user);
        $getAll     = $repo->getAll();

        $searchByIdUser = $repo->getById('1');

        self::assertNotEmpty($getAll);
        self::assertEquals($searchByIdUser->id, '1');
        self::assertEquals($searchByIdUser->name, 'Martins');

    }

    public function testGetQuizById()
    {
        $repo = new QuizRepository;
//        $repo->id = '1';
//        $repo->name = 'Cats';

        $data        = [
            [
                'id'   => '1',
                'name' => 'Cats',
            ],
            [
                'id'   => '2',
                'name' => 'Dogs',
            ],
        ];
        $correctQuiz = $repo->getlist();
        var_dump($correctQuiz);
        self::assertEquals($correctQuiz->id, '1');

    }
}
