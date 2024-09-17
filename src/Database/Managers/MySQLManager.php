<?php

namespace Mali\Database\Managers;

use App\Models\Model;
use Mali\Database\Grammars\MySQLGrammar;
use Mali\Database\Managers\Contracts\DatabaseManager;
use PDO;

class MySQLManager implements DatabaseManager
{
    public static $instance;

    public function connect(): PDO
    {
        if(!self::$instance)
        {
            self::$instance = new PDO(env('DB_DRIVER') . ":host=" . env('DB_HOST') . ";dbname=" . env('DB_DATABASE'), env('DB_USERNAME'), env('DB_PASSWORD'));
        }
        return self::$instance;
    }

    public function query(string $query, $values = [])
    {
        $stat = self::$instance->prepare($query);
        for($i = 1; $i <= count($values); $i++)
        {
            $stat->bindValue($i, $values[$i - 1]);
        }

        $stat->execute();

        return $stat->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = MySQLGrammar::buildInsertQuery(array_keys($data));

        $stat = self::$instance->prepare($query);

        for($i = 1; $i <= count($values = array_values($data)); $i++)
        {
            $stat->bindValue($i, $values[$i-1]);
        }

        return $stat->execute();
    }

    public function read($columns = "*", $filter = null)
    {
        $query = MySQLGrammar::buildSelectQuery($columns, $filter);
        $stat = self::$instance->prepare($query);
        if($filter)
        {
            $stat->bindValue(1, $filter[2]);
        }
        $stat->execute();
        return $stat->fetchAll(PDO::FETCH_CLASS, Model::getModel());
    }

    public function update($attributes, $filter)
    {
        $query = MySQLGrammar::buildUpdateQuery(array_keys($attributes), $filter);
        $stat = self::$instance->prepare($query);
        for($i = 1; $i <= count($values = array_values($attributes)); $i++)
        {
            $stat->bindValue($i, $values[$i -1]);
            if($i == count($attributes))
            {
                if($filter)
                {
                    $stat->bindValue($i + 1 , $filter[2]);
                }
            }
        }
        return $stat->execute();
        
    }

    public function delete($filter)
    {
        $query = MySQLGrammar::buildDeleteQuery($filter);
        $stat = self::$instance->prepare($query);
        $stat->bindValue(1, $filter[2]);
        return $stat->execute();
    }

    public function deleteIn($column, array $data)
    {
        if(!empty($data))
        {
            $query = MySQLGrammar::buildDeleteInQuery($column, $data);
            $stat = self::$instance->prepare($query);
            for($i = 1; $i <= count($values = array_values($data)); $i++)
            {
                $stat->bindValue($i, $values[$i - 1]);
            }
            return $stat->execute();
        }
    }
}