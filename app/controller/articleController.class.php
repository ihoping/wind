<?php
/**
 * Date: 17-4-2
 *变量解释
 * $ACmodel:文章内容模型，实例化文章collection
 * $ARmodel：文章评论模型，实例化评论collection
 * $AEmodel:文章收藏模型，实例化文章收藏collection
 */
namespace app;

use core\lib\mongoModel;

class articleController extends \core\lib\Controller
{
    public function getC()
    {
        /*将字符型的id转换为ObjectId类型*/
        $ObiectId = new \MongoDB\BSON\ObjectID($_GET['id']);
        $AEmodel = new mongoModel('wind', 'enshrines');//实例文章收藏模型

        if (isset($_SESSION['username'])) {
            //判断用户是否收藏了该篇文章
            $AEdocument = $AEmodel->findEnshrine('articleId', $_GET['id'], 'userId', $_SESSION['userId']);
            if ($AEdocument != null) {
                $this->assign('isenshrine', true);
            } else {
                $this->assign('isenshrine', false);
            }

        } else {
            $this->assign('isenshrine', false);
        }

        //收藏这篇主题的总人数
        $AEdocument2 = $AEmodel->findMany('articleId', $_GET['id']);
        $this->assign('enshrineNumber', count($AEdocument2));

        // dump($AEdocument);


        $ACmodel = new mongoModel('wind', 'articles');//实例文章内容模型
        $ACdocument = $ACmodel->findOne('_id', $ObiectId);
        $ACmodel->updateOne('_id', $ObiectId, 'browses', $ACdocument['browses'] + 1);//内容浏览量加一


        /*在用户已经登录的前提下*/
        if (isset($_SESSION['username'])) {
            //判断用户是否喜欢（赞）了这篇文章
            if ($ACdocument['likes'] != null) {
                foreach ($ACdocument['likes'] as $key) {
                    if ($key == $_SESSION['userId']) {
                        $this->assign('islike', true);
                    }
                }
            }

            //判断用户是否踩了这篇文章
            if ($ACdocument['dislikes'] != null) {
                foreach ($ACdocument['dislikes'] as $key) {
                    if ($key == $_SESSION['userId']) {
                        $this->assign('isdislike', true);
                    }
                }
            }
        }

        /*内容*/
        $ARmodel = new mongoModel('wind', 'replys');//实例文章回复内容模型
        $ARdocument = $ARmodel->findMany('AId', $_GET['id']);


        $this->assign('article', $ACdocument);
        $this->assign('articleReplys', $ARdocument);
        $this->display('c.php');
    }


    //New新主题
    public function newArticle()
    {
        if (!isset($_SESSION['username'])) {
            echo 'loginFirst';
            exit();
        }

        $ACmodel = new mongoModel('wind', 'articles');

        /*$document存放文章一切信息*/
        $document = array(
            'title' => $_POST['title'],
            'author' => $_SESSION['username'],
            'content' => $_POST['content'],
            'created_time' => date('Y-m-d H:i:s', time()),
            'lastRtime' => null,
            'lastRname' => null,
            'replyNumber' => 0,
            'browses' => 0,
            'likes' => array(),
            'dislikes' => array(),
            'classify' => $_POST['classify'],
            'tab' => $_POST['tab']
        );


        $result = $ACmodel->insert($document);
        $id = $result->getInsertedId();
        if (isset($id)) {
            echo $id;//发表成功后返回创建的文章id
        } else {
            echo 'error';
        }
    }

    //发表新回复
    public function newReply()
    {
        if (!isset($_SESSION['username'])) {
            echo 'loginFirst';
            exit();
        }


        $ARmodel = new mongoModel('wind', 'replys');
        $ACmodel = new mongoModel('wind', 'articles');

        /*$ARdocument存放回复的内容信息*/
        $ARdocument = array(
            'AId' => $_POST['AId'],
            'username' => $_SESSION['username'],
            'content' => $_POST['content'],
            'created_time' => date('Y-m-d H:i:s', time())
        );


        $ObiectId = new \MongoDB\BSON\ObjectID($_POST['AId']);//将string类型的ID转换为ObjectID类型
        $article = $ACmodel->findOne('_id', $ObiectId);//找到文章
        $ACmodel->updateOne('_id', $ObiectId, 'lastRtime', date('Y-m-d H:i:s', time()));//更新最后回复时间
        $ACmodel->updateOne('_id', $ObiectId, 'lastRname', $_SESSION['username']);//更新最后回复的用户
        $ACmodel->updateOne('_id', $ObiectId, 'replyNumber', $article['replyNumber'] + 1);//将文章评论数加1

        $result = $ARmodel->insert($ARdocument);//添加评论
        $id = $result->getInsertedId();
        if (isset($id)) {
            echo 'replySuccess';
        } else
            echo 'replyError';
    }

    /*点赞功能*/
    public function like()
    {
        if (!isset($_SESSION['username'])) {
            echo 'loginFirst';
            exit();
        }

        /*对已经点赞取消点赞，没有点赞的新增点赞*/
        $ACmodel = new mongoModel('wind', 'articles');
        $ObjectId = new \MongoDB\BSON\ObjectID($_POST['AId']);//将字符串id转换为Object类型

        if ($_POST['likeStatus'] == 'false') {
            $Aid = $ACmodel->pushOne('_id', $ObjectId, 'likes', $_SESSION['userId']);
            if ($Aid) {
                echo 'likeSuccess';
            } else {
                echo 'likeError';
            }
        } else {
            $Aid = $ACmodel->pullOne('_id', $ObjectId, 'likes', $_SESSION['userId']);
            if ($Aid) {
                echo 'cancelLikeSuccess';
            } else {
                echo 'cancelLikeError';
            }
        }

    }

    /*踩*/
    public function dislike()
    {
        if (!isset($_SESSION['username'])) {
            echo 'loginFirst';
            exit();
        }

        /*已经踩了，则取消踩，反之*/
        $model = new mongoModel('wind', 'articles');
        $ObjectId = new \MongoDB\BSON\ObjectID($_POST['AId']);
        if ($_POST['dislikeStatus'] == 'false') {
            $Aid = $model->pushOne('_id', $ObjectId, 'dislikes', $_SESSION['userId']);
            if ($Aid) {
                echo 'dislikeSuccess';
            } else {
                echo 'dislikeError';
            }
        } else {
            $Aid = $model->pullOne('_id', $ObjectId, 'dislikes', $_SESSION['userId']);
            if ($Aid) {
                echo 'cancelDislikeSuccess';
            } else {
                echo 'cancelDislikeError';
            }
        }

    }


    /*收藏*/
    public function enshrine()
    {
        if (!isset($_SESSION['username'])) {
            echo 'loginFirst';
            exit();
        }

        /*若已经收藏，则取消收藏，反之*/
        $model = new mongoModel('wind', 'enshrines');
        if ($_POST['enshrineStatus'] == 'true') {
            $model->deleteEnshrine('userId', $_SESSION['userId'], 'articleId', $_POST['AId']);
            echo 'noEnshrineSuccess';
        } else {
            $document = array(
                'userId' => $_SESSION['userId'],
                'articleId' => $_POST['AId'],
                'created_time' => date('Y-m-d H:i:s', time())
            );
            $result = $model->insert($document);
            if ($result->getInsertedCount()) {
                echo 'enshrineSuccess';
            } else {
                echo 'enshrineError';
            }
        }
    }


    /*删除文章*/
    public function remove()
    {
        if (!isset($_SESSION['username']) && $_SESSION['username'] != 'admin') {
            echo 'loginFirst';
            exit();
        }

        $model = new mongoModel('wind', 'articles');
        $ObjectId = new \MongoDB\BSON\ObjectID($_GET['id']);

        $result = $model->deleteOne('_id', $ObjectId);
        if ($result->getDeletedCount()) {
            echo '<script>alert("删除成功！");location.href="http://' . $_SERVER["SERVER_NAME"] . '/wind/secret/admin/q/AManager"</script>';
        }
    }

    /*查找文章*/
    public function findArticle()
    {
        if (!isset($_SESSION['username']) && $_SESSION['username'] != 'admin') {
            echo 'loginFirst';
            exit();
        }

        $model = new mongoModel('wind', 'articles');
        try {
            $ObjectId = new \MongoDB\BSON\ObjectID($_POST['id']);
        } catch (\Exception $e) {
            echo 'idError';
            exit();
        }


        $result = $model->findOne('_id', $ObjectId);
        if ($result != null) {
            $article = array(
                'Aid' => (string)$result['_id'],
                'title' => $result['title'],
                'author' => $result['author'],
                'created_time' => $result['created_time'],
                'attribute' => $result['classify'] . '/' . $result['tab'],
                'browses' => $result['browses'],
                'likes' => count($result['likes']),
                'dislikes' => count($result['dislikes']),
            );
            echo json_encode($article);
        } else {
            echo 'noData';
        }


    }
}
