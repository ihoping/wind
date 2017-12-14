<?php
/**
 * wind公共方法文件
 * Date: 17-3-28
 */
use core\lib\mongoModel;

session_start();
/*时间差*/
function timediff($created_time, $now)
{
    if ($now - $created_time < 60) {
        return ($now - $created_time) . '秒前';
    } else {
        //计算天数
        $timediff = $now - $created_time;
        $days = intval($timediff / 86400);
        //计算小时数
        $remain = $timediff % 86400;
        $hours = intval($remain / 3600);
        //计算分钟数
        $remain = $remain % 3600;
        $mins = intval($remain / 60);
        if ($days > 0) {
            return $days . '天' . $hours . '小时前';
        } else if ($hours > 0) {
            return $hours . '小时' . $mins . '分钟前';
        } else if ($mins > 0) {
            return $mins . '分钟前';
        }
    }
}

/*优化var_dump输出函数*/
function dump($var, $echo = true, $label = null, $strict = true)
{
    $label = ($label === null) ? '' : rtrim($label) . ' ';
    if (!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = "<pre>" . $label . htmlspecialchars($output, ENT_QUOTES) . "</pre>";
        } else {
            $output = $label . print_r($var, true);
        }
    } else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if (!extension_loaded('xdebug')) {
            $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    } else
        return $output;
}

/*收藏个数*/
function getEnshrineNumber()
{
    $AEmodel = new mongoModel('wind', 'enshrines');
    $AEdocument = $AEmodel->findMany('userId', $_SESSION['userId']);
    return count($AEdocument);
}

/*getEmail*/

function getEmail($name)
{
    $userModel = new mongoModel('wind', 'users');
    $result = $userModel->findOne('name', $name);

    return $result['email'];
}

/*获取特别关注或者粉丝的个数*/
function getFFNumber($name)
{
    $AFmodel = new mongoModel('wind', 'users');
    $AFdocument = $AFmodel->findOne('name', $_SESSION['username']);

    if ($name == 'follows') {
        return count($AFdocument['follows']);
    } else if ($name == 'fans') {
        return count($AFdocument['fans']);
    }

}


/*获取头像*/
function getHeaderImage($name)
{
    $userModel = new mongoModel('wind', 'users');
    $result = $userModel->findOne('name', $name);

    return $result['headerImage'];
}


//自动登录功能
if (!isset($_SESSION['username']) && isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    autoLogin();
}
function autoLogin()
{
    $model = new mongoModel('wind', 'users');
    $name = $model->findOne('name', $_COOKIE['username']);
    if (!empty($name)) {
        if ($name['password'] == ($_COOKIE['password'])) {
            $_SESSION['username'] = $_COOKIE['username'];
            $_SESSION['userId'] = (String)$name['_id'];
        }
    }
}
