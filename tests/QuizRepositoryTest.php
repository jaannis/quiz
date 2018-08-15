<?php

namespace Quiz\Tests;

use PHPUnit\Framework\TestCase;
use Quiz\Models\QuestionModel;
use Quiz\Models\QuizAnswerModel;
use Quiz\Models\QuizModel;
use Quiz\Repositories\QuizRepository;

class QuizRepositoryTest extends TestCase
{

    public function testSearchQuizById()
    {
        $repo        = new QuizRepository;
        $model       = new QuizModel;
        $model->id   = '1';
        $model->name = 'Cats';
        $repo->addQuiz($model);
        $tests = $repo->getById($model->id);

        self::assertEquals($model, $tests);

    }

    public function testGetAnswers()
    {
        $repo              = new QuizRepository;
        $model             = new QuizAnswerModel;
        $model->id         = '1';
        $model->answer     = 'Cats';
        $model->questionId = '2';
        $model->isCorrect  = '1';
        $repo->addAnswers($model);
        $getAnswers = $repo->getAnswers($model->questionId);
        $answer     = array_shift($getAnswers);
        self::assertEquals($model, $answer);

    }

    public function testGetQuestions()
    {
        $repo            = new QuizRepository;
        $model           = new QuestionModel;
        $model->id       = '1';
        $model->quizId   = '1';
        $model->question = 'Sup';
        $repo->addQuestion($model);
        $getQuestions = $repo->getQuestions($model->quizId);
        $getQuestions = array_shift($getQuestions);

        self::assertEquals($model, $getQuestions);

    }

    public function testGetList()
    {
        $repo        = new QuizRepository;
        $model       = new QuizModel;
        $model->id   = '1';
        $model->name = 'Cats';
        $repo->addQuiz($model);
        $getQuiz = $repo->getList();
        $getQuiz = array_shift($getQuiz);

        self::assertEquals($model->name, $getQuiz);
    }
}
