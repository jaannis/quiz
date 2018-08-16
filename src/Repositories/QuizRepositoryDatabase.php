<?php

namespace Quiz\Repositories;

use Quiz\Models\QuizModel;

class QuizRepositoryDatabase extends BaseRepository
{
    public static function modelName(): string
    {
        return QuizModel::class;
    }

    public static function getTableName(): string
    {
        return 'quizes';
    }
}