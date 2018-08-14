<?php

namespace Quiz\Tests;

use PHPUnit\Framework\TestCase;
use Quiz\Models\UserAnswerModel;
use Quiz\Models\UserModel;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserAnswerRepository;
use Quiz\Repositories\UserRepository;

class UserAnswerRepositoryTest extends TestCase
{

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
}
