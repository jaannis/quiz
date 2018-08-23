<?php

namespace Quiz\Repositories;

use Quiz\Models\QuizModel;

class QuizRepository extends BaseRepository
{
    /**
     * @return string
     */
    public static function modelName(): string
    {
        return QuizModel::class;
    }

    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return 'quizzes';
    }

    /**
     * @param QuizModel $quiz
     * @return string
     */
    public function addQuiz(QuizModel $quiz)
    {
        return $this->save($quiz);
    }

}