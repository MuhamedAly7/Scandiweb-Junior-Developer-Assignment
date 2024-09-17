<?php

namespace Mali\Support;

use ArrayAccess;

class Arr
{
    public static function only($array, $keys)
    {
        return array_intersect_key($array, array_flip((array)$keys));
    }

    public static function accessable($value)
    {
        return is_array($value) || $value instanceof ArrayAccess;
    }

    public static function exists($array, $key)
    {
        if($array instanceof ArrayAccess)
        {
            return $array->offsetExists($key);
        }
        return array_key_exists($key, $array);
    }

    public static function get($array, $key, $default = null)
    {
        if(!static::accessable($array))
        {
            return value($default);
        }

        if(is_null($key))
        {
            return $array;
        }

        if(static::exists($array, $key))
        {
            return $array[$key];
        }

        if(!str_contains($key, '.'))
        {
            return $array[$key] ?? value($default);
        }

        foreach(explode('.', $key) as $segment)
        {
            if(static::accessable($array, $key) && static::exists($array, $segment))
            {
                $array = $array[$segment];
            }
            else
            {
                return value($default);
            }
        }
        return $array;
    }

    public static function set(&$array, $key, $value)
    {
        if(is_null($key))
        {
            return array_push($array, $value);
        }

        $keys = explode('.', $key);
        while(count($keys) > 1)
        {
            $key = array_shift($keys);
            $array = &$array[$key];
        }

        $array[array_shift($keys)] = $value;
        return $array;
    }
}