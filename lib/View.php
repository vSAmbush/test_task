<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 02.05.2018
 * Time: 14:22
 */
namespace lib;

use Exception;

class View
{
    protected $data;

    protected $path;

    /**
     * View constructor.
     * @param array $data
     * @param null $path
     * @throws Exception
     */
    public function __construct($data = [], $path = null) {
        if(!$path) {
            $path = self::getDefaultViewPath();
        }
        elseif(!file_exists($path)) {
            throw new Exception('Template file is not found in path '.$path);
        }
        $this->data = $data;
        $this->path = $path;
    }

    /**
     * @return string
     * @throws Exception
     */
    public static function getDefaultViewPath() {
        $router = App::getRouter();
        if(!$router) {
            throw new Exception('Object "router" is not exist');
        }
        $controller_dir = str_replace('controller', '', strtolower($router->getController()));
        $view_name = strtolower($router->getAction()).'.php';
        return VIEWS_PATH.DS.$controller_dir.DS.$view_name;
    }

    /**
     * Displays the page in path
     * @return string
     */
    public function render() {
        $data = $this->data;

        ob_start();
        include($this->path);
        $content = ob_get_clean();

        return $content;
    }
}