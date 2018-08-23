<?php

namespace Quiz\Repositories;

use Quiz\Models\QuestionModel;

class QuestionRepository extends BaseRepository
{
    /**
     * @return string
     */
    public static function modelName(): string
    {
        return QuestionModel::class;
    }

    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return 'questions';
    }

    /**
     * @param int $id
     * @param int $questionNr
     * @param array $select
     * @return array
     */
    public function getQuestion(int $id, int $questionNr, array $select = [])
    {
        $table = static::getTableName();
        $data  = $this->connection->select($table, ['quiz_id' => $id, 'question_nr' => $questionNr], $select);

        return $data;
    }

    /**
     * @param int $id
     * @param array $select
     * @return array
     */
    public function getAllQuestion(int $id, array $select = [])
    {
        $table = static::getTableName();
        $data  = $this->connection->select($table, ['quiz_id' => $id], $select);

        return $data;
    }

    /**
     * @param QuestionModel $question
     * @return string
     */
    public function addQuestions(QuestionModel $question)
    {
        return $this->save($question);
    }

}
