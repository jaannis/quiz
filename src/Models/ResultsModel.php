<?php

namespace Quiz\Models;

class ResultsModel extends BaseModel
{
    public $id;
    public $user_id;
    public $quiz_id;
    public $score;
    public $created_at;
}