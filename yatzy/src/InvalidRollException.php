<?php

namespace Yatzy;

class InvalidRollException extends \Exception
{
    public function __construct(string $string)
    {
        parent::__construct($string);
    }
}
