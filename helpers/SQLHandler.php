<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 03.05.2018
 * Time: 19:49
 */
namespace helpers;

use lib\Config;
use models\User;
use PDOException;

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
            self::$pdo = new \PDO($config['dsn'], $config['username'], $config['password'], $config['options']);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    /**
     * Getting tasks from database
     *
     * @return array
     */
    public static function getTasks() {
        try {
            $stmt = self::$pdo->prepare('select username, email, task_body, img_path, task.status, task.id from task'
                .' inner join user on user.id = task.id_user');
            $stmt->execute();
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }

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
        try {
            $stmt = self::$pdo->prepare('select id from user where user.username = ? and user.email = ?');
            $stmt->execute([$task->username, $task->email]);

            if (!$stmt->fetch()) {
                $stmt = self::$pdo->prepare('insert into user (username, email, status) value (?, ?, 0)');
                $stmt->execute([$task->username, $task->email]);
            }

            $stmt = self::$pdo->prepare('insert into task (id_user, task_body, img_path, status) value '
                .'( (select id from user where user.username = ? and user.email = ?), ?, ?, 0)');
            $stmt->execute([$task->username, $task->email, $task->task_body, $task->img_path]);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }

        return ($stmt->rowCount() > 0) ? true : false;
    }

    /**
     * Getting object user by it's username in database
     *
     * @param $username
     * @param $password
     * @return bool|User
     */
    public static function getUserByUsername($username, $password) {
        $stmt = self::$pdo->prepare("select * from user WHERE username = ? and password_hash = sha1(?)");
        $stmt->execute([$username, $password]);

        $row = $stmt->fetch();

        if($row)
            $user = new User($row['id'], $row['username'], $row['password_hash'], $row['email'], $row['status']);

        return isset($user) ? $user : false;
    }

    /**
     * Updates tasks in admin page
     *
     * @param $id
     * @param $task_body
     * @param $status
     * @return bool
     */
    public static function updateTask($id, $task_body, $status) {
        $stmt = self::$pdo->prepare('update task set task_body = ?, status = ? where id = ?');
        $stmt->execute([$task_body, ($status) ? 1 : 0, $id]);

        return ($stmt->rowCount() > 0) ? true : false;
    }

    /**
     * Saving user in database
     *
     * @param $user
     * @return bool
     */
    public static function saveUser($user) {
        $stmt = self::$pdo->prepare("insert into user (username, email, password_hash, status) value (?, ?, ?, 1)");
        $stmt->execute([$user->getUsername(), $user->getEmail(), $user->getPassword()]);

        return ($stmt->rowCount() > 0) ? true : false;
    }
}