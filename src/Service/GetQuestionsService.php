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

    public function startQuestion($quizId, $questionNr, $name)
    {
        $saveService      = new SaveService();
        $_SESSION['user'] = $saveService->saveUserModel($name);

        return $this->prepareQuestion($quizId, $questionNr);
    }

    public function prepareQuestion($quizId, $questionNr)
    {
        $question = $this->oneQuestion($quizId, $questionNr);

        $answersRepo = new QuizAnswerRepository();
        $answers     = $answersRepo->getQuizAnswers($question['id']);

        return $this->sendQuestionToFront($question, $answers);
    }

    public function oneQuestion($quizId, $questionNr)
    {
        $questionRepo  = new QuestionRepository();
        $questionArray = $questionRepo->getQuestion($quizId, $questionNr);
        $question      = array_shift($questionArray);

        return $question;
    }

    public function sendQuestionToFront($question, $answers)
    {
        $questions = [
            'id'       => $question['id'],
            'question' => $question['questions'],
            'answers'  => $answers,
        ];

        return $questions;
    }

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

}