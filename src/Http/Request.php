<?php

namespace Mali\Http;

use Mali\Support\Arr;

class Request
{
    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function path()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';

        return str_contains($path, "?") ? explode('?', $path)[0] : $path;

    }

    public function options()
    {
        $path = $_SERVER['REQUEST_URI'];

        $options = str_contains($path, "?") ? explode('?', $path)[1] : "";

        $pairs = strlen($options) > 0 ? (str_contains($options, '&') ?  explode(';', $options) : (array)$options) : [];
        $data = [];

        foreach($pairs as $pair)
        {
            list($key, $value) = explode('=', $pair);
            $data[$key] = $value;
        }
        return array_values($data);
    }

    public function all() : array
    {
        return $_REQUEST;
    }

    public function only($keys)
    {
        return Arr::only($this->all(), $keys);
    }

    public function get($key)
    {
        return Arr::get($this->all(), $key);
    }
}