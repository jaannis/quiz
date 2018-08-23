<?php

namespace Quiz\Controllers;

class IndexController extends BaseController
{
    /**
     * @return string
     */
    public function indexAction()
    {

        return $this->render('index');
    }
}