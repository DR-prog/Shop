<?php

/**
 * класс для взаимодействия с бд
 */
class DatabaseConnection
{
    private $host;
    private $username;
    private $password;
    private $database;
    private $connection;

    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function connect()
    {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);

        if (!$this->connection) {
            die("Ошибка подключения к базе данных: " . mysqli_connect_error());
        }
    }

    public function query($sql)
    {
        return mysqli_query($this->connection, $sql);
    }

    public function close()
    {
        mysqli_close($this->connection);
    }
}