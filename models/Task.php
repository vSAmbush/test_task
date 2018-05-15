<?php
namespace models;

class Task {

    public $id;

    public $username;

    public $email;

    public $task_body;

    public $img_path;

    public $status;

    /**
     * Task constructor.
     * @param $id
     * @param $username
     * @param $email
     * @param $task_body
     * @param null $img_path
     * @param int $status
     */
    public function __construct($id, $username, $email, $task_body, $img_path = null, $status = 0)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->task_body = $task_body;
        $this->img_path = $img_path;
        $this->status = $status;
    }
}