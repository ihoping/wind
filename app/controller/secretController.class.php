<?php
/**
 * Date: 17-4-13
 * 后台管理
 */
namespace app;

use core\lib\Controller;
use core\lib\mongoModel;

class secretController extends Controller
{
    public function admin()
    {
        /*绝对权限*/
        if ($_SESSION['username'] != 'admin') {
            echo '<script>alert("这里是秘密境地！闲杂人等禁止进入！");</script>';
            exit();
        }

        /*功能选择*/
        $q = $_GET['q'];

        if (!isset($q)) {
            $this->display('admin.php');
            exit();
        }
        switch ($q) {
            case 'AManager':
                $articlesModel = new mongoModel('wind', 'articles');
                $articlesDocument = $articlesModel->find(-1);

                $this->assign('articlesDocument', $articlesDocument);
                $this->assign('articles', true);
                $this->display('admin.php');
                break;
            case 'UManager':
                $userModel = new mongoModel('wind', 'users');
                $usersDocument = $userModel->find(-1);

                $this->assign('usersDocument', $usersDocument);
                $this->assign('users', true);
                $this->display('admin.php');
                break;
            case 'CTManager':
                $classifyModel = new mongoModel('wind', 'classifys');
                $classifysDocument = $classifyModel->find(-1);

                $this->assign('classifysDocument', $classifysDocument);
                $this->assign('CT', true);
                $this->display('admin.php');
                break;
            case 'ACManager':
                $this->assign('AC', true);
                $this->display('admin.php');
                break;
            case 'ATManager':
                $classifyModel = new mongoModel('wind', 'classifys');
                $classifysDocument = $classifyModel->find(-1);

                $this->assign('classifysDocument', $classifysDocument);
                $this->assign('AT', true);
                $this->display('admin.php');
                break;
            default:
                $this->display('admin.php');
        }

    }
}