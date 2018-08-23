<?php

namespace Quiz\Repositories;

use Quiz\Models\UserAnswerModel;

class UserAnswerRepository extends BaseRepository
{

    /**
     * @return string
     */
    public static function modelName(): string
    {
        return UserAnswerModel::class;
    }

    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return 'user_answers';
    }

    /**
     * @param int $userId
     * @param int $quizId
     * @param array $select
     * @return array
     */
    public function getUserAnswers(int $userId, int $quizId, array $select = []): array
    {
        $table = static::getTableName();
        $data  = $this->connection->select($table, ['user_id' => $userId, 'quiz_id' => $quizId], $select);

        return $data;
    }

    /**
     * @param UserAnswerModel $answer
     * @return string
     */
    public function saveAnswer(UserAnswerModel $answer)
    {
        return $this->save($answer);
    }

}