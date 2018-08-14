<?php

namespace Quiz\Service;

use Quiz\Models\QuizAnswerModel;
use Quiz\Models\QuestionModel;
use Quiz\Models\QuizModel;
use Quiz\Models\UserModel;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserAnswerRepository;
use Quiz\Repositories\UserRepository;

class QuizService
{
    /** @var QuizRepository */
    private $quizes;
    /** @var UserRepository */
    private $users;
    /** @var UserAnswerRepository */
    private $userAnswers;

    public function __construct(
        QuizRepository $quizes,
        UserRepository $users,
        UserAnswerRepository $userAnswers
    ) {
        $this->quizes      = $quizes;
        $this->users       = $users;
        $this->userAnswers = $userAnswers;
    }

    /**
     * Get list of available quizes
     *
     * @return QuizModel[]
     */

    public function getQuizes(): array
    {
        return $this->quizes->getList();
    }

    /**
     * Register a new user
     *
     * @param string $name
     * @return UserModel
     */
    public function registerUser(string $name): UserModel
    {
        $user       = new UserModel;
        $user->name = $name;

        return $this->users->saveOrCreate($user);
    }

    /**
     * Check if user exists in the system (is valid)
     *
     * @param int $userId
     * @return bool
     */
    public function isExistingUser($userId): bool
    {
        // TODO implement
    }

    /**
     * Get list of questions for a specific quiz
     *
     * @param QuizRepository $questions
     * @param int $quizId
     * @return QuestionModel[]
     */

    public function getQuestions(QuizRepository $questions, int $quizId): array
    {
//        $id      = $questions->getById($quizId);
        $results = $questions->getQuestions($quizId);

        return $results;
    }

    /**
     * Get list of available answers for this question
     *
     * @param QuizRepository $answers
     * @param int $questionId
     * @return QuizAnswerModel[]
     */

    public function getAnswers(QuizRepository $answers, int $questionId): array
    {
        return $answers->getAnswers($questionId);

    }

    /**
     * Submit current users answer
     *
     * @param UserAnswerRepository $answers
     * @param int $quizId
     * @param int $answerId
     * @return \Quiz\Models\UserAnswerModel
     */

    public function submitAnswer(UserAnswerRepository $answers, int $quizId, int $answerId)
    {
        return $answers->saveAnswer($quizId, $answerId);

    }

    /**
     * Check if user has answered all questions for this quiz (correct or incorrect)
     *
     * @param int $userId
     * @param int $quizId
     * @return bool
     */
    public function isQuizCompleted(int $userId, int $quizId): bool
    {
        // TODO implement
    }

    /**
     * Get score in the quiz in percentage round(right answers / answer count * 100)
     *
     * @param int $userId
     * @param int $quizId
     * @return int 0-100
     */
    public function getScore(int $userId, int $quizId): int
    {
        // TODO implement
    }
}