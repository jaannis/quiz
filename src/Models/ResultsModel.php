<?php

namespace Quiz\Models;

class ResultsModel extends BaseModel
{
    public $id;
    public $userId;
    public $quizId;
    public $score;
    public $created_at;
}