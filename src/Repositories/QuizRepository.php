<?php

namespace Quiz\Repositories;

use Quiz\Models\QuizModel;

class QuizRepository extends BaseRepository
{
    public static function modelName(): string
    {
        return QuizModel::class;
    }

    public static function getTableName(): string
    {
        return 'quizzes';
    }

    public function addQuiz(QuizModel $quiz)
    {
        return $this->save($quiz);
    }

}