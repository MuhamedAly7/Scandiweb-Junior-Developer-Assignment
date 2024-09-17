<?php

namespace Mali\Validation;

use Mali\Validation\Rules\AlphaNumericalRule;
use Mali\Validation\Rules\AlphaRule;
use Mali\Validation\Rules\BetweenRule;
use Mali\Validation\Rules\GreaterThanRule;
use Mali\Validation\Rules\NumericRule;
use Mali\Validation\Rules\RequiredRule;
use Mali\Validation\Rules\UniqueRule;

trait RulesMapper
{
    protected static array $map = [
        'required' => RequiredRule::class,
        'between'  => BetweenRule::class,
        'unique'   => UniqueRule::class,
        'alnum'    => AlphaNumericalRule::class,
        'gthan'    => GreaterThanRule::class,
        'numeric'  => NumericRule::class,
        'alpha'    => AlphaRule::class
    ];

    public static function resolve(string $rule, $options)
    {
        return new static::$map[$rule](...$options);
    }
}