<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 04.05.2018
 * Time: 21:00
 */

class AddTaskForm extends Form
{
    public $username;

    public $email;

    public $task_body;

    public $img_path;

    private $target_path = '/test_task/resources/img';

    /**
     * @param array $post - array $_POST
     * @param null $file
     * @return bool
     */
    public function load($post = [], $file = null) {
        $this->username = isset($post['username']) ? $post['username'] : null;
        $this->email = isset($post['email']) ? $post['email'] : null;
        $this->task_body = isset($post['task_body']) ? $post['task_body'] : null;

        if($file['img_path']['name']) {
            $this->img_path = $this->target_path.'/'.basename($file['img_path']['name']);
            if(!move_uploaded_file($file['img_path']['tmp_name'], ROOT.DS.'resources'.DS.'img'.DS.basename($file['img_path']['name']))) {
                $this->error = 'File is not uploaded';
                return false;
            }
        }

        if(empty($this->username) || empty($this->email) || empty($this->task_body)) {
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

        return true;
    }

    /**
     * Saving a new task
     */
    public function saveTask() {
        if(SQLHandler::saveTask(new Task(null, $this->username, $this->email, $this->task_body, empty($this->img_path) ? null : $this->img_path)))
            $this->error = 'Success';
        else
            $this->error = 'Failed saving task';
    }
}