<?php

namespace Quiz\Repositories;

use Quiz\Models\UserModel;

class UserRepository
{
    /**@var \Quiz\Models\UserModel[] */
    private $users = [];
    private $idCounter = 0;

    /**
     * @param UserModel $user
     * @return UserModel
     */
    public function saveOrCreate(UserModel $user): UserModel
    {
        $existingUser = $this->getById($user->id);
        if ($existingUser->isNew()) {
            $this->idCounter  += 1;
            $existingUser->id = $this->idCounter;
        };
        $existingUser->name             = $user->name;
        $this->users[$existingUser->id] = $existingUser;
        return $existingUser;

    }

    /**
     * @param int $userId
     * @return UserModel
     */
    public function getById(int $userId): UserModel
    {
        if (isset($this->users[$userId])) {
            return $this->users[$userId];
        }
        return new UserModel;

    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->users;
    }

}