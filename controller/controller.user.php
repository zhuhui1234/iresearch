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

    private $model, $userInfo, $loginStatus;

    function __construct()
    {
        $this->model = Model::instance('user');
        $this->userInfo = Session::instance()->get('userInfo');
        if (!empty($this->userInfo)) {
            $this->loginStatus = FALSE;
        }else{
            $this->loginStatus = TRUE;
        }
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
        $data = array();
        View::instance('user/login.tpl')->show($data);
    }

    /**
     * user register page
     */
    public function register()
    {
        $data = array(

        );
        View::instance('user/register.tpl')->show($data);
    }

    /**
     * 预留注册成功页面
     */
    public function registerSuccess()
    {
        $data = array();
        View::instance('usr/success.tpl')->show($data);
    }

    /**
     * 预留注册失败页面
     */
    public function registerFail()
    {
        $data = array();
        View::instance('user/fail.tpl')->show($data);
    }

    /**
     * 更新注册信息
     */
    public function registerUserInfo()
    {
        $data = array(
            'mailto' => $this->request()->get('mailto'),
            'mailkey' => $this->request()->get('mailkey')
        );

        View::instance('user/registerUserInfo.tpl')->show($data);
    }

    public function loginOut()
    {
        Session::instance()->destroy();
        header("Location: ?m=index");
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


    ######################################################################################
    ##################################                     ###############################
    #################################     API METHODS     ################################
    ################################                     #################################
    ######################################################################################


    public function registerUserInfoAPI()
    {
        $data = array(
            'mailkey' => $this->request()->post('mailkey'),
            'u_account'    => $this->request()->post('u_account'),
            'u_department' => $this->request()->post('u_department'),
            'u_mobile' => $this->request()->post('u_mobile'),
            'u_password' => $this->request()->post('u_password'),
            'u_position' => $this->request()->post('u_position'),
        );
        $this->__json();
        echo $this->model->registerUserInfo($data);
    }


    /**
     * register send mail
     */
    public function registerSendMail()
    {
        $getVcodes = Session::instance()->get('vcodes');
        $getAll = $this->request()->requestAll();
        if ($getAll['vcode'] == $getVcodes) {
            $ret = $this->__sendMail('http://localhost/iresearchdataweb/?m=user&a=registerUserInfo&', '用户注册确认邮件', 1, $getAll['registerMail'], REGISTER_MAILADDR);
            $this->__json();
            echo $ret;
        } else {
            $this->__json();
            echo "{resMsg:'验证码错误'}";
        }
    }

    /**
     * login api
     */
    public function loginAPI()
    {
        $data = array(
            "loginAccount" => $this->request()->requestAll("loginAccount"),
            "loginPassword" => $this->request()->requestAll("loginPassword")
        );

        $rs = $this->model->login($data);
        $this->__json();
        echo $rs;
    }

    /**
     * wechat login api
     */
    public function wxLoginAPI()
    {
        $wechatModel = Model::instance('wechat');
        $code = $this->request()->get('code');
        $weChatObj = $wechatModel->wxCheckLogin($code);
        pr('微信返回值:');
        var_dump($weChatObj);
        var_dump($wechatModel->getUserInfo($code));
    }

    public function forgotPasswordAPI()
    {

    }

    private function __sendMail($mailContent, $mailTitle, $mailType, $MailTo, $mailFrom)
    {
        $service = Model::instance('Service');
        return $service->sendmail($mailContent, $mailTitle, $mailType, $MailTo, $mailFrom);
    }

    private function __json()
    {
        @@ob_clean();
        header('Content-type: application/json');
    }

}