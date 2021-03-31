<?php
// Класс настроек //


namespace core\base\settings;


class Settings
{
    static private $_instance;

    private $routes = [
        'admin' => [
            'alias' => 'admin', // Alias административной панели//
            'path' => 'core/admin/controller/',  // Путь к файлам административной панели//
            'hrUrl' => false, // Human readable Url - понятный человеку Url//
            'routes' => [

            ]
        ],
        'settings' => [
            'path' => 'core/base/settings/'
        ],
        'plugins' => [
            'path' => 'core/plugins/',
            'hrUrl' => false,
            'dir' => false
        ],
        'user' =>[
            'path' => 'core/user/controller/',
            'hrUrl' => true,
            'routes' =>[
                'catalog' => 'site/hello/bye',// site/input/output  - контроллер/метод который собирает данные/метод который отдает данные. Если нет 1 или 2 метода, отдаётся дефолтный метод
                'article' => 'info/getArticle',
                'club'=> 'info/getClub'
            ]
        ],
        'default' => [
            'controller' => 'IndexController',
            'inputMethod' => 'inputData',
            'outputMethod' => 'outputData'
        ]
    ];

    private $templateArr = [
       'text' => ['name','phone','adress'],
        'textarea'=>['content','keywords']
    ];

    private $lalala = 'lalala';

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    static public function get($property){
        return self::instance()->$property;
    }

    static public function instance(){
        if (self::$_instance instanceof self){
        return self::$_instance;
        }
        return self::$_instance = new self;

    }

    public function glueProperties($class){
        $baseProperties = [];

        foreach ($this as $name => $item){
            $property = $class::get($name);

            if(is_array($property) && is_array($item)){
              //  $baseProperties[$name] = array_merge_recursive($this->$name, $property);  Рекурсивное объединение массивов (для массивов в составе массивов), но здесь не подходит, т.к. 2 значения с одинаковым ключом объединяются в массив //
               // $baseProperties[$name] = array_replace_recursive($this->$name, $property); Рекурсивное объединение массивов c заменой. Значения с одинаковым ключом перезаписываются //
                $baseProperties[$name] = $this->arrayMergeRecursive($this->$name, $property); //Пришлось написать свою функцию объединения массивов//
                continue;
            }

            if(!$property) $baseProperties[$name] = $this -> $name;
        }
        return $baseProperties;
    }

    public function arrayMergeRecursive(){
        $arrays = func_get_args();

        $base = array_shift($arrays);

        foreach ($arrays as $array){
            foreach ($array as $key => $value){
                if(is_array($value) && is_array($base[$key])){
                   $base[$key] = $this->arrayMergeRecursive($base[$key], $value);
                }else{
                    if(is_int($key)){
                        if(!in_array($value, $base)) array_push($base, $value);
                        continue;
                    }
                    $base[$key] = $value;
                }
            }
        }
        return $base;
    }
}