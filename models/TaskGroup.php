<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 03.05.2018
 * Time: 21:07
 */

class TaskGroup
{
    private $tasks;

    private $page;

    private $criteria;

    /**
     * TaskGroup constructor.
     * @param $page - number of page
     * @param $criteria
     */
    public function __construct($page, $criteria = null)
    {
        $task_array = SQLHandler::getTasks();
        $this->tasks = [];
        $this->page = $page;

        //filling array of task objects
        for($i = 0; $i < count($task_array); $i++) {
            $this->tasks[$i] = new Task(
                $task_array[$i]['id'],
                $task_array[$i]['username'],
                $task_array[$i]['email'],
                $task_array[$i]['task_body'],
                $task_array[$i]['img_path'],
                $task_array[$i]['status']);
        }

        if($criteria) {
            $this->setCriteria($criteria);
            $this->sort();
        }
    }

    /**
     * @param $itemsCount
     * @return array
     */
    public function getItemsPerPage($itemsCount) {
        $result = [];
        $count = $this->page * $itemsCount;

        for($i = $count - $itemsCount; $i < (($count <= count($this->tasks)) ? $count : count($this->tasks)); $i++)
            $result[] = $this->tasks[$i];

        return $result;
    }

    /**
     * @return array
     */
    public function getTasks(): array
    {
        return $this->tasks;
    }

    /**
     * @return int
     */
    public function getCount() {
        return count($this->tasks);
    }

    /**
     * @param string $criteria
     */
    public function setCriteria($criteria): void
    {
        $this->criteria = $criteria;
    }

    private function cmp($a, $b) {

        switch ($this->criteria) {
            case 'username':
                return strcmp($a->username, $b->username);
                break;
            case 'email':
                return strcmp($b->email, $a->email);
                break;
            case 'status':
                if($a->status == $b->status)
                    return 0;
                return ($a->status < $b->status) ? 1 : -1;
                break;
        }
    }

    public function sort() {
        usort($this->tasks, ['TaskGroup', 'cmp']);
    }
}