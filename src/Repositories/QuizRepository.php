<?php

namespace Quiz\Repositories;

use Quiz\Models\QuizAnswerModel;
use Quiz\Models\QuestionModel;
use Quiz\Models\QuizModel;

class QuizRepository
{
    /** @var QuizModel[] */
    private $quizes = [];
    /** @var QuestionModel[] */
    private $questions = [];
    /** @var QuizAnswerModel[] */
    private $answers = [];

    /**
     * @param QuizModel $quiz
     */
    public function addQuiz(QuizModel $quiz)
    {
        $this->quizes[] = $quiz;
    }

    /**
     * @param QuestionModel $question
     */
    public function addQuestion(QuestionModel $question)
    {
        $this->questions[] = $question;
    }

    /**
     * @param QuizAnswerModel $answer
     */

    public function addAnswers(QuizAnswerModel $answer)
    {
        $this->answers[] = $answer;
    }

    /**
     * @param int $quizId
     * @return QuizModel
     */
    public function getById(int $quizId): QuizModel
    {
        foreach ($this->quizes as $quiz) {
            if ($quiz->id == $quizId) {
                return $quiz;
            }
        }

        return new QuizModel; // Returns empty model
    }

    /**
     * @param int $questionId
     * @return array
     */
    public function getAnswers(int $questionId): array
    {
//        $model             = new QuizAnswerModel;
//        $model->id         = '1';
//        $model->answer     = 'Cats';
//        $model->questionId = '2';
//        $model->isCorrect  = '1';
//        $answers = [];
//        $answers[]=$model;
        $answers = [];
//        var_dump($answers);
//        die;
        foreach ($this->answers as $answer) {
            if ($answer->questionId == $questionId) {
                $answers[] = $answers;
            }
        }

        return $answers;
    }

    /**
     * @param int $quizId
     * @return QuestionModel[]
     */
    public function getQuestions(int $quizId): array
    {
        $questions = [];
        foreach ($this->questions as $question) {
            if ($question->quizId == $quizId) {
                $questions[] = $question;
            }
        }

        return $questions;
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        $quizNames = [];
        foreach ($this->quizes as $quize) {
            $quizNames[] = $quize->name;
        }

        return $quizNames;

    }

}