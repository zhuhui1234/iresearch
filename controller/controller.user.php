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

    /**
     *  login page
     */
    public function login()
    {
        $userInfo = Session::instance()->get('userInfo');
        if ($userInfo) {
            echo $userInfo['u_name'];
        }
        $data     = array();
        View::instance('user/login.tpl')->show($data);
    }

    /**
     * user register page
     */
    public function register()
    {
        $data     = array();
        View::instance('user/register.tpl')->show($data);
    }

    /**
     * 忘记用户密码
     */
    public function forgotPassword()
    {

    }

    /**
     * 个人信息
     */
    public function profile()
    {

    }


    public function permissionAccess()
    {

    }

    public function logout()
    {

    }
    ######################################################################################
    ##################################                     ###############################
    #################################     API METHODS     ################################
    ################################                     #################################
    ######################################################################################

    /**
     * register api
     */
    public function registerAPI()
    {

    }

    /**
     * login api
     */
    public function loginAPI()
    {

        $data = array(
            "loginAccount"  => $this->request()->requestAll("loginAccount"),
            "loginPassword" => $this->request()->requestAll("loginPassword")
        );
        $rs = $this->model->login($data);
        echo $rs;
    }

    /**
     * wechat login api
     */
    public function wxLoginAPI()
    {
        $wechatModel        = Model::instance('wechat');
        $code               = $this->request()->get('code');
        $weChatObj          = $wechatModel->wxCheckLogin($code);
        pr('微信返回值:');
        var_dump($weChatObj);
        var_dump($wechatModel->getUserInfo($code));
    }

    public function forgotPasswordAPI()
    {

    }

}