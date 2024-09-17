<?php

namespace Mali\Validation;

trait RulesResolver
{
    public static function make($rules) // $rules here may be string or array 
    {
        $rules = (array) (str_contains($rules, '|') ? explode('|', $rules) : $rules);

        return array_map(function ($rule){
            if(is_string($rule))
            {
                return static::getRuleFromString($rule);
            }

            return $rule;
        }, $rules);
    }

    public static function getRuleFromString(string $rule)
    {
        $exploded = explode(':', $rule);
        $rule = $exploded[0];
        $options = explode(',', end($exploded));
        return RulesMapper::resolve($rule, $options);
    }
}