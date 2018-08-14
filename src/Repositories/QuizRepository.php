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

    public function addQuiz(QuizModel $quiz)
    {
        $this->quizes[] = $quiz;
    }

    public function addQuestion(QuestionModel $question)
    {
        $this->questions[] = $question;
    }

    public function addAnswers(QuizAnswerModel $answer)
    {
        $this->answers[] = $answer;
    }

    public function getById(int $quizId): QuizModel
    {
        foreach ($this->quizes as $quiz) {
            if ($quiz->id == $quizId) {
                return $quiz;
            }
        }
        return new QuizModel; // Returns empty model
    }

    public function getAnswers(int $questionId): array
    {
        $answers = [];
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

    public function getList(): array
    {
        $quizNames = [];
        foreach ($this->quizes as $quize) {
            $quizNames[] = $quize->name;
        }
        return $quizNames;

    }

}