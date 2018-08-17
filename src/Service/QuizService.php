<?php

namespace Quiz\Service;

use Quiz\Repositories\QuestionRepository;
use Quiz\Repositories\QuizAnswerRepository;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserAnswerRepository;

class QuizService
{
    /** @var QuestionRepository */
    private $questions;
    /** @var UserAnswerRepository */
    private $userAnswers;
    /** @var QuizRepository */
    private $quizAnswers;

    /**
     * QuizService constructor.
     * @param QuestionRepository $questions
     * @param UserAnswerRepository $userAnswers
     * @param QuizAnswerRepository $quizAnswers
     */
    public function __construct(
        QuestionRepository $questions,
        UserAnswerRepository $userAnswers,
        QuizAnswerRepository $quizAnswers
    ) {
        $this->questions   = $questions;
        $this->userAnswers = $userAnswers;
        $this->quizAnswers = $quizAnswers;
    }

    /**
     * @param $model
     * @return bool
     */
    public
    function submitAnswer(
        $model
    ) {
        return $this->userAnswers->saveAnswer($model);

    }

    /**
     * Check if user has answered all questions for this quiz (correct or incorrect)
     *
     * @param int $userId
     * @param int $quizId
     * @return bool
     */
    public
    function isQuizCompleted(
        int $userId,
        int $quizId
    ): bool {
        $answersCount   = count($this->userAnswers->getUserAnswers($userId, $quizId));
        $questionsCount = count($this->questions->getQuestions($quizId));
        if ($answersCount == $questionsCount) {
            return true;
        }

        return false;
    }

    /**
     * Get score in the quiz in percentage round(right answers / answer count * 100)
     *
     * @param int $userId
     * @param int $quizId
     * @return int 0-100
     */
    public
    function getScore( int $userId, int $quizId
    ): int {
        $score       = 0;
        $userAnswers = $this->userAnswers->getUserAnswers($userId, $quizId);

        foreach ($userAnswers as $answer) {
            $questionId  = $answer->questionId;
            $quizAnswers = $this->quizAnswers->getQuizAnswers($questionId);
            foreach ($quizAnswers as $quizAnswer) {
                if ($quizAnswer->isCorrect) {
                    $score = $score + 1;
                }
            }
        }
        $result = $score / count($userAnswers);

        return $result;

    }
}