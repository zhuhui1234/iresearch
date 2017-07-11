<?php
/**
 * Copyright © 艾瑞咨询集团(http://www.iresearch.com.cn/)
 * 基础路由,php7 版本
 * Author DavidWei <davidwei@iresearch.com.cn>
 * Create 16-08-10 17:45
 */
interface IMysqlRoutRule
{
    function getRout();
}

class MysqlRoutRule implements IMysqlRoutRule
{

    private $routArr = array();
    private static $select = 'S';
    static $instances = null;

    final static public function Rout($r = 'S')
    {
        $r = strtoupper($r);
        $r && self::$select = in_array($r, array('M', 'S', '238')) ? $r : self::$select;
        if (self::$instances == null) {
            self::$instances = new self();
        }
        return self::$instances->getRout();
    }

    final function getRout()
    {
        $this->routArr = array(
            'M' => array(
                '0' => array(
                    'host' => '120.24.63.4',
                    'user' => 'root',
                    'pass' => 'Irs-51082699',
                    'db' => 'irv'

                )
            ),
            'S' => array(
                '0' => array(
                    'host' => '127.0.01',
                    'user' => 'root',
                    'pass' => 'weiwei',
                    'db' => 'irv'
                )
            )
        );
        $opr = self::$select;
        is_array($this->routArr[$opr]) && $res = $this->routArr[$opr][array_rand($this->routArr[$opr])];
        return $res;
    }
}
?>