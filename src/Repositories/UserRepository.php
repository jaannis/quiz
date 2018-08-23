<?php

namespace Quiz\Repositories;

use Quiz\Models\UserModel;

class UserRepository extends BaseRepository
{
    /**
     * @return string
     */
    public static function modelName(): string
    {
        return UserModel::class;
    }

    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return 'users';
    }

    /**
     * @param $name
     * @return string
     */
    public function saveUser($name)
    {
        $savedUser = $this->save($name);

        return $savedUser;
    }

}
