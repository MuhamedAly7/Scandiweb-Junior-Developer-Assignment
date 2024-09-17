<?php

namespace Mali\Database;

use Mali\Database\Managers\Contracts\DatabaseManager;
use Mali\Database\Concerns\ConnectsTo;

class DB
{
    protected DatabaseManager $manager;

    public function __construct(DatabaseManager $manager)
    {
        $this->manager = $manager;
    }

    public function init()
    {
        ConnectsTo::connect($this->manager);
    }

    protected function raw(string $query, $value = [])
    {
        return $this->manager->query($query, $value);
    }

    protected function create(array $data)
    {
        return $this->manager->create($data);
    }

    protected function read($columns = '*', $filter = null)
    {
        return $this->manager->read($columns, $filter);
    }

    protected function delete($filter)
    {
        return $this->manager->delete($filter);
    }

    protected function update($attributes, $filter)
    {
        return $this->manager->update($attributes, $filter);
    }

    protected function deleteIn($column, array $data)
    {
        return $this->manager->deleteIn($column, $data);
    }

    public function __call($name, $arguments)
    {
        if(method_exists($this, $name))
        {
            return call_user_func_array([$this, $name], $arguments);
        }
    }
}