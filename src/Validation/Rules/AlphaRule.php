<?php

namespace Mali\Validation\Rules;

use Mali\Validation\Rules\Contract\Rule;

class AlphaRule implements Rule
{
    public function apply($field, $value, $data = [])
    {
        return preg_match('/^[a-zA-Z][a-zA-Z ]*$/', $value);
    }

    public function __toString()
    {
        return 'Please Enter a valid %s';
    }
}