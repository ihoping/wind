<?php
/**
 * wind配置类
 * Date: 17-3-23
 */
namespace core\lib;

class conf
{
    public static function getConf($name)
    {
        //获取配置
        $conf = call_user_func(function () {
            return require CORE . '/config/config.php';
        });

        if (isset($conf[$name])) {
            return $conf[$name];
        } else {
            throw new \Exception('该配置不存在！');
        }
    }
}