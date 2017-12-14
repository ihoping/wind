<?php
/**
 * 控制器主类
 * Date: 17-3-22
 */
namespace core\lib;

class Controller
{
    private $assign;

    public function assign($name, $value)
    {
        $this->assign[$name] = $value;
    }

    public function display($filename)
    {
        $filePath = APP . '/views/' . $filename;
        if (is_file($filePath)) {
            $data = $this->assign;
            include $filePath;
        }
    }
}