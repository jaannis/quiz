<?php

namespace Quiz\Models;

class QuizAnswerModel extends BaseModel
{
    public $id;
    public $answer;
    public $question_id;
    public $is_correct;

}