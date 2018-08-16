<?php

namespace Quiz\Models;

class UserModel
{
    public $id;
    public $name;

    /**
     * UserModel constructor.
     * @param int $id
     * @param string $name
     */
    public function __construct(int $id = 0, string $name = '')
    {
        $this->id   = $id;
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function isNew(): bool
    {
        return $this->id == 0;
    }
}