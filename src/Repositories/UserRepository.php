<?php

namespace Quiz\Repositories;

use Quiz\Models\UserModel;

class UserRepository extends BaseRepository
{
    public static function modelName(): string
    {
        return UserModel::class;
    }

    public static function getTableName(): string
    {
        return 'users';
    }

    public function saveOrCreate($user)
    {
        $existingUser = $this->save($user);

        return $existingUser;
    }

}
