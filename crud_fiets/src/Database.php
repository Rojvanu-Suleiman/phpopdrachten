<?php

declare(strict_types=1);

namespace App;

use PDO;
use PDOException;

class Database
{
    public static function connectDb(): PDO
    {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            return new PDO(
                'mysql:host=' . SERVERNAME . ';dbname=' . DATABASE . ';charset=utf8mb4',
                USERNAME,
                PASSWORD,
                $options
            );
        } catch (PDOException $e) {
            // Zelfde gedrag als de startcode: simpele foutmelding tonen
            die('Connection failed: ' . $e->getMessage());
        }
    }
}
