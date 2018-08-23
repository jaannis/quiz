<?php

namespace Quiz\Service;

use Quiz\Repositories\QuestionRepository;
use Quiz\Repositories\QuizAnswerRepository;
use Quiz\Repositories\UserAnswerRepository;

class GetQuestionsService
{

    public function __construct()
    {
        if (!session_id()) {
            session_start();
        }
    }

    /**
     * @param $quizId
     * @param $questionNr
     * @param $name
     * @return array
     */
    public function startQuestion($quizId, $questionNr, $name)
    {
        $saveService      = new SaveService();
        $_SESSION['user'] = $saveService->saveUserModel($name);

        return $this->prepareQuestion($quizId, $questionNr);
    }

    /**
     * @param $quizId
     * @param $questionNr
     * @return array
     */
    public function prepareQuestion($quizId, $questionNr)
    {
        $question = $this->oneQuestion($quizId, $questionNr);

        $answersRepo = new QuizAnswerRepository();
        $answers     = $answersRepo->getQuizAnswers($question['id']);

        return $this->sendQuestionToFront($question, $answers);
    }

    /**
     * @param $quizId
     * @param $questionNr
     * @return mixed
     */
    public function oneQuestion($quizId, $questionNr)
    {
        $questionRepo  = new QuestionRepository();
        $questionArray = $questionRepo->getQuestion($quizId, $questionNr);
        $question      = array_shift($questionArray);

        return $question;
    }

    /**
     * @param $question
     * @param $answers
     * @return array
     */
    public function sendQuestionToFront($question, $answers)
    {
        $progressbar = $this->GetQuestionsCount();
        $questions   = [
            'id'          => $question['id'],
            'question'    => $question['questions'],
            'answers'     => $answers,
            'progressbar' => $progressbar,
        ];

        return $questions;
    }

    /**
     * @param $questionNr
     * @return array|string
     */
    public function nextQuestions($questionNr)
    {
        $userId          = $_SESSION['user'];
        $questionsRepo   = new QuestionRepository;
        $userAnswersRepo = new UserAnswerRepository;
        $quizAnswers     = new QuizAnswerRepository;
        $quizService     = new QuizService($questionsRepo, $userAnswersRepo, $quizAnswers);
        $quizId          = $_SESSION['quizId'];
        $isCompleted     = $quizService->isQuizCompleted($userId, $quizId);

        if (!$isCompleted) {

            return $this->prepareQuestion($quizId, $questionNr);
        }

        return $quizService->getScore($userId, $quizId);
    }

    public function GetQuestionsCount()
    {
        $quizId             = $_SESSION['quizId'];
        $repo               = new QuestionRepository();
        $questionsCount     = count($repo->getAllQuestion($quizId));
        $completedQuestions = $_SESSION['questionNr'] - 1;

        return $completedQuestions / $questionsCount * 100;

    }

}