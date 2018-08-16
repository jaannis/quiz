<?php
include_once '../vendor/autoload.php';

use Quiz\Models\UserModel;
use Quiz\Repositories\QuestionRepositoryDatabase;
use Quiz\Repositories\UserRepositoryDatabase;

$repo = new UserRepositoryDatabase();
$data = $repo->getById(2);
$user         = new UserModel;
$name         = $user->name = 'Martins';
$id           = $user->id;
$newUser = $repo->saveOrCreate($user);

$repo = new QuestionRepositoryDatabase();
$data2 = $repo->getQuestions(1);
$data3 = $repo->getList();
var_dump($data, $data2, $data3);
