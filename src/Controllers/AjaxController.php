<?php

namespace Quiz\Controllers;

use Quiz\Models\QuestionModel;
use Quiz\Models\UserModel;
use Quiz\Repositories\QuestionRepository;
use Quiz\Repositories\QuizAnswerRepository;
use Quiz\Repositories\QuizRepository;
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

    public function getQuizzesAction()
    {
        $repo = new QuizRepository();
        $list = $repo->all();

        return $list;
    }

//    public function getQuestions(){
//        $repo = new QuestionRepository();
//        $listOfQuestions = $repo->getQuestions();
//        $answersRepo = new QuizAnswerRepository();
//        $listOfAnswers = $answersRepo->getQuizAnswers();
//        return $listOfQuestions, $listOfAnswers;
//
//    }

}