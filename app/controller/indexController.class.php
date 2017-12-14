<?php
/**
 * Date: 17-3-21
 */
namespace app;

use app\lib\Verify;
use core\lib\Controller;
use core\lib\mongoModel;

class indexController extends Controller
{
    /*默认首页*/
    public function index()
    {

        $model = new mongoModel('wind', 'articles');
        $articles = $model->findAll('技术', -1, 0);

        $clModel = new mongoModel('wind', 'classifys');
        $clDocument = $clModel->find(1);//获取分类

        $this->assign('prePage', 0);
        $this->assign('nextPage', 1);
        $this->assign('classifys', $clDocument);
        $this->assign('classifyName', '技术');
        $this->assign('articles', $articles);

        $this->display('index.php');
    }

    /*显示登录界面*/
    public function login()
    {
        $this->display('login.php');
    }


    /*获取验证码*/
    public function verify()
    {
        $verify = new Verify();
        $verify->doimg();
    }

    /*登出*/
    public function logout()
    {
        unset($_SESSION['username']);
        unset($_SESSION['userId']);
        setcookie('username', '', time() - 1, '/wind/');
        setcookie('password', '', time() - 1, '/wind/');
        echo 'logoutSuccess';
    }

    /*显示注册界面*/
    public function register()
    {
        $this->display('register.php');
    }

    /*显示个人设置界面*/
    public function setting()
    {
        if (!isset($_SESSION['username'])) {
            echo "<script>alert('请先登录！');location.href='http://" . $_SERVER["SERVER_NAME"] . "/wind/index/login'</script>";
            exit();
        }
        $userModel = new mongoModel('wind', 'users');
        $userInformation = $userModel->findOne('name', $_SESSION['username']);

        $this->assign('userInformation', $userInformation);
        $this->display('setting.php');
    }

    /*New新主题界面*/
    public function newArticle()
    {

        $classifyModel = new mongoModel('wind', 'classifys');
        $classifyDocument = $classifyModel->find(1);
        $this->assign('classifys', $classifyDocument);
        $this->display('new.php');
    }
}