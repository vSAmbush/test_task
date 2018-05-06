<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 03.05.2018
 * Time: 19:49
 */

class SQLHandler
{
    private static $pdo;

    /**
     * SQLHandler constructor.
     *
     * Create object of PDO to connection with database
     */
    public function __construct()
    {
        $config = Config::get('db');
        try {
            self::$pdo = new PDO($config['dsn'], $config['username'], $config['password'], $config['options']);
        } catch (PDOException $ex)
        {
            die($ex->getMessage());
        }
    }

    /**
     * Getting tasks from database
     *
     * @return array
     */
    public static function getTasks() {
        $stmt = self::$pdo->query('select username, email, task_body, img_path, task.status, task.id from task'
            .' inner join user on user.id = task.id_user');

        $result = [];
        while($row = $stmt->fetch()) {
            $result[] = $row;
        }

        return $result;
    }

    /**
     * Saving task in database
     *
     * @param $task
     * @return bool
     */
    public static function saveTask($task) {
        $stmt = self::$pdo->query("select id from user where user.username = '".$task->username."' and user.email = '".$task->email."'");

        if(!$stmt->fetch()) {
            self::$pdo->exec("insert into user (username, email, status) value ('".$task->username."', '".$task->email."', 0)");
        }

        $count = self::$pdo->exec("insert into task (id_user, task_body, img_path, status) value "
        ."((select id from user where user.username = '".$task->username."' and user.email = '".$task->email."'), '"
        .$task->task_body."', '".$task->img_path."', 0);");

        return ($count > 0) ? true : false;
    }

    /**
     * Getting object user by it's username in database
     *
     * @param $username
     * @param $password
     * @return bool|User
     */
    public static function getUserByUsername($username, $password) {
        $stmt = self::$pdo->query("select * from user WHERE username = '".$username."' and password_hash = sha1('".$password."')");

        $row = $stmt->fetch();

        if($row)
            $user = new User($row['id'], $row['username'], $row['password_hash'], $row['email'], $row['status']);

        return isset($user) ? $user : false;
    }

    /**
     * Updates tasks
     *
     * @param $id
     * @param $task_body
     * @param $status
     * @return bool
     */
    public static function updateTask($id, $task_body, $status) {
        $count = self::$pdo->exec("update task set task_body = '".$task_body."', status = ".(($status) ? 1 : 0)." where id = ".$id);

        return ($count > 0) ? true : false;
    }

    /**
     * Saving user in database
     *
     * @param $user
     * @return bool
     */
    public static function saveUser($user) {
        $count = self::$pdo->exec("insert into user (username, email, password_hash, status) value ('".$user->getUsername()."', '"
            .$user->getEmail()."', '".$user->getPassword()."', 1)");

        return ($count > 0) ? true : false;
    }
}