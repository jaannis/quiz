<?php

namespace Quiz\Controllers;

use Quiz\Repositories\QuizRepository;
use Quiz\Service\GetQuestionsService;
use Quiz\Service\SaveService;

class AjaxController extends BaseAjaxController
{

    public function __construct()
    {
        if (!session_id()) {
            session_start();
        }
    }

    public function getQuizzesAction()
    {
        $repo = new QuizRepository();
        $list = $repo->all();

        return $list;
    }

    public function startAction()
    {
        $quizId                 = $this->post['quizId'];
        $_SESSION['questionNr'] = 1;
        $_SESSION['quizId']     = $quizId;
        $questionNr             = $_SESSION['questionNr'];
        $name                   = $this->post['name'];

        $repo = new GetQuestionsService();

        return $repo->startQuestion($quizId, $questionNr, $name);
    }

    public function answerAction()
    {
        $answerId    = $this->post['answerId'];
        $saveService = new SaveService();
        $saveService->saveUserAnswer($answerId);

        $questionNr = isset($_SESSION['questionNr']) ? (int)$_SESSION['questionNr'] : 0;
        $questionNr++;
        $_SESSION['questionNr'] = $questionNr;

        $repo = new GetQuestionsService();

        return $repo->nextQuestions($questionNr);
    }

}