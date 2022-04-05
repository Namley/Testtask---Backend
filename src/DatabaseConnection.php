<?php

namespace App;

use mysqli;

class DatabaseConnection
{
    private $connection;
    private $user;
    private $password;
    private $database;
    private $host;

    public function __construct(string $user, string $password, string $database, string $host)
    {
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
        $this->host = $host;

        $this->connection = new Mysqli($this->host, $this->user, $this->password, $this->database);
        $this->connection->set_charset('utf8');
    }

    public function getConnection(): mysqli
    {
        if ($this->connection === null) {
            throw new \RuntimeException('No connection available');
        }

        return $this->connection;
    }
}