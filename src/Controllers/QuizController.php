<?php

namespace Quiz\Controllers;

use Quiz\Repositories\QuizRepository;

class QuizController extends BaseController
{
    public function indexAction()
    {
       $repo = new QuizRepository();
       $list = $repo->all();

        return $this->render('index', compact('list'));
    }

}