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

    public function saveUser($name)
    {
        $savedUser = $this->save($name);

        return $savedUser;
    }

}
