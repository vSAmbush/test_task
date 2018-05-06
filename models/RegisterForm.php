<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 06.05.2018
 * Time: 15:47
 */

class RegisterForm extends Form
{
    public $username;

    public $email;

    public $password;

    public $repeat_password;

    /**
     * @param array $post
     * @return bool
     */
    public function load($post = []) {
        $this->username = isset($post['username']) ? $post['username'] : null;
        $this->email = isset($post['email']) ? $post['email'] : null;
        $this->password = isset($post['password']) ? $post['password'] : null;
        $this->repeat_password = isset($post['repeat_password']) ? $post['repeat_password'] : null;

        if(empty($this->username) || empty($this->username) || empty($this->username) || empty($this->username)) {
            $this->error = 'All fields must be required';
            return false;
        }

        if(!preg_match('/[a-zа-я_-]+$/iu', $this->username)) {
            $this->error = 'Invalid username';
            return false;
        }

        if(!preg_match('/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/', $this->email)) {
            $this->error = 'Invalid email';
            return false;
        }

        if(!preg_match('/[a-z0-9.+_-]+$/i', $this->password)) {
            $this->error = 'Invalid password';
            return false;
        }

        if(!preg_match('/[a-z0-9.+_-]+$/i', $this->repeat_password)) {
            $this->error = 'Invalid repeated password';
            return false;
        }

        if($this->password !== $this->repeat_password) {
            $this->error = 'Repeated password must be equal password';
            return false;
        }

        return true;
    }

    /**
     * Registers user in database
     */
    public function saveUser() {
        if(SQLHandler::saveUser(new User(null, $this->username, $this->password, $this->email, 1))) {
            $this->error = "Success";
        }
        else
            $this->error = "Failed saving user";
    }
}