<?php

defined('VG_ACCESS') or die('Пшёл нах');

const TEMPLATE = 'templates/default/';
const ADMIN_TEMPLATE = 'core/admin/view';

const COOKIE_VERSION = '1.0.0';
const CRYPT_KEY = '';
const COOKIE_TIME = 60;
const BLOCK_TIME = 3;

const QTY = 8;
const QTY_LINKS = 3;

const ADMIN_CSS_JS = [
    'styles' => [],
    'scripts' => []
];

const USER_CSS_JS = [
    'styles' => [],
    'scripts' => []
];

use core\base\exceptions\RouteException;

function autoloadMainClasses($class_name){
    $class_name = str_replace('\\', '/',$class_name);

    if(!@include_once $class_name . '.php'){
        throw new RouteException('Неверное имя файла для подключения - '.$class_name);  /*\core\base\exceptions\ - нежелательно, используем use перед функцией */
    }
}

spl_autoload_register('autoloadMainClasses');
