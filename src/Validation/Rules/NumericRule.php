<?php

namespace Mali\Validation\Rules;

use Mali\Validation\Rules\Contract\Rule;

class NumericRule implements Rule
{
    public function apply($field, $value, $data = [])
    {
        return preg_match('/^[+]?([0-9]*[.])?[0-9]+$/', $value);
    }

    public function __toString()
    {
        return "Enter a valid %s";
    }
}