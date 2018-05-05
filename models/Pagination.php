<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 03.05.2018
 * Time: 17:19
 */

class Pagination
{
    public $buttons = [];

    public function __construct($options = [
        'itemsCount' => 9,
        'itemsPerPage' => 3,
        'currentPage' => 1,
        ])
    {
        $currentPage = $options['currentPage'];
        $itemsCount = $options['itemsCount'];
        $itemsPerPage = $options['itemsPerPage'];

        if(!$currentPage) {
            return;
        }

        $pageCount = ceil($itemsCount / $itemsPerPage);

        if($pageCount == 1) {
            return;
        }

        if($currentPage > $pageCount) {
            $currentPage = $pageCount;
        }

        $this->buttons[] = new Button($currentPage - 1, $currentPage > 1, 'Previous');

        for($i = 1; $i <= $pageCount; $i++) {
            $this->buttons[] = new Button($i, $currentPage != $i);
        }

        $this->buttons[] = new Button($currentPage + 1, $currentPage < $pageCount, 'Next');
    }
}