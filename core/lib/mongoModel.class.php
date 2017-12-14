<?php
/**
 * MongoDB数据库模型类、CURD
 * Date: 17-3-21
 */
namespace core\lib;

use MongoDB\Client;

require_once WIND . '/vendor/autoload.php';

class mongoModel extends Model
{
    private $collection;

    public function __construct($database, $table)
    {
        $this->collection = (new Client())->$database->$table;
    }

    /*
     * 插入数据
     *
     * @param $document array&object
     * @return InsertOneResult
     */
    public function insert($document)
    {
        $insertOneResult = $this->collection->insertOne($document);
        return $insertOneResult;
    }

    /*
     * 匹配查找
     *
     * @param $key 需要匹配的键名
     * @param $value 键值
     * @return array|object|null
     */
    public function findOne($key, $value)
    {
        $document = $this->collection->findOne([$key => $value]);
        return $document;
    }

    /*
     * 通过两个键值对匹配查找
     * @param $key 键名1
     * @param $value 键值1
     * @param $key2 键名2
     * @param $value2 键值2
     * @return array|object|null
     */
    public function findEnshrine($key, $value, $key2, $value2)
    {
        $document = $this->collection->findOne([$key => $value, $key2 => $value2]);
        return $document;
    }

    /*
     * 查找多个结果
     * @param $key 键名
     * @param $value 键值
     * @return array|object|null
    */
    public function findManyEnshrines($key, $value)
    {
        $document = $this->collection->find([$key => $value]);
        return $document;
    }

    /*
     * 查找多个结果(组装数据)
     *
     * @param $key 键名
     * @param $value 键值
     * @return array|object|null
    */
    public function findMany($key, $value)
    {
        $results = array();
        $i = 0;
        $document = $this->collection->find([$key => $value]);
        foreach ($document as $item) {
            $results[$i] = $item;
            $i++;
        }
        return $results;
    }

    /*
     * 查找全部结果
     *
     * @param $classify 文档分类
     * @param $sort 排序键
     * @param $page 分页
     * @return array|object|null
    */
    public function findAll($classify, $sort, $page)
    {
        $articles = array();
        $i = 0;
        $document = $this->collection->find(['classify' => $classify], ['sort' => ['_id' => $sort], 'skip' => $page * 10, 'limit' => 10]);
        foreach ($document as $item) {

            $articles[$i] = $item;
            $i++;
        }
        return $articles;
    }

    /*
     * 查找标签为$tab的所有文章
     *
     * @param $tab 文章标签
     * @param $sort 排序键
     * @param $page 分页
     * @return array|object|null
    */
    public function findTab($tab, $sort, $page)
    {
        $articles = array();
        $i = 0;
        $document = $this->collection->find(['tab' => $tab], ['sort' => ['_id' => $sort], 'skip' => $page * 10, 'limit' => 10]);
        foreach ($document as $item) {
            $articles[$i] = $item;
            $i++;
        }
        return $articles;
    }

    /*
     * 全部结果
     *
     * @param $sort 排序键
     * @return array|object|null
    */
    public function find($sort)
    {
        $results = array();
        $i = 0;
        $document = $this->collection->find([], ['sort' => ['_id' => $sort], 'limit' => 50]);
        foreach ($document as $item) {

            $results[$i] = $item;
            $i++;
        }
        return $results;
    }

    /*
     * 查找全部结果
     *
     * @param $key 键名
     * @param $value 键值
     * @param $uKey 需要更新的键名
     * @param $uValue 更为的值
     * @return array|object|null
    */
    public function updateOne($key, $value, $uKey, $uValue)
    {
        $updateResult = $this->collection->updateOne(
            [$key => $value],
            ['$set' => [$uKey => $uValue]]
        );
        return $updateResult;
    }

    /*
     *
     * @param $key 键名
     * @param $value 键值
     * @param $uKey 需要更新的键名
     * @param $uValue 更为的值
     * @return int
    */
    public function pushOne($key, $value, $uKey, $uValue)
    {
        $pushResult = $this->collection->updateOne(
            [$key => $value],
            ['$push' => [$uKey => $uValue]]
        );
        return $pushResult->getModifiedCount();
    }

    /*
     *
     * @param $key 键名
     * @param $value 键值
     * @param $uKey 需要更新的键名
     * @param $uValue 更为的值
     * @return int
    */
    public function pullOne($key, $value, $uKey, $uValue)
    {
        $pushResult = $this->collection->updateOne(
            [$key => $value],
            ['$pull' => [$uKey => $uValue]]
        );
        return $pushResult->getModifiedCount();
    }

    /*
     *
     * @param $key 键名
     * @param $value 键值
     * @param $uKey 需要更新的键名
     * @param $uValue 更为的值
    */
    public function updateMany($key, $value, $uKey, $uValue)
    {
        $this->collection->updateMany(
            [$key => $value],
            ['$set' => [$uKey => $uValue]]
        );
    }

    /*
     * 删除一个文档
     *
     * @param $key 键名
     * @param $value 键值
     * @return deleteResult
    */
    public function deleteOne($key, $value)
    {
        $deleteResult = $this->collection->deleteOne([$key => $value]);
        return $deleteResult;
    }

    /*
      * 删除一个文档(通过两个键值对匹配)
      *
      * @param $key1 键名1
      * @param $value1 键值1
      * @param $key2 键名2
      * @param $value2 键值2
     */
    public function deleteEnshrine($key, $value, $key2, $value2)
    {
        $this->collection->deleteOne([$key => $value, $key2 => $value2]);
    }

    public function deleteMany($key, $value)
    {
        $deleteResult = $this->collection->deleteMany([$key => $value]);
    }
}