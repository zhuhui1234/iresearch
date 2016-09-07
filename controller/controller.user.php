<?php

/**
 * Created by 艾瑞咨询集团.
 * User: DavidWei
 * Date: 16-8-10
 * Time: 下午4:08
 * Email:davidwei@iresearch.com.cn
 * FileName:controller.user.php
 * 描述:
 */
class UserController extends Controller
{

    private $model;

    function __construct()
    {
        $this->model = Model::instance('user');
    }

    function login()
    {
        $userInfo = Session::instance()->get('userInfo');
        if ($userInfo) {
            echo $userInfo['u_name'];
        }
        $data = array();
        View::instance('user/login.tpl')->show($data);
    }

    function loginAPI()
    {

        $data = array(
            "loginAccount" => $this->request()->requestAll("loginAccount"),
            "loginPassword" => $this->request()->requestAll("loginPassword")
        );
        $rs = $this->model->login($data);
        echo $rs;
    }

    function wxLoginAPI()
    {
        $wechatModel = Model::instance('wechat');
        $code = $this->request()->get('code');
        $weChatObj   = $wechatModel->wxCheckLogin($code);

//        if (DEBUG) {
            pr('微信返回值:');
            var_dump($weChatObj);
            var_dump($wechatModel->getUserInfo($code));
//        }

    }

    /**
     *
     */


}