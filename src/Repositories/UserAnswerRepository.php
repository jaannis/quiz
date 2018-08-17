<?php

namespace Quiz\Repositories;

use Quiz\Models\UserAnswerModel;

class UserAnswerRepository extends BaseRepository
{

    public static function modelName(): string
    {
        return UserAnswerModel::class;
    }

    public static function getTableName(): string
    {
        return 'user_answers';
    }

    public function getUserAnswers(int $userId, int $quizId): array
    {
        $table = static::getTableName();
        $data  = $this->connection->select($table, ['user_id' => $userId, 'quiz_id' => $quizId], $select);

        return $data;
    }
    public function saveAnswer(UserAnswerModel $answer)
    {
        return $this->save($answer);
    }

}