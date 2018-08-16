<?php

namespace Quiz\Repositories;

use PDO;
use Quiz\Database\MysqlConnection;
use Quiz\Interfaces\ConnectionInterface;
use Quiz\Interfaces\RepositoryInterface;
use Quiz\Models\BaseModel;

abstract class BaseRepository implements RepositoryInterface
{
    /** @var ConnectionInterface */
    protected $connection;

    /**
     * BaseRepository constructor.
     */
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
        $table = static::getTableName();
        $data  = $this->connection->select($table, ['id' => $id], $select);

        return $data;
    }
    public function getList(): array
    {
        $table = static::getTableName();
        $data  = $this->connection->select($table);

        return $data;

    }
    public function addModel($model)
    {
        $table = static::getTableName();
        $data  = $this->connection->insert($table, 'id', $model);

        return $data;

    }
    public static function getPrimaryKey(): string
    {
        return 'id';
    }

    /**
     * @param array $attributes
     * @return BaseModel
     */
//    public static function init(array $attributes)
//    {
//        $class    = static::modelName();
//        $instance = new $class;
//        foreach ($attributes as $key => $value) {
//            if (property_exists($class, $key)) {
//                $instance->$key = $value;
//            }
//        }
//
//        return $instance;
//    }
//
//    /**
//     * @param array $attributes
//     * @return BaseModel
//     */
//    public static function initLoaded(array $attributes)
//    {
//        $instance        = static::init($attributes);
//        $instance->isNew = false;
//
//        return $instance;
//    }
//
//    /**
//     * @param int $id
//     * @return BaseModel
//     */
//    public function getById(int $id)
//    {
//        return $this->one(['id' => $id]);
//    }
//
//    /**
//     * @param array $conditions
//     * @return BaseModel
//     */
//    public function one(array $conditions = [])
//    {
//        $data = $this->connection->select(static::getTableName(), $conditions)[0] ?? [];
//        if (!$data) {
//            return null;
//        }
//
//        return static::initLoaded($data);
//    }
//
//    /**
//     * @param BaseModel $model
//     * @return bool
//     */
//    public function save($model): bool
//    {
//        $connection = $this->connection;
//        if ($model->isNew) {
//            return $connection->insert(static::getTableName(), static::getPrimaryKey(), $this->getAttributes($model));
//        }
//
//        return $connection->update(static::getTableName(), static::getPrimaryKey(), $this->getAttributes($model));
//    }
//
//    /**
//     * @param BaseModel $model
//     * @return array
//     */
//    public function getAttributes($model): array
//    {
//        if (!$model->attributes) {
//            $model = $this->prepareAttributes($model);
//        }
//
//        return $model->attributes;
//    }
//
//    /**
//     * @param $model
//     * @return BaseModel
//     */
//    protected function prepareAttributes($model)
//    {
//        $columns    = $this->connection->fetchColumns(static::getTableName());
//        $attributes = [];
//        foreach ($columns as $column) {
//            if (property_exists(static::modelName(), $column)) {
//                $attributes[$column] = $model->{$column};
//            }
//        }
//        $model->attributes = $attributes;
//
//        return $model;
//    }

}