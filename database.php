<?php

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $config = parse_ini_file('config.ini');
        $this->pdo = new PDO("sqlite:" . $config['path']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
}
