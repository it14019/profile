<?php

namespace App\Core;

use Medoo\Medoo;

class Database
{
    public static function database()
    {
        $database = new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'your_database_name',
            'server' => 'localhost',
            'username' => 'your_username',
            'password' => 'your_password'
        ]);
        return $database;
    }
}