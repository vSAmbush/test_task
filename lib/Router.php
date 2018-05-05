<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 01.05.2018
 * Time: 11:13
 */

class Router
{
    protected $uri;

    protected $controller;

    protected $action;

    protected $params;

    protected $route;

    protected $method_prefix;

    protected $language;

    /**
     * Router constructor.
     * @param $uri - request URI
     */
    public function __construct($uri)
    {
        $this->uri = urldecode(trim(str_replace('/test_task/', '', $uri)));

        //Get defaults
        $routes = Config::get('routes');
        $this->route = Config::get('default_rote');
        $this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
        $this->language = Config::get('default_language');
        $this->controller = ucfirst(Config::get('default_controller')).'Controller';
        $this->action = ucfirst(Config::get('default_action'));

        //Get uri without $_GET variables
        $uri_part = explode('?', $this->uri);

        //Get parts like controller/action/param1/...
        $path_part = explode('/', $uri_part[0]);

        if (count($path_part)) {

            //Get route or language at first element
            if(in_array(current($path_part), array_keys($routes))) {
                $this->route = strtolower(current($path_part));
                $this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
                array_shift($path_part);
            } elseif (in_array(strtolower(current($path_part)), Config::get('languages'))) {
                $this->language = current($path_part);
                array_shift($path_part);
            }

            //Get controller - next element of array
            if(current($path_part)) {
                $this->controller = ucfirst(current($path_part)).'Controller';
                array_shift($path_part);
            }

            //Get action
            if(current($path_part)) {
                $this->action = ucfirst(current($path_part));
                array_shift($path_part);
            }

            //Get params - all the rest
            $this->params = $path_part;
        }
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return mixed
     */
    public function getMethodPrefix()
    {
        return $this->method_prefix;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

}