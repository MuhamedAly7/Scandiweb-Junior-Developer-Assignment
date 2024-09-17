<?php

namespace Mali\Database\Concerns;

use Mali\Database\Managers\Contracts\DatabaseManager;

trait ConnectsTo
{
    public static function connect(DatabaseManager $manager)
    {
        return $manager->connect();
    }
}