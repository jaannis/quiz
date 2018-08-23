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

        return $this->getQuizAnswersWithoutShowingCorrect($data);
    }

    public function getQuizAnswersWithoutShowingCorrect($questions): array
    {
        $data = [];
        foreach ($questions as $question) {
            $data[] = [
                'id'          => $question['id'],
                'answer'      => $question['answer'],
                'question_id' => $question['question_id'],
            ];
        }

        return $data;
    }

    public function addAnswer(QuizAnswerModel $quizAnswer)
    {
        return $this->save($quizAnswer);
    }
}