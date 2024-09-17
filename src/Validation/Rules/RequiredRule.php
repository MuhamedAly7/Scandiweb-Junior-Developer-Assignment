<?php

namespace Mali\Validation\Rules;

use Mali\Validation\Rules\Contract\Rule;

class RequiredRule implements Rule
{
    public function apply($field, $value, $data = [])
    {
        return !empty($value);
    }

    public function __toString()
    {
        return "Please, provide %s";
    }
}