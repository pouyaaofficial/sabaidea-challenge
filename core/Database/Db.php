<?php

namespace Core\Database;

use PDO;
use PDOException;

final class Db
{
    use HasTransaction;

    private static $instance = null;
    private $connection = null;

    private function __construct()
    {
        $this->connect();
    }

    public static function init(): static
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function select($query, $params = [])
    {
        return $this->query($query, $params);
    }

    public function first($query, $params = [])
    {
        return $this->query($query, $params)[0] ?? null;
    }

    public function insert($query, $params = [])
    {
        $command = $this->connection->prepare($query);

        foreach ($params as $key => $value) {
            $command->bindValue(":$key", $value);
        }

        $command->execute();

        return $this->connection->lastInsertId();
    }

    public function update($query, $params = [])
    {
        $command = $this->connection->prepare($query);

        foreach ($params as $key => $value) {
            $command->bindValue(":$key", $value);
        }

        return $command->execute();
    }

    public function query($query, $params = [])
    {
        $command = $this->connection->prepare($query);

        foreach ($params as $key => $value) {
            $command->bindValue(":$key", $value);
        }

        $command->execute();

        return $command->fetchAll();
    }

    private function connect()
    {
        try {
            $this->connection = new PDO($this->getConnectionString(), getenv('DB_USER'), getenv('DB_PASSWORD'));
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            exit('Connection failed: '.$e->getMessage());
        }
    }

    private function getConnectionString()
    {
        $host = getenv('DB_HOST');
        $db = getenv('DB_DATABASE');

        return "mysql:host=$host;dbname=$db";
    }
}
