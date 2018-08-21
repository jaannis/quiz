<?php

namespace Quiz\Repositories;

use Quiz\Models\QuestionModel;

class QuestionRepository extends BaseRepository
{
    public static function modelName(): string
    {
        return QuestionModel::class;
    }

    public static function getTableName(): string
    {
        return 'questions';
    }

    public function getQuestion(int $id, int $questionNr, array $select = [])
    {
        $table = static::getTableName();
        $data  = $this->connection->select($table, ['quiz_id' => $id, 'question_nr' => $questionNr], $select);

        return $data;
    }

    public function getAllQuestion(int $id, array $select = [])
    {
        $table = static::getTableName();
        $data  = $this->connection->select($table, ['quiz_id' => $id], $select);

        return $data;
    }

    public
    function addQuestions(
        QuestionModel $question
    ) {
        return $this->save($question);
    }

}
