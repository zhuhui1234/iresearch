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

    /**
     *
     */
    function userAuthByYH()
    {
        $data = array();
        $res = $this->model->callBackYH();
        echo $res;
    }
}

?>