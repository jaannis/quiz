<?php

namespace Quiz\Controllers;

use Quiz\Models\UserModel;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserRepository;
use Quiz\Service\QuizService;

class IndexController extends BaseController
{
    /**
     * @return string
     */
    public function indexAction()
    {
        $userRepo = new UserRepository();
        $user   = $userRepo->getById(1);
        $quizRepo   = new QuizRepository();
        $quizes = $quizRepo->all();

        return $this->render('index', compact('user', 'quizes'));
    }

}