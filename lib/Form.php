<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 06.05.2018
 * Time: 16:49
 */
namespace lib;

abstract class Form
{
    public $error = '';

    /**
     * Loads array $_POST in attributes of form
     *
     * @param array $post
     * @return mixed
     */
    public abstract function load($post = []);
}