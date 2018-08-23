<?php

namespace Quiz\Repositories;

use Quiz\Models\QuizAnswerModel;

class QuizAnswerRepository extends BaseRepository
{
    /**
     * @return string
     */
    public static function modelName(): string

    {
        return QuizAnswerModel::class;
    }

    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return 'answers';
    }

    /**
     * @param int $questionId
     * @return array
     */
    public function getQuizAnswers(int $questionId): array
    {
        $table = static::getTableName();
        $data  = $this->connection->select($table, ['question_id' => $questionId]);

        return $this->getQuizAnswersWithoutShowingCorrect($data);
    }

    /**
     * @param $questions
     * @return array
     */
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

    /**
     * @param QuizAnswerModel $quizAnswer
     * @return string
     */
    public function addAnswer(QuizAnswerModel $quizAnswer)
    {
        return $this->save($quizAnswer);
    }
}