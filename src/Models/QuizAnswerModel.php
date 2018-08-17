<?php

namespace Quiz\Models;

class QuizAnswerModel extends BaseModel
{
    public $id;
    public $answer;
    public $questionId;
    public $isCorrect;

}