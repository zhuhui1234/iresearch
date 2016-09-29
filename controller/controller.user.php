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
        } else {
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
        $data = array(
            'loginStatus' => $this->loginStatus,
        );
        View::instance('user/login.tpl')->show($data);
    }

    /**
     * user register page
     */
    public function register()
    {
        $data = array();
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

    /**
     * editUserInfo
     */
    public function editUserInfo()
    {
        $data = array(
            'loginStatus' => $this->loginStatus,
        );
        View::instance('user/editUserInfo.tpl')->show($data);
    }

    /**
     * set safe
     */
    public function setSafe()
    {
        $data = array(
            'loginStatus' => $this->loginStatus
        );
        View::instance('user/user_safe.tpl')->show($data);
    }

    /**
     * binding we chat
     */
    public function setSafeWeChat()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data = array();
//        var_dump($userInfo);
        View::instance('user/user_safe_wx.tpl')->show($data);
    }

    /**
     * change pwd
     */
    public function changePwd()
    {
        $data = array();
        View:self::instance('user/changePwd.tpl')->show($data);
    }

    /**
     * logout
     */
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

    /**
     * 权限设置
     */

    public function permissionAccess()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $userIndustry = Model::instance('Industry')->getUserIndustry($data);//用户的行业
        //大行业
        $bigIndustry = Model::instance('Industry')->industryMaxList($data);//大行业
        //小行业
        $data['ity_sid'] = $bigIndustry['data']['IndustryMaxList']['data'][0]['ity_id'];
        $smallIndustry = Model::instance('Industry')->industryMinList($data);//小行业
        //默认报告列表
        $data['cfg_model'] = $smallIndustry['data']['IndustryMinList'][0]['ity_id'];
        $data = array(
            "userIndustry" => $userIndustry,
            'userInfo' => $this->userInfo,
            'loginStatus' => $this->loginStatus,
            'bigIndustry'=>$bigIndustry['data']['IndustryMaxList']['data'],
            'smallIndustry'=>$smallIndustry['data']['IndustryMinList']
        );
        View::instance('user/permissionAccess.tpl')->show($data);
    }


    ######################################################################################
    ##################################                     ###############################
    #################################     API METHODS     ################################
    ################################                     #################################
    ######################################################################################


    public function registerUserInfoAPI()
    {
        $data = array(
            'mailkey' => $this->request()->get('mailkey'),
            'u_account' => $this->request()->get('mailto'),
            'u_name' => $this->request()->post('u_name'),
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
            "loginAccount"  => $this->request()->requestAll("loginAccount"),
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
        $state = $this->request()->get('state');
        $weChatObj = $wechatModel->wxCheckLogin($code);
        $userInfo = Session::instance()->get('userInfo');
//        pr('微信返回值:');
//        var_dump($state);
//        var_dump($weChatObj);
//        var_dump($wechatModel->getUserInfo($code));
//        var_dump($userInfo);
//        exit();
        switch ($state) {

            case 'wxLogin':
                $ret = $this->__weChatAutoLogin(array(
                    'loginOpenid'  => $weChatObj['openid'],
                    'loginUnionid' => $weChatObj['unionid']
                ));
                var_dump($ret);
                if ($ret){
                    header('Location: ?m=index');
                }else{
//                    Controller::instance('user')->{'register'}();
                    header("Location: ?m=user&a=register");
                }

                break;
            //binding wechat
            case 'binding':
                $ret =  $this->__bindingWeChat(array(
                    'loginOpenid'  => $weChatObj['openid'],
                    'loginUnionid' => $weChatObj['unionid'],
                    'u_account'    => $userInfo['u_account'],
                    'token'        => $userInfo['u_token']
                ));
                $j_ret = json_decode($ret, TRUE);
                if ($j_ret['resCode'] == '000000') {
                    View::instance('usr/success.tpl')->show($j_ret);
                }else{
                    View::instance('user/fail.tpl')->show($j_ret);
                }
                break;
        }
    }

    public function updateUserInfoAPI()
    {
        $data = array();
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

    private function __weChatAutoLogin($data)
    {
        return $this->model->WeChatAutoLogin($data);
    }
    private function __bindingWeChat($data)
    {
        return $this->model->bindWeChat($data);
    }

}