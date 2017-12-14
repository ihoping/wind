<?php
/**
 * Date: 17-4-9
 * $name:标签名
 * $ATmodel:tab模型
 * $ACmodel:文章模型
 */
namespace app;

use core\lib\mongoModel;

class tabController extends \core\lib\Controller
{
    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.

        $ATmodel = new mongoModel('wind', 'tabs');
        $ATdocument = $ATmodel->findOne('tabName', $name);

        /*初始化分页*/
        if (!isset($_GET['p'])) {
            $page = 0;
        } else {
            $page = $_GET['p'];
        }

        /*是否存在该标签*/
        if ($ATdocument == null) {
            $this->assign('tabName', $name);
            $this->assign('articles', null);
            $this->assign('tabDescription', '没有找到该标签哦！');
            $this->display('tabPage.php');
        } else {
            $ACmodel = new mongoModel('wind', 'articles');
            $articles = $ACmodel->findTab($name, -1, $page);

            /*是否存在上一页*/
            if ($page == 0) {
                $this->assign('prePage', 0);
            } else {
                $this->assign('prePage', $page - 1);
            }

            /*是否存在下一页*/
            if (count($articles) < 10) {
                $this->assign('nextPage', $page);
            } else {
                $this->assign('nextPage', $page + 1);
            }

            $this->assign('tabName', $name);
            $this->assign('articles', $articles);
            $this->assign('tabAttribute', $ATdocument['attribute']);
            $this->assign('tabDescription', $ATdocument['description']);
            $this->display('tabPage.php');
        }
    }


    /*新增标签*/
    public function newTab()
    {
        if (!isset($_SESSION['username']) && $_SESSION['username'] != 'admin') {
            echo 'loginFirst';
            exit();
        }

        /*增加描述*/
        $tabModel = new mongoModel('wind', 'tabs');
        $document = array(
            'tabName' => $_POST['tabName'],
            'description' => $_POST['description'],
            'attribute' => $_POST['attribute'],
            'created_time' => date("Y-m-d H:i:s"),
        );
        $tabResult = $tabModel->insert($document);

        /*把标签添加到所属分类*/
        $classModel = new mongoModel('wind', 'classifys');
        $classifyResult = $classModel->pushOne('classifyName', $_POST['attribute'], 'tab', $_POST['tabName']);
        if ($tabResult->getInsertedCount() && $classifyResult) {
            echo 'Success';
        }
    }

    /*删除标签*/
    public function remove()
    {
        if (!isset($_SESSION['username']) && $_SESSION['username'] != 'admin') {
            echo 'loginFirst';
            exit();
        }

        /*删除标签的描述*/
        $tabModel = new mongoModel('wind', 'tabs');
        $classify = $tabModel->findOne('tabName', $_GET['tabName'])['attribute'];//获取它所属的分类
        $tabResult = $tabModel->deleteOne('tabName', $_GET['tabName']);

        /*删除分类下的标签*/
        $classifyModel = new mongoModel('wind', 'classifys');
        $classifyResult = $classifyModel->pullOne('classifyName', $classify, 'tab', $_GET['tabName']);
        if ($tabResult->getDeletedCount() && $classifyResult) {
            echo '<script>alert("删除成功！");location.href="http://' . $_SERVER["SERVER_NAME"] . '/wind/secret/admin/q/CTManager"</script>';
        }
    }
}