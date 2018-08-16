<?php
include_once '../vendor/autoload.php';

use Quiz\Repositories\UserRepositoryDatabase;

$repo = new UserRepositoryDatabase();
$data = $repo->getById(1);
var_dump($data);