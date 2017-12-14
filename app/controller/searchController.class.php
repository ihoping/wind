<?php
/**
 * Date: 17-4-12
 */
namespace app;

require_once WIND . '/vendor/autoload.php';

use Elasticsearch\ClientBuilder;

class searchController extends \core\lib\Controller
{
    public function __call($name, $arguments)
    {
        $stime = microtime(true); //获取程序开始执行的时间

        // TODO: Implement __call() method.
        $client = ClientBuilder::create()->build();

        /*搜标题是否匹配*/
        $paramsTitle = [
            'index' => 'wind',
            'type' => 'articles',
            'body' => [
                'query' => [
                    'match_phrase' => [
                        "title" => $name
                    ]
                ]
            ],

        ];

        /*搜内容*/
        $paramsContent = [
            'index' => 'wind',
            'type' => 'articles',
            'body' => [
                'query' => [
                    'match_phrase' => [
                        "content" => $name
                    ]
                ]
            ]
        ];

        /*begin*/
        $responseTitle = $client->search($paramsTitle);
        $responseContent = $client->search($paramsContent);

        /*分析并处理数据*/
        foreach ($responseTitle['hits']['hits'] as $item) {
            $articles[$item['_id']] = array(
                'id' => $item['_id'],
                'title' => str_replace($name, '<span style="color: red">' . $name . '</span>', $item['_source']['title']),
                'author' => $item['_source']['author'],
                'content' => str_replace($name, '<span style="color: red">' . $name . '</span>', strip_tags(mb_substr($item['_source']['content'], 0, 200), '<span>')),
                'created_time' => $item['_source']['created_time']
            );
        }
        foreach ($responseContent['hits']['hits'] as $item) {
            if (isset($articles[$item['_id']])) {
                continue;
            }

            $articles[$item['_id']] = array(
                'id' => $item['_id'],
                'title' => str_replace($name, '<span style="color: red">' . $name . '</span>', $item['_source']['title']),
                'author' => $item['_source']['author'],
                'content' => str_replace($name, '<span style="color: red">' . $name . '</span>', strip_tags(mb_substr($item['_source']['content'], 0, 200), '<span>')),
                'created_time' => $item['_source']['created_time']
            );

        }

        //
        $etime = microtime(true);//获取程序执行结束的时间
        if (!empty($articles)) {
            $searchTime = $etime - $stime;
            $this->assign('searchTime', $searchTime);
            $this->assign('searchName', $name);
            $this->assign('articles', $articles);
            $this->display('searchPage.php');
        } else {
            $searchTime = $etime - $stime;
            $this->assign('searchTime', $searchTime);
            $this->assign('searchName', $name);
            $this->assign('articles', null);
            $this->display('searchPage.php');
        }
    }
}
