<?php

namespace Mali\Validation\Rules;

use Mali\Validation\Rules\Contract\Rule;

class AlphaNumericalRule implements Rule
{
    public function apply($field, $value, $data = [])
    {
        return preg_match('/^[a-zA-Z][a-zA-Z0-9\-_]*$/', $value);
    }

    public function __toString()
    {
        return "Please Enter a valid %s";
    }
}