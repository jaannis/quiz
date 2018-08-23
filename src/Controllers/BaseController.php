<?php

namespace Quiz\Controllers;

abstract class BaseController
{
    protected $post;
    protected $get;
    protected $action;

    /**
     * @param string $action
     */
    public function handleCall(string $action)
    {
        $this->action = $action;
        $this->post   = $this->prepareParams($_POST);
        $this->get    = $this->prepareParams($_GET);
        $this->callAction($action);
    }

    /**
     * @param array $params
     * @return array
     */
    protected function prepareParams(array $params)
    {
        foreach ($params as $key => $value) {
            $params[$key] = htmlspecialchars($value);
        }
        return $params;
    }

    /**
     * @param $action
     */
    protected function callAction($action)
    {
        echo static::$action();
    }

    /**
     * @param string $view
     * @param array $variables
     * @return string
     */
    protected function render(string $view, array $variables = []): string
    {
        $viewFile = $this->resolveViewFile($view);
        if (file_exists($viewFile)) {
            extract($variables);
            ob_start();
            include "$viewFile";
            $output = ob_get_clean();

            return $output;
        }

        return 'View not found';
    }

    /**
     * @param string $view
     * @return string
     */
    protected function resolveViewFile(string $view): string
    {
        return VIEW_DIR."/$view.phtml";
    }
}