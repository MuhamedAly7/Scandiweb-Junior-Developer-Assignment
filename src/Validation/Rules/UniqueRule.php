<?php

namespace Mali\Validation\Rules;

use Mali\Validation\Rules\Contract\Rule;

class UniqueRule implements Rule
{
    protected $table;
    protected $column;
    public function __construct($table, $column)
    {
        $this->table = $table;
        $this->column = $column;
    }
    
    public function apply($field, $value, $data = [])
    {
        return !(app()->db->raw("SELECT * FROM {$this->table} WHERE {$this->column} = ?", [$value]));
    }

    public function __toString()
    {
        return "The %s is already exists!";
    }
}