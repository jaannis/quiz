<?php

namespace Quiz\Repositories;

use Quiz\Models\ResultsModel;

class ResultsRepository extends BaseRepository
{

    /**
     * @return string
     */
    public static function modelName(): string
    {
        return ResultsModel::class;
    }

    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return 'results';
    }
}