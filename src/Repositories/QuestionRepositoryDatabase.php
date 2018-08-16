<?php

namespace Quiz\Repositories;

use Quiz\Models\QuestionModel;

class QuestionRepositoryDatabase extends BaseRepository
{
    public static function modelName(): string
    {
        return QuestionModel::class;
    }

    public static function getTableName(): string
    {
        return 'questions';
    }
}
