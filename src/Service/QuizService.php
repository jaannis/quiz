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
        $results = $this->quizes->getQuestions($quizId);

        return $results;
    }

    /**
     * Get list of available answers for this question
     *
     * @param int $questionId
     * @return QuizAnswerModel[]
     */

    public function getAnswers(int $questionId): array
    {
        return $this->quizes->getAnswers($questionId);

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
        $questionsCount = count($this->quizes->getQuestions($quizId));
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
        $quizAnswerModelModel = new QuizAnswerModel;
        $score                = 0;
        $userAnswers          = $this->userAnswers->getAnswers($userId, $quizId);
        foreach ($userAnswers as $answer) {
            if ($answer->answerId == $quizAnswerModelModel->id) {
                if ($quizAnswerModelModel->isCorrect) {
                    $score = $score + 1;
                }
            }
        }
        $result = $score / count($userAnswers);

        return $result;

    }
}