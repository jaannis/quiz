<?php

namespace Quiz\Repositories;

use Quiz\Models\QuizAnswerModel;

class QuizAnswerRepository extends BaseRepository
{
    public static function modelName(): string

    {
        return QuizAnswerModel::class;
    }

    public static function getTableName(): string
    {
        return 'answers';
    }

    public function getQuizAnswers(int $questionId): array
    {
        $table = static::getTableName();
        $data  = $this->connection->select($table, ['question_id' => $questionId]);

        return $data;
    }
    public function addAnswer(QuizAnswerModel $quizAnswer)
    {
        return $this->save($quizAnswer);
    }
}