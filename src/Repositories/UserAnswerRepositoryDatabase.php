<?php

namespace Quiz\Repositories;

use Quiz\Models\UserAnswerModel;

class UserAnswerRepositoryDatabase extends BaseRepository
{

    public static function modelName(): string
    {
        return UserAnswerModel::class;
    }

    public static function getTableName(): string
    {
        return 'user_answers';
    }
}