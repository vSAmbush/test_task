<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 01.05.2018
 * Time: 19:00
 */

Config::set('site_name', 'MVC TASK');

Config::set('languages', ['en', 'ru']);

//Database. Parameter name => it's value
Config::set('db', [
    'dsn' => 'mysql:host=127.0.0.1;dbname=tasks;charset=utf8',
    'username' => 'root',
    'password' => 'root',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ],
]);

//Routes. Route name => method_prefix
Config::set('routes', [
    'default' => 'action',
    'admin' => 'action',
]);

Config::set('default_rote', 'default');
Config::set('default_language', 'en');
Config::set('default_controller', 'page');
Config::set('default_action', 'index');