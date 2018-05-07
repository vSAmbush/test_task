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

    private $extensions = ['png', 'jpg', 'jpeg', 'tiff', 'gif', 'bmp']; //add here access extensions for image files

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

            //check for extension of file
            $img_path_parts  = explode('.', $this->img_path);
            if(!array_search($img_path_parts[count($img_path_parts) - 1], $this->extensions)) {
                $this->error = 'The uploaded file must have next extensions: ';
                foreach ($this->extensions as $extension) {
                    $this->error .= ' .'.$extension;
                }
                return false;
            }

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