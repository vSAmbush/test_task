<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 02.05.2018
 * Time: 13:12
 */

class App
{
    protected static $router;

    protected static $sqlHandler;

    public static $user;

    /**
     * Main function
     *
     * @param $uri
     * @throws Exception
     */
    public static function run($uri) {
        self::$router = new Router($uri);
        self::$sqlHandler = new SQLHandler();
        self::$user = isset($_COOKIE['loginUser']) ? unserialize($_COOKIE['loginUser']) : null;

        self::logout();

        $controller_name = self::$router->getController();
        $controller_action = self::$router->getMethodPrefix().self::$router->getAction();

        $controller_obj = new $controller_name();

        //Calling controller's method
        if(method_exists($controller_obj, $controller_action)) {
            //Controller's action may return view's path
            $view_path = $controller_obj->$controller_action();
            $view_obj = new View($controller_obj->getData(), $view_path);
            $content = $view_obj->render();
        }
        else {
            throw new Exception('Method '.$controller_action.' of class '.$controller_name.' doesn\'t exist');
        }

        $layout_path = VIEWS_PATH.DS.'layouts'.DS.'default.php';
        $layout_view_obj = new View(compact('content'), $layout_path);
        echo $layout_view_obj->render();
    }

    /**
     * @return object of class Router
     */
    public static function getRouter() {
        return self::$router;
    }

    /**
     * @return object of SQLHandler
     */
    public static function getSqlHandler()
    {
        return self::$sqlHandler;
    }

    /**
     * Log out user
     */
    private static function logout() {
        if(isset($_GET['action'])) {
            unset($_COOKIE['loginUser']);
            setcookie('loginUser', '', time() - 3600);
            self::$user = null;
            header('Location: /test_task/page/index');
        }
    }
}