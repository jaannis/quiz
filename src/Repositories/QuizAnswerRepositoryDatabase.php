<?php

namespace Quiz\Repositories;

use Quiz\Models\QuizAnswerModel;

class QuizAnswerRepositoryDatabase extends BaseRepository
{
    public static function modelName(): string

    {
        return QuizAnswerModel::class;
    }

    public static function getTableName(): string
    {
        return 'answers';
    }
}