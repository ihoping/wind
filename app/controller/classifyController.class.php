<?php
/**
 * 文章分类控制器
 * Date: 17-4-8
 */
namespace app;

use core\lib\mongoModel;

class classifyController extends \core\lib\Controller
{
    public function __call($classifyName, $arguments)
    {
        // TODO: Implement __call() method.
        $ACmodel = new mongoModel('wind', 'articles');

        /*初始化分页*/
        if (isset($_GET['p']))
            $page = $_GET['p'];
        else
            $page = 0;

        /*获取数据*/
        $articles = $ACmodel->findAll($classifyName, -1, $page);
        $classifyModel = new mongoModel('wind', 'classifys');//分类模型
        $classifyDocument = $classifyModel->find(1);

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

        $this->assign('articles', $articles);
        $this->assign('classifys', $classifyDocument);
        $this->assign('classifyName', $classifyName);
        $this->display('index.php');
    }

    /*新增分类*/
    public function newClassify()
    {
        if (!isset($_SESSION['username']) && $_SESSION['username'] != 'admin') {
            echo 'loginFirst';
            exit();
        }

        $classifyModel = new mongoModel('wind', 'classifys');

        $document = array(
            'classifyName' => $_POST['classifyName'],
            'tab' => [],
            'created_time' => date("Y-m-d H:i:s"),
        );
        $result = $classifyModel->insert($document);
        if ($result->getInsertedCount()) {
            echo 'Success';
        }
    }

    /*删除分类*/
    public function remove()
    {
        if (!isset($_SESSION['username']) && $_SESSION['username'] != 'admin') {
            echo 'loginFirst';
            exit();
        }
        $classifyModel = new mongoModel('wind', 'classifys');
        $tabs = $classifyModel->findOne('classifyName', $_GET['name'])['tab'];
        $classifyResult = $classifyModel->deleteOne('classifyName', $_GET['name']);
        //  exit();

        /*删除分类下的所以的标签描述*/
        $tabModel = new mongoModel('wind', 'tabs');
        foreach ($tabs as $tab) {
            $tabModel->deleteOne('tabName', $tab);
        }
        if ($classifyResult) {
            echo '<script>alert("删除成功！");location.href="http://' . $_SERVER["SERVER_NAME"] . '/wind/secret/admin/q/CTManager"</script>';
        }
    }
}