<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 05.05.2018
 * Time: 20:31
 */

class AdminForm
{
    public $id;

    public $task_body;

    public $status;

    public $error = '';

    /**
     * @param array $post
     * @param $id
     * @return bool
     */
    public function load($post = [], $id) {
        $this->id = $id;
        $this->task_body = isset($post['task_body']) ? $post['task_body'] : null;
        $this->status = isset($post['status']) ? $post['status'] : false;

        if(empty($this->task_body)) {
            $this->error = 'Task body must be required';
            return false;
        }

        return true;
    }

    /**
     * Saving changing of task
     *
     * @return bool
     */
    public function save() {

        if(!SQLHandler::updateTask($this->id, $this->task_body, $this->status)) {
            $this->error = 'Failed updating';
            return false;
        }

        return true;
    }
}