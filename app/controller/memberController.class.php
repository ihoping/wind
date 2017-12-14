<?php
/**
 * Date: 17-4-9
 */
namespace app;

use core\lib\Controller;
use core\lib\mongoModel;

class memberController extends Controller
{
    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        $userModel = new mongoModel('wind', 'users');
        $userDocument = $userModel->findOne('name', $name);
        $path = trim($_SERVER['PATH_INFO'], '/');
        $pathArr = explode('/', $path);

        /*查看用户个人信息，如果已经登录，且查看的是自己的个人信息，则显示全部(收藏、关注、粉丝)，反之*/
        if (isset($_SESSION['username'])) {
            if ($_SESSION['username'] == $name) {
                $this->isFollow($_SESSION['username'], $userDocument['fans']);
                $this->assign('showAll', true);
            } else {
                /*判断是否关注了该用户*/
                $this->isFollow($_SESSION['username'], $userDocument['fans']);
                $this->assign('showAll', false);
            }
        } else {
            $this->assign('showAll', false);
        }

        /*路由功能选择*/
        if (isset($pathArr[2])) {
            /*不是本人无权查看*/
            if ($_SESSION['username'] != $name) {
                echo '<script>alert("无权查看");location.href="http://localhost/wind/member/' . $name . '"</script>';
                exit();
            }

            switch ($pathArr[2]) {
                case 'favorites':
                    $AEmodel = new mongoModel('wind', 'enshrines');
                    $ACmodel = new mongoModel('wind', 'articles');

                    $AEdocument = $AEmodel->findManyEnshrines('userId', $_SESSION['userId']);
                    foreach ($AEdocument as $item) {
                        $articles[] = $ACmodel->findOne('_id', new \MongoDB\BSON\ObjectID($item['articleId']));
                    }

                    if (isset($articles)) {
                        $this->assign('articleFavorites', $articles);
                    }
                    $this->assign('followNumber', count($userDocument['fans']));
                    $this->assign('username', $name);
                    $this->assign('allAStatus', '');
                    $this->assign('favoriteStatus', 'active');
                    $this->assign('followStatus', '');
                    $this->assign('fanStatus', '');
                    $this->display('user.php');
                    break;
                case 'follows':
                    $follows = $userDocument['follows'];
                    $this->assign('follows', $follows);
                    $this->assign('followNumber', count($userDocument['fans']));
                    $this->assign('username', $name);
                    $this->assign('allAStatus', '');
                    $this->assign('favoriteStatus', '');
                    $this->assign('followStatus', 'active');
                    $this->assign('fanStatus', '');
                    $this->display('user.php');
                    break;
                case 'fans':
                    $this->assign('fans', $userDocument['fans']);
                    $this->assign('followNumber', count($userDocument['fans']));
                    $this->assign('username', $name);
                    $this->assign('allAStatus', '');
                    $this->assign('favoriteStatus', '');
                    $this->assign('followStatus', '');
                    $this->assign('fanStatus', 'active');
                    $this->display('user.php');
                    break;
            }
        } else {
            $ACmodel = new mongoModel('wind', 'articles');
            $document = $ACmodel->findMany('author', $name);
            $this->assign('allAStatus', 'active');
            $this->assign('favoriteStatus', '');
            $this->assign('followStatus', '');
            $this->assign('fanStatus', '');
            $this->assign('followNumber', count($userDocument['fans']));
            $this->assign('myArticles', $document);
            $this->assign('username', $name);
            $this->display('user.php');
        }
    }

    /*关注*/
    public function follow()
    {
        if (!isset($_SESSION['username'])) {
            echo 'loginFirst';
            exit();
        }
        $userModel = new mongoModel('wind', 'users');

        // dump($_POST['followStatus']);
        /*如果已经关注了该用户，则取关，反之*/
        if ($_POST['followStatus'] == 'true') {
            $Aid = $userModel->pullOne('name', $_POST['username'], 'fans', $_SESSION['username']);
            $userModel->pullOne('name', $_SESSION['username'], 'follows', $_POST['username']);
            if (isset($Aid)) {
                echo 'cancelFollowSuccess';
            } else {
                echo 'cancelFollowError';
            }
        } else {
            $Aid = $userModel->pushOne('name', $_POST['username'], 'fans', $_SESSION['username']);
            $userModel->pushOne('name', $_SESSION['username'], 'follows', $_POST['username']);
            if (isset($Aid)) {
                echo 'followSuccess';
            } else {
                echo 'followError';
            }
        }
    }

    /*是否关注*/
    private function isFollow($name, $follows)
    {
        /*判断是否关注了该用户*/
        foreach ($follows as $item) {
            if ($item == $name) {
                $this->assign('isFollow', true);
            }
        }
    }

    /*更改用户信息*/
    public function alter()
    {
        $userModel = new mongoModel('wind', 'users');
        if ($_POST['alterName'] == 'email') {
            $result = $userModel->updateOne('name', $_SESSION['username'], 'email', $_POST['email'])->getModifiedCount();
            if ($result) {
                echo 'alterEmailSuccess';
            } else {
                echo 'alterEmailError';
            }
        } else if ($_POST['alterName'] == 'password') {
            $result = $userModel->findOne('name', $_SESSION['username']);
            if (md5($_POST['oldPassword']) == $result['password']) {
                $userModel->updateOne('name', $_SESSION['username'], 'password', md5($_POST['newPassword']));
                echo 'alterPasswordSuccess';
            } else {
                echo 'oldPasswordError';
            }

        }
    }

    /*通过名字查找用户*/
    public function findUser()
    {
        if (!isset($_SESSION['username']) && $_SESSION['username'] != 'admin') {
            echo 'loginFirst';
            exit();
        }

        $model = new mongoModel('wind', 'users');
        $result = $model->findOne('name', $_POST['name']);

        if ($result != null) {
            $user = array(
                'Uid' => (string)$result['_id'],
                'username' => $result['name'],
                'created_time' => $result['created_time'],
                'email' => $result['email'],
                'follows' => count($result['follows']),
                'fans' => count($result['fans'])
            );
            echo json_encode($user);
        } else {
            echo 'noData';
        }
    }

    /*删除用户*/
    public function remove()
    {
        if (!isset($_SESSION['username']) && $_SESSION['username'] != 'admin') {
            echo 'loginFirst';
            exit();
        }

        $model = new mongoModel('wind', 'users');
        $ObjectId = new \MongoDB\BSON\ObjectID($_GET['id']);

        $result = $model->deleteOne('_id', $ObjectId);
        if ($result->getDeletedCount()) {
            echo '<script>alert("删除成功！");location.href="http://' . $_SERVER["SERVER_NAME"] . '/wind/secret/admin/q/UManager"</script>';
        }
    }

}