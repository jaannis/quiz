<?php

namespace Quiz\Repositories;

use PDO;
use Quiz\Database\MysqlConnection;
use Quiz\Interfaces\ConnectionInterface;
use Quiz\Interfaces\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    /** @var ConnectionInterface */
    protected $connection;

    /**
     *
     */
//    public function connect()
//    {
//        $dsn              = "mysql:host=127.0.0.1;charset=utf8;dbname=vagrant";
//        $this->connection = new PDO($dsn, 'homestead', 'secret');
//    }

//    public function closeConnection()
//    {
//        $this->connection = null;
//    }

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        return $this->connection = new MysqlConnection();
    }

    public function getById(int $id, array $select = [])
    {
        $table     = static::getTableName();
        $data = $this->connection->select($table, ['id' => $id], $select);
//        $this->closeConnection();

        return $data;
    }
    public function getByCondition(int $id, string $select = '*')
    {
        $this->connect();
        $table     = static::getTableName();
        $sql       = "SELECT $select FROM $table WHERE id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$id]);
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        $this->closeConnection();

        return $data;
    }

}