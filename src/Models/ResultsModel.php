<?php

namespace Quiz\Models;

class ResultsModel extends BaseModel
{
    public $userId;
    public $quizId;
    public $score;
    public $created_at;
    public $ip;

}