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

    /**
     * @return array
     */
    public function getQuizzesAction()
    {
        $repo = new QuizRepository();
        $list = $repo->all();

        return $list;
    }

    /**
     * @return array
     */
    public function startAction()
    {
        $quizId                 = $this->post['quizId'];
        $_SESSION['questionNr'] = 1;
        $_SESSION['quizId']     = $quizId;
        $questionNr             = $_SESSION['questionNr'];
        $name                   = $this->post['name'];

        $service = new GetQuestionsService();

        return $service->startQuestion($quizId, $questionNr, $name);
    }

    /**
     * @return array|string
     */
    public function answerAction()
    {
        $answerId = $this->post['answerId'];
        if (!$answerId == null) {
            $saveService = new SaveService();
            $saveService->saveUserAnswer($answerId);

            $questionNr = isset($_SESSION['questionNr']) ? (int)$_SESSION['questionNr'] : 0;
            $questionNr++;
            $_SESSION['questionNr'] = $questionNr;

            $service = new GetQuestionsService();

            return $service->nextQuestions($questionNr);
        }

        return 'Fuck you, choose one answer';

    }

}