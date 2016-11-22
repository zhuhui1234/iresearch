<?php

/**
 * Copyright © 艾瑞咨询集团(http://www.iresearch.com.cn/)
 * Author DavidWei <davidwei@iresearch.com.cn>
 * Create 16-08-10 14:34
 */
class IndexController extends Controller
{

    private $loginStatus, $userInfo;

    function __construct()
    {
        $this->userInfo = Session::instance()->get('userInfo');
        if (!empty($this->userInfo)) {
            $this->loginStatus = FALSE;
        } else {
            $this->loginStatus = TRUE;
        }
    }

    /**
     * 首页
     */
    public function home()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $userIndustry = Model::instance('Industry')->getUserIndustry($data);
        $data = array(
            "YH" => YH_LOGIN,
            "userIndustry" => $userIndustry,
            'loginStatus' => $this->loginStatus,
            'userInfo' => $this->userInfo,
            'token' => $this->userInfo['u_token'],
            'u_account' => $this->userInfo['u_account']
        );

        View::instance('index/index.tpl')->show($data);
    }

    /**
     * home page
     */
    public function index()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $userIndustry = Model::instance('Industry')->getUserIndustry($data);
        $data = array(
            "YH" => YH_LOGIN,
            "userIndustry" => $userIndustry,
            'loginStatus' => $this->loginStatus,
            'userInfo' => $this->userInfo,
            'token' => $this->userInfo['u_token'],
            'u_account' => $this->userInfo['u_account']
        );
        View::instance('index/home.tpl') -> show($data);
    }

    /**
     * 媒介计划
     */
    public function mutMedia()
    {
        $data = array(
            'token' => $this->userInfo['u_token'],
            'u_account' => $this->userInfo['u_account']
        );

        View::instance('index/mutmedia.tpl')->show($data);
    }

    public function demo()
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