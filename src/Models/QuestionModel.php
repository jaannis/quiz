<?php

namespace Quiz\Models;

class QuestionModel extends BaseModel
{
    public $id;
    public $quiz_id;
    public $question;
    public $question_nr;
}