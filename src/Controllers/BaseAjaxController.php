<?php

namespace Quiz\Controllers;

abstract class BaseAjaxController extends BaseController
{
    /**
     * @param $action
     */
    public function callAction($action)
    {
        $content = static::$action();
        header('Content-Type:application/json; charset=UTF8');
        echo json_encode(['result' => $content], JSON_UNESCAPED_UNICODE);
    }

}