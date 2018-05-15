<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 03.05.2018
 * Time: 17:16
 */
namespace helpers;

class Button
{
    protected $page;

    public $isActive;

    protected $text;

    public function __construct($page, $isActive, $text = null)
    {
        $this->page = $page;
        $this->text = is_null($text) ? $page : $text;
        $this->isActive = $isActive;
    }

    /**
     * @return string
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
}