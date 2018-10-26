<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 05.05.2018
 * Time: 14:13
 */
namespace handlers;

use helpers\SQLHandler;
use lib\App;
use lib\Form;

class LoginForm extends Form
{
    public $username;

    public $password;

    /**
     * @param array $post - array $_POST
     * @return bool
     */
    public function load($post = []) {
        $this->username = isset($post['username']) ? $post['username'] : null;
        $this->password = isset($post['password']) ? $post['password'] : null;

        if(empty($this->username) || empty($this->password)) {
            $this->error = 'All fields must be required';
            return false;
        }

        return true;
    }

    /**
     * Checking user log in
     */
    public function login() {
        $user = SQLHandler::getUserByUsername($this->username, $this->password);

        if($user) {
            setcookie('loginUser', serialize($user), time() + 3600);
            $this->error = 'Success';
            header('Location:'.App::$test_path.'/page/index');
        } else {
            $this->error = 'Incorrect username or password';
        }
    }
}