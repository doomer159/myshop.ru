<?php

/* Определяем константу безопасности */

define('VG_ACCESS', true);

header('Content-Type:text/html;charset=utf-8');
session_start();

require_once 'config.php';
require_once 'core/base/settings/internal_settings.php';


use core\base\exceptions\RouteException;
use core\base\controller\RouteController;

try{
    RouteController::getInstance()->route(); //Вызов статического метода у класса BaseController/RouteController//
   // RouteController::getInstance();
}
catch (RouteException $e){
    exit($e->getMessage());
}
