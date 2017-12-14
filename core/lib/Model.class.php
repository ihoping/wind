<?php
/**
 * wind数据库模型接口
 * Date: 17-3-23
 */
namespace core\lib;

require_once WIND . '/vendor/autoload.php';

class Model
{
    private $collection;

    public function __construct($database, $table)
    {
    }

    public function insert($document)
    {
    }

    public function findOne($key, $value)
    {
    }

    public function findMany($key, $value)
    {
    }

    public function updateOne($key, $value, $uKey, $uValue)
    {
    }

    public function updateMany($key, $value, $uKey, $uValue)
    {
    }

    public function deleteOne($key, $value)
    {
    }

    public function deleteMany($key, $value)
    {
    }
}