<?php

namespace Quiz\Models;

class UserAnswerModel extends BaseModel
{
    public $id;
    public $user_id;
    public $quiz_id;
    public $answer_id;
    public $question_id;

}