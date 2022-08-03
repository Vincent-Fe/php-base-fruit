<?php
namespace models;

 use PDO;

    class Database
    {
        private static $pdo;

        private static function setBdd()
        {
            self::$pdo = new PDO('mysql:host=localhost;dbname=sql_base', 'root', 'root', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
            self::$pdo->exec("SET CHARACTER SET utf8");
        }

        protected function getBdd()
        {
            if (self::$pdo === null) {
                self::setBdd();
            }
            return self::$pdo;
        }
    }
