<?php

namespace Tests\Browser;

class ScaffoldDummy
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getKey()
    {
        return $this->value;
    }

    public function forceDelete()
    {
        return true;
    }
}
