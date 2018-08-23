<?php

namespace Quiz\Models;

abstract class BaseModel
{
    public $id;
    public $isNew = true;
    public $attributes;

    public function jsonSerialize()
    {
        return $this->attributes;
    }

}
