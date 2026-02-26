<?php

class Database
{

    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {

        if (self::$connection === null) {
            self::$connection = new PDO(
                "pgsql:host=localhost;dbname=user_management",
                "postgres",
                "admin",
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,]
            );
        }

        return self::$connection;
    }
}


?>