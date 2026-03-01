<?php

require_once __DIR__ . '/../exceptions/DatabaseConnectionException.php';

class Database
{

    private static ?PDO $connection = null;

    public static function getConnection(): PDO|null
    {
        try {
            if (self::$connection === null) {
                self::$connection = new PDO(
                    "mysql:host=localhost;dbname=user_managemen;charset=utf8",
                    "root",
                    "admin",
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,]
                );
            }
            return self::$connection;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new DatabaseConnectionException("Database connection failed: ");
        }
    }
}


?>