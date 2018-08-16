<?php

namespace Quiz\Repositories;

use Quiz\Models\QuestionModel;

class QuestionRepositoryDatabase extends BaseRepository
{
    public static function modelName(): string
    {
        return QuestionModel::class;
    }

    public static function getTableName(): string
    {
        return 'questions';
    }

    public function getQuestions(int $id, array $select = [])
    {
        $table = static::getTableName();
        $data  = $this->connection->select($table, ['quiz_id' => $id], $select);

        return $data;
    }
}
