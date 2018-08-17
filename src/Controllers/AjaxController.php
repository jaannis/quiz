<?php

namespace Quiz\Controllers;

use Quiz\Models\UserModel;
use Quiz\Repositories\UserRepository;

class AjaxController extends BaseAjaxController
{
    public function saveUserAction()
    {
        $name       = $this->post['name'];
        $repo       = new UserRepository();
        $user       = new UserModel();
        $user->name = $name;
        $repo->saveOrCreate($user);

        return $user;
    }

}