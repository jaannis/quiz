<?php

namespace Quiz\Tests;

use PHPUnit\Framework\TestCase;
use Quiz\Models\UserModel;
use Quiz\Repositories\UserRepository;
use Quiz\Repositories\UserRepositoryDatabase;

class UserRepositoryTest extends TestCase
{
    public $usersRepo;

    public function setUp()
    {
        parent::setUp();

        $this->usersRepo = new UserRepositoryDatabase;

    }

    public function testUserCreation()
    {
        $repo        = $this->usersRepo;
        $user        = new UserModel;
        $user->name  = "Martins";
        $userCreated = $repo->saveOrCreate($user);
        self::assertFalse($userCreated->isNew(), 'User is not new');
        self::assertEquals($user->name, $userCreated->name, 'Names match');
    }

    public function testNameEdit()
    {
        $repo            = $this->usersRepo;
        $user            = new UserModel;
        $user->name      = 'Martins';
        $savedUser       = $repo->saveOrCreate($user);
        $savedUser->name = 'Janis';
        $editedUser      = $repo->saveOrCreate($savedUser);

        self::assertEquals($savedUser->name, $editedUser->name, 'Name is saved');
        self::assertEquals($savedUser->id, $editedUser->id, 'Same id');
    }

    public function testGetAllUsersAndSearchById()
    {
        $repo       = $this->usersRepo;
        $user       = new UserModel;
        $user->name = 'Martins';
        $save       = $repo->saveOrCreate($user);
        $user->name = 'Janis';
        $save       = $repo->saveOrCreate($user);
        $getAll     = $repo->getAll();

        $searchByIdUser = $repo->getById('1');

        self::assertNotEmpty($getAll);
        self::assertEquals($searchByIdUser->id, '1');
        self::assertEquals($searchByIdUser->name, 'Martins');

    }
}
