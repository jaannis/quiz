<?php

namespace Quiz\Service;

use Quiz\Models\QuizAnswerModel;
use Quiz\Models\QuestionModel;
use Quiz\Models\QuizModel;
use Quiz\Models\UserModel;
use Quiz\Repositories\QuestionRepositoryDatabase;
use Quiz\Repositories\QuizAnswerRepositoryDatabase;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\QuizRepositoryDatabase;
use Quiz\Repositories\UserAnswerRepository;
use Quiz\Repositories\UserAnswerRepositoryDatabase;
use Quiz\Repositories\UserRepository;
use Quiz\Repositories\UserRepositoryDatabase;

class QuizService
{
    /** @var QuestionRepositoryDatabase */
    private $questions;
    /** @var UserRepository */
    private $users;
    /** @var UserAnswerRepository */
    private $userAnswers;
    /** @var QuizRepositoryDatabase */
    private $quizAnswers;
    /** @var QuizRepository */
    private $quizzes;

    /**
     * QuizService constructor.
     * @param QuestionRepositoryDatabase $questions
     * @param UserRepositoryDatabase $users
     * @param UserAnswerRepositoryDatabase $userAnswers
     * @param QuizAnswerRepositoryDatabase $quizAnswers
     * @param QuizRepositoryDatabase $quizzes
     */
    public function __construct(
        QuestionRepositoryDatabase $questions,
        UserRepositoryDatabase $users,
        UserAnswerRepositoryDatabase $userAnswers,
        QuizAnswerRepositoryDatabase $quizAnswers,
        QuizRepositoryDatabase $quizzes
    ) {
        $this->questions   = $questions;
        $this->users       = $users;
        $this->userAnswers = $userAnswers;
        $this->quizAnswers = $quizAnswers;
        $this->quizzes     = $quizzes;
    }

    /**
     * Get list of available quizzes
     *
     * @return QuizModel[]
     */

    public function getQuizzes(): array
    {
        return $this->quizzes->getList();
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
        $existingUser = $this->users->getById($userId);
        if ($existingUser->isNew()) {
            return true;
        };

        return false;
    }

    /**
     * Get list of questions for a specific quiz
     *
     * @param int $quizId
     * @return QuestionModel[]
     */

    public function getQuestions(int $quizId): array
    {
        return $this->questions->getQuestions($quizId);
    }

    /**
     * Get list of available answers for this question
     *
     * @param int $questionId
     * @return QuizAnswerModel[]
     */

    public function getAnswers(int $questionId): array
    {
        return $this->quizAnswers->getAnswers($questionId);

    }

    /**
     * Submit current users answer
     *
     * @param $model
     * @return \Quiz\Models\UserAnswerModel
     */

    public function submitAnswer($model)
    {
        return $this->userAnswers->saveAnswer($model);

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
        $answersCount   = count($this->userAnswers->getAnswers($userId, $quizId));
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
    public function getScore(int $userId, int $quizId): int
    {
        $score       = 0;
        $userAnswers = $this->userAnswers->getAnswers($userId, $quizId);

        foreach ($userAnswers as $answer) {
            $questionId  = $answer->questionId;
            $quizAnswers = $this->getAnswers($questionId);
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