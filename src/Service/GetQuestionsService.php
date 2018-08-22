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

        return $this->takeQuestion($quizId, $questionNr);

    }

    public function takeQuestion($quizId, $questionNr)
    {
        $question = $this->oneQuestion($quizId, $questionNr);

        $answersRepo = new QuizAnswerRepository();
        $answers     = $answersRepo->getQuizAnswers($question['id']);

        return $this->getQuestion($question, $answers, $quizId);
    }

    public function oneQuestion($quizId, $questionNr)
    {
        $questionRepo  = new QuestionRepository();
        $questionArray = $questionRepo->getQuestion($quizId, $questionNr);
        $question      = array_shift($questionArray);

        return $question;
    }

    public function getQuestion($question, $answers, $quizId)
    {
//        $quizService = new QuizService();
//        $isCompleted = $quizService->isQuizCompleted($quizId);

//        if (!$isCompleted) {
        $test = [];

//        foreach ($answers as $answer) {
//            $test[] = ['id' => $answer['id'], ['answer' => $answer['answer']]];
//        }
//        foreach ($answers as $answer) {
//            $test[] = unset($answer['isCorrect']);
//
//        }
        $questions = [
            'id'       => $question['id'],
            'question' => $question['questions'],
            'answers'  => $answers,

        ];

        return $questions;
//        }

//        return $quizService->getScore($_SESSION['user'], $quizId);
    }

    public function nextQuestions($answerId, $questionNr)
    {
        $quizId     = $_SESSION['quizId'];
        $question   = $this->oneQuestion($quizId, $questionNr);
        $questionId = $question['id'];
        $userId     = $_SESSION['user'];

        $this->saveUserAnswer($answerId, $quizId, $userId, $questionId);

        return $this->takeQuestion($quizId, $questionNr);
    }

    public function saveUserAnswer($answerId, $quizId, $userId, $questionId)
    {
        $repo                    = new UserAnswerRepository();
        $answerModel             = new UserAnswerModel();
        $answerModel->answer_id   = $answerId;
        $answerModel->quiz_id     = $quizId;
        $answerModel->user_id    = $userId;
        $answerModel->question_id = $questionId;
//        return $answerModel;
        $repo->saveAnswer($answerModel);

    }

}