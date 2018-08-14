<?php

use Quiz\Models\UserAnswerModel;
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
    /** @var int */
    private $userId;

    public function __construct(
        int $userId,
        QuizRepository $quizes,
        UserRepository $users,
        UserAnswerRepository $userAnswers
    ) {
        $this->quizes      = $quizes;
        $this->users       = $users;
        $this->userAnswers = $userAnswers;
        $this->userId      = $userId;
    }

    public function getQuizes(): array
    {
        return $this->quizes->getList();
    }

    public function registerUser(string $name): UserModel
    {
        $user       = new UserModel;
        $user->name = $name;

        return $this->users->saveOrCreate($user);
    }

    public function getQuestions(QuizRepository $questions): array
    {
        $id = $questions->getById();
        $results = $questions->getQuestions($id);
        return $results;

    }

    public function getAnswers(QuizRepository $answers, int $questionId)
    {
        return $answers->getAnswers($questionId);

    }

    public function getUserAnswers(UserAnswerRepository $answers, int $userId, int $quizId)
    {
        return $answers->getAnswers($userId, $quizId);
    }

    public function submitAnswer(UserAnswerRepository $answers, int $quizId, int $answerId): UserAnswerModel
    {
        return $answers->saveAnswer($quizId, $answerId);

    }

    public function getCurrentUser(): UserModel
    {

    }

    public function getResult(): ResultModel
    {

    }

}