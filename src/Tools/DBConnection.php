<?php

namespace Hopcio\Apinbp\Tools;

use PDO;
use PDOException;

class DBConnection
{

    private string $username = "root";
    private string $password = "";
    private string $servername = "127.0.0.1";
    private PDO $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host={$this->servername};dbname=api_nbp", $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query(string $sql)
    {
        return $this->conn->query($sql)->fetchAll();
    }

    public function queryPrepared(string $sql, array $args)
    {
        $sth = $this->conn->prepare($sql);
        $sth->execute($args);
        return $sth->fetchAll();
    }

    public function execute(string $sql, array $values)
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($values);
    }
}
