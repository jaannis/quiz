<?php

namespace Quiz\Service;

use Quiz\Models\UserAnswerModel;
use Quiz\Models\UserModel;
use Quiz\Repositories\QuestionRepository;
use Quiz\Repositories\QuizAnswerRepository;
use Quiz\Repositories\UserAnswerRepository;
use Quiz\Repositories\UserRepository;

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
        $repo             = new UserRepository();
        $user             = new UserModel();
        $user->name       = $name;
        $_SESSION['user'] = $repo->saveUser($user);

        return $this->prepareQuestion($quizId, $questionNr);

    }

    public function prepareQuestion($quizId, $questionNr)
    {
        $question = $this->oneQuestion($quizId, $questionNr);

        $answersRepo = new QuizAnswerRepository();
        $answers     = $answersRepo->getQuizAnswers($question['id']);

        return $this->getQuestion($question, $answers);
    }

    public function oneQuestion($quizId, $questionNr)
    {
        $questionRepo  = new QuestionRepository();
        $questionArray = $questionRepo->getQuestion($quizId, $questionNr);
        $question      = array_shift($questionArray);

        return $question;
    }

    public function getQuestion($question, $answers)
    {
        $questions = [
            'id'       => $question['id'],
            'question' => $question['questions'],
            'answers'  => $answers,

        ];

        return $questions;
    }

    public function nextQuestions($answerId, $questionNr)
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

    public function saveUserAnswer($answerId, $quizId, $userId, $questionId)
    {
        $repo                     = new UserAnswerRepository();
        $answerModel              = new UserAnswerModel();
        $answerModel->answer_id   = $answerId;
        $answerModel->quiz_id     = $quizId;
        $answerModel->user_id     = $userId;
        $answerModel->question_id = $questionId;
        $repo->saveAnswer($answerModel);
    }
}