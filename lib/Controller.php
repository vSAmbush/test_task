<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 02.05.2018
 * Time: 13:18
 */

class Controller
{
    protected $data;

    protected $params;

    /**
     * Controller constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->data = $data;
        $this->params = App::getRouter()->getParams();
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }


}