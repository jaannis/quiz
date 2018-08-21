<?php

namespace Quiz\Controllers;

use Quiz\Repositories\QuizRepository;
use Quiz\Service\GetQuestionsService;

class AjaxController extends BaseAjaxController
{
    protected $getQuestionService;

    /**
     * AjaxController constructor.
     * @param GetQuestionsService $getQuestionService
     */
    public function __construct(GetQuestionsService $getQuestionService)
    {
        if (!session_id()) {
            session_start();
        }
        $this->getQuestionService = $getQuestionService;
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

//        $repo = new GetQuestionsService();
        return $this->getQuestionService->startQuestion($quizId, $questionNr, $name);

//        return $next;

    }

    public function answerAction()
    {
        $answerId = $this->post['answerId'];

        $questionNr = isset($_SESSION['questionNr']) ? (int)$_SESSION['questionNr'] : 0;
        $questionNr++;
        $_SESSION['questionNr'] = $questionNr;

        return $this->getQuestionService->nextQuestions($answerId, $questionNr);
    }

}