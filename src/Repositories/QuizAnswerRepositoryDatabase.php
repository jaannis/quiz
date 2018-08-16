<?php

namespace Quiz\Repositories;

use Quiz\Models\QuizAnswerModel;

class QuizAnswerRepositoryDatabase extends BaseRepository
{
    public static function modelName(): string

    {
        return QuizAnswerModel::class;
    }

    public static function getTableName(): string
    {
        return 'answers';
    }

    public function getAnswers(int $questionId): array
    {
        $table = static::getTableName();
        $data  = $this->connection->select($table, ['question_id' => $questionId]);

        return $data;
    }
}