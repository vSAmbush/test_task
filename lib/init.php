<?php

function autoload($className) {
    $lib_path = ROOT.DS.'lib'.DS.strtolower($className).'.php';
    $controller_path = ROOT.DS.'controllers'.DS.strtolower($className).'.php';
    $model_path = ROOT.DS.'models'.DS.strtolower($className).'.php';

    if (file_exists($lib_path)) {
        require_once($lib_path);
    } elseif (file_exists($controller_path)) {
        require_once($controller_path);
    } elseif (file_exists($model_path)) {
        require_once($model_path);
    } else {
        throw new Exception('Failed to require className '.$className);
    }
}

spl_autoload_register('autoload');

require_once (ROOT.DS.'config'.DS.'config.php');