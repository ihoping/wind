<?php
/**
 * Date: 17-3-28
 */
namespace app;

use core\lib\mongoModel;

class registerController extends \core\lib\Controller
{
    public function register()
    {
        if (strtolower($_SESSION['vCode']) != strtolower($_POST['vCode'])) {
            echo 'vCode_error';
            $_SESSION['vCode'] = rand();//验证码验证失败后，原验证码失效
            exit(0);
        }

        $model = new mongoModel('wind', 'users');
        $name = $model->findOne('name', $_POST['username']);

        /*判断用户名是否存在*/
        if (!empty($name)) {
            echo 'user_exist';
        } else {
            $userInformation = array(
                'name' => $_POST['username'],
                'password' => md5($_POST['password']),
                'email' => '',
                'status' => '1',
                'headerImage' => 'http://' . $_SERVER["SERVER_NAME"] . '/wind/app/common/images/defaultProfile.png',
                'follows' => array(),
                'created_time' => date("Y-m-d H:i:s"),
                'fans' => array()
            );

            /*得到插入结果*/
            $insertResult = $model->insert($userInformation);
            if ($insertResult) {
                echo 'success';
            }
        }
    }
}