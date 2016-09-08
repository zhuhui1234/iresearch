<?php
/**
 * Copyright © 艾瑞咨询集团(http://www.iresearch.com.cn/)
 * Author DavidWei <davidwei@iresearch.com.cn>
 * Create 16-08-10 14:34
 */
class ServiceController extends Controller
{

    private $model;

    function __construct()
    {
        $this->model =Model::instance('service');
    }
    function upUserSessionKey()
    {
        $yu = $this->request()->requestAll("guid");
        $res = Model::instance('user')->upUserSessionKey($yu);
    }
}

?>