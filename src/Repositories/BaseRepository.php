<?php

namespace Quiz\Repositories;

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

    public function getList(): array
    {
        $table = static::getTableName();
        $data  = $this->connection->select($table);

        return $data;

    }

    public function all(array $conditions = []): array
    {
        $dataArray = $this->connection->select(static::getTableName(), $conditions);
        $instances = [];
        foreach ($dataArray as $data) {
            $instances[] = static::init($data);
        }

        return $instances;
    }

    public static function getPrimaryKey(): string
    {
        return 'id';
    }

    /**
     * @param array $attributes
     * @return BaseModel
     */
    public static function init(array $attributes)
    {
        $class    = static::modelName();
        $instance = new $class;
        foreach ($attributes as $key => $value) {
            if (property_exists($class, $key)) {
                $instance->$key = $value;
            }
        }

        return $instance;
    }

    /**
     * @param array $attributes
     * @return BaseModel
     */
    public static function initLoaded(array $attributes)
    {
        $instance        = static::init($attributes);
        $instance->isNew = false;

        return $instance;
    }

    /**
     * @param int $id
     * @return BaseModel
     */
    public function getById(int $id)
    {
        return $this->one(['id' => $id]);
    }

    /**
     * @param array $conditions
     * @return BaseModel
     */
    public function one(array $conditions = [])
    {
        $data = $this->connection->select(static::getTableName(), $conditions)[0] ?? [];
        if (!$data) {
            return null;
        }

        return static::initLoaded($data);
    }

    /**
     * @param BaseModel $model
     * @return string
     */
    public function save($model)
    {
        $connection = $this->connection;
        if ($model->isNew) {
            return $connection->insert(static::getTableName(), static::getPrimaryKey(), $this->getAttributes($model));
        }

        return $connection->update(static::getTableName(), static::getPrimaryKey(), $this->getAttributes($model));
    }

    /**
     * @param BaseModel $model
     * @return array
     */
    public function getAttributes($model): array
    {
        if (!$model->attributes) {
            $model = $this->prepareAttributes($model);
        }

        return $model->attributes;
    }

    /**
     * @param $model
     * @return BaseModel
     */
    protected function prepareAttributes($model)
    {
        $columns    = $this->connection->fetchColumns(static::getTableName());
        $attributes = [];
        foreach ($columns as $column) {
            $isExisting      = property_exists(static::modelName(), $column);
            $isExistingModel = property_exists($model, $column);
            if ($isExisting) {
                $attributes[$column] = $model->{$column};
            }
        }
        $model->attributes = $attributes;

        return $model;
    }

}