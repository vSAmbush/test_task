<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 05.05.2018
 * Time: 14:53
 */

class User
{
    private $id;

    private $username;

    private $email;

    private $password_hash;

    private $status;

    /**
     * User constructor.
     * @param $id
     * @param $username
     * @param $password
     * @param null $email
     * @param null $status
     */
    public function __construct($id, $username, $password, $email = null, $status = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->setPassword($password);
        $this->status = $status;
    }

    /**
     * Hashing password and save it
     *
     * @param $password
     */
    public function setPassword($password) {
        $this->password_hash = sha1(trim($password));
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password_hash;
    }
}