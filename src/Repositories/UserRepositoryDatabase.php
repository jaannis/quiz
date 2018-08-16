<?php

namespace Quiz\Repositories;

use Quiz\Models\UserModel;

class UserRepositoryDatabase extends BaseRepository
{
    public static function modelName(): string
    {
        return UserModel::class;
    }

    public static function getTableName(): string
    {
        return 'users';
    }

}
