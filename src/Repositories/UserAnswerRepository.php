<?php

namespace Quiz\Repositories;

use Quiz\Models\UserAnswerModel;

class UserAnswerRepository
{
    private $answers = [];

    /**
     * @param UserAnswerModel $answer
     * @return UserAnswerModel
     */
    public function saveAnswer(UserAnswerModel $answer)
    {
        return $this->answers[] = $answer;
    }

    /**
     * @param int $userId
     * @param int $quizId
     * @return array
     */
    public function getAnswers(int $userId, int $quizId): array
    {
        $results = [];
        foreach ($this->answers as $answer) {
            if ($answer->userId == $userId && $answer->quizId == $quizId) {
                $results[] = $answer;
            }
        }

        return $results;

    }

}