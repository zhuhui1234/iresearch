<?php
/**
 * Copyright © 艾瑞咨询集团(http://www.iresearch.com.cn/)
 * Author DavidWei <davidwei@iresearch.com.cn>
 * Create 16-08-10 14:34
 */
class IndexController extends Controller
{

    private $model;
    private $_api;

    function __construct()
    {

    }

    /**
     * 首页
     */
    function index()
    {
        $data = array(
            "YH" => YH_LOGIN
        );
        View::instance('index/index.tpl')->show($data);
    }

    function demo()
    {
        $data = array(
            "YH" => YH_LOGIN
        );
        View::instance('index/demo.tpl')->show($data);
    }
}

?>