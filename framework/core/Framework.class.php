<?php
/**
 * Created by PhpStorm.
 * User: mayingbing
 * Date: 16/5/9
 * Time: 11:08
 * 核心启动类
 */

class Framework {
    public static function run(){
        //echo "hello world";
        // echo getcwd();
        self::init();
        self::autoload();
        self::dispatch();

    }
    private static function init(){
        //定义路径常量
        define("DS", DIRECTORY_SEPARATOR);
        define("ROOT", getcwd() . DS ); //根目录
        define("APP_PATH", ROOT . 'application' . DS);
        define("FRAMEWORK_PATH", ROOT . "framework" .DS);
        define("PUBLIC_PATH", ROOT . "public" .DS);
        define("CONFIG_PATH", APP_PATH . "config" .DS);
        define("CONTROLLER_PATH", APP_PATH . "controllers" .DS);
        define("MODEL_PATH", APP_PATH . "models" .DS);
        define("VIEW_PATH", APP_PATH . "views" .DS);
        define("CORE_PATH", FRAMEWORK_PATH . "core" .DS);
        define("DB_PATH", FRAMEWORK_PATH . "databases" .DS);
        define("LIB_PATH", FRAMEWORK_PATH . "libraries" .DS);
        define("HELPER_PATH", FRAMEWORK_PATH . "helpers" .DS);
        define("UPLOAD_PATH", PUBLIC_PATH . "uploads" .DS);
        //获取参数p、c、a,index.php?p=admin&c=goods&a=add GoodsController中的addAction
        define('PLATFORM',isset($_GET['p'])?$_GET['p']:"admin");
        define('CONTROLLER',isset($_GET['c'])? ucfirst($_GET['c']) : "Index");
        define('ACTION',isset($_GET['a']) ? $_GET['a'] :"index");
        //设置当前控制器和视图目录 CUR-- current
        define("CUR_CONTROLLER_PATH",CONTROLLER_PATH . PLATFORM .DS);
        define("CUR_VIEW_PATH",VIEW_PATH .PLATFORM .DS);


    }
    private static function dispatch(){
        $controller_name = CONTROLLER."Controller";
        $action_name = ACTION ."Action";
        $controller = new $controller_name();
        $controller->$action_name();
    }
    private static function load($classname){
        if(substr($classname,-10)=='Controller'){
            include CUR_CONTROLLER_PATH . "{$classname}.class.php";
        }elseif(substr($classname,-5)=='Model'){
            include MODEL_PATH ."{$classname}.class.php";
        }else{

        }
    }
    private static function autoload(){
        $arr = array(__CLASS__,'load');//__CLASS__，是魔术常量，表示当前类名。
        spl_autoload_register($arr);
    }
}