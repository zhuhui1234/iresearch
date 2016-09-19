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
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $userIndustry = Model::instance('Industry')->getUserIndustry($data);
        $data = array(
            "YH" => YH_LOGIN,
            "userIndustry"=>$userIndustry
        );
        View::instance('index/index.tpl')->show($data);
    }

    function demo()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $data['cfg_model'] = 7;
        $ret = Model::instance('industry')->configList($data);
        $data = array(
            "listInfo" => $ret['data']['ConfigMaxList'][0]['ConfigMinList']
        );
        View::instance('index/demo.tpl')->show($data);
    }
}

?>