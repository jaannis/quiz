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

//    public function setAttributes(array $attributes = [])
//    {
//        foreach ($attributes as $key => $value) {
//            if (property_exists(static::class, $key)) {
//                $this->$key = $value;
//            }
//        }
//    }

}
