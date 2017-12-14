<?php
/**
 * Date: 17-3-21
 * wind核心类
 */
namespace core;

use core\lib\route;

class wind
{
    /*
     * 框架的主要入口文件
     * 解析出控制器和方法并执行
     */
    static public function run()
    {
        require_once APP . '/common/functions.php';
        $route = new route();//加载路由类
        $controller = $route->controller;
        $action = $route->action;
        $controllerFile = WIND . '/app/controller/' . $controller . 'Controller.class.php';
        if (is_file($controllerFile)) {
            include WIND . '/app/controller/' . $controller . 'Controller.class.php';
            $ctlStr = '\app\\' . $controller . 'Controller';//控制器
            $ctlClass = new $ctlStr();

            //执行方法
            $ctlClass->$action();

        } else {
            throw new \Exception('找不到控制器' . $controller);
        }

    }

    /*
     * 框架自动加载
     * new一个对象却找不到类时调用
     */
    static public function load($class)
    {
        //自动加载类库
        $class = str_replace('\\', '/', $class);
        $file = WIND . '/' . $class . '.class.php';
        if (is_file($file)) {
            include $file;
        } else {
            return false;
        }
    }
}