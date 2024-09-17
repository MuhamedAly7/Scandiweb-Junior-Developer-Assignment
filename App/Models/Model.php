<?php

namespace App\Models;

use Mali\Support\Str;

abstract class Model
{
    protected static $instance;

    public static function create(array $attributes)
    {   
        self::$instance = static::class;

        return app()->db->create($attributes);
    }   

    public static function all()
    {   
        self::$instance = static::class;
        return app()->db->read();
    }   

    public static function delete($filter)
    {   
        self::$instance = static::class;
        return app()->db->delete($filter);
    }   

    public static function deleteIn($column, array $data)
    {
        self::$instance = static::class;
        return app()->db->deleteIn($column, $data);
    }

    public static function update(array $attributes, $filter)
    {   
        self::$instance = static::class;
        return app()->db->update($attributes, $filter);
    }   

    public static function where($filter, $columns = '*')
    {   
        self::$instance = static::class;
        return app()->db->read($columns, $filter);
    }   

    public static function getModel()
    {   
        return self::$instance;
    }   

    public static function getTableName()
    {   
        return Str::lower(Str::plural(class_basename(self::$instance)));
    }   

}
