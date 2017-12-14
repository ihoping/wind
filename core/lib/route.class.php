<?php
/**
 * wind路由类
 * Date: 17-3-21
 */
namespace core\lib;

class route
{
    public $controller;//控制器名
    public $action;//方法名

    /*
     * 直接在构造函数里从url中解析出控制器和方法、data
     */
    public function __construct()
    {
        //获取控制器和方法、数据
        if (isset($_SERVER['PATH_INFO'])) {
            $path = trim($_SERVER['PATH_INFO'], '/');
            $pathArr = explode('/', $path);
            $this->controller = $pathArr[0];

            if (isset($pathArr[1])) {
                $this->action = $pathArr[1];
            } else {
                $this->action = conf::getConf('DEFAULT_ACT');
            }

            //获取get数据
            unset($pathArr[0]);
            unset($pathArr[1]);
            $i = 2;
            $count = count($pathArr) + 2;
            while ($i < $count) {
                if (isset($pathArr[$i + 1])) {
                    $_GET[$pathArr[$i]] = $pathArr[$i + 1];
                }
                $i = $i + 2;
            }
        } else {
            $this->controller = conf::getConf('DEFAULT_CTL');
            $this->action = conf::getConf('DEFAULT_ACT');
        }
    }
}
