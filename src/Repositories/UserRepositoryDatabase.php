<?php

namespace Quiz\Repositories;

use Quiz\Models\BaseModel;
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

    public function saveOrCreate(UserModel $user)
    {
        $table        = static::getTableName();
//        $user         = new UserModel;
//        $name         = $user->name = 'Martins';
//        $id           = $user->id;
        $primaryKey   = 'id';
        $existingUser = $this->connection->insert($table, $primaryKey, ['id' => $user->id, 'name' => $user->name]);

        return $existingUser;
    }

    public function getById(int $id, array $select = [])
    {
        $table = static::getTableName();
        $data  = $this->connection->select($table, ['id' => $id], $select);

        return $data;
    }

}
