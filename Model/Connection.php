<?php

namespace Model;

use PDO;
use PDOException;

class Connection
{
    private static ?PDO $connection = null;

    public static function getInstance(): PDO {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO(
                    'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4',
                    DB_USER,
                    DB_PASSWORD,
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );
            } catch (PDOException $error) {
                die('Erro na conexão: ' . $error->getMessage());
            }
        }

        return self::$connection;
    }
}
