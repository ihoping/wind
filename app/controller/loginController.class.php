<?php
/**
 * Date: 17-3-25
 */
namespace app;

use core\lib\mongoModel;

class loginController extends \core\lib\Controller
{
    public function login()
    {
        /*如果用户选择了自动登录功能，则设置cookie有效期为一星期*/
        if ($_POST['autoLogin'] == '1') {
            setcookie('username', $_POST['username'], time() + 604800, '/wind/');
            setcookie('password', md5($_POST['password']), time() + 604800, '/wind/');
        }

        /*验证码判断*/
        if (strtolower($_SESSION['vCode']) != strtolower($_POST['vCode'])) {
            echo 'vCode_error';
            $_SESSION['vCode'] = rand();//验证码验证失败后，原验证码失效
            exit(0);
        }

        /*用户信息正确与否*/
        $model = new mongoModel('wind', 'users');
        $name = $model->findOne('name', $_POST['username']);
        if (!empty($name)) {
            if ($name['password'] == md5($_POST['password'])) {


                $_SESSION['username'] = $_POST['username'];
                $_SESSION['userId'] = (String)$name['_id'];
                echo 'success';
            } else
                echo 'password_error';
        } else {
            echo 'user_error';
        }
    }
}