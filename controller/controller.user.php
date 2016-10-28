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

    private $model, $userInfo, $loginStatus, $wechatStatus;

    function __construct()
    {
        $this->model = Model::instance('user');
        $this->userInfo = Session::instance()->get('userInfo');

        if (!empty($this->userInfo)) {
            $this->loginStatus = FALSE;
            $this->userInfo['token'] = $this->userInfo['u_token'];
            if(empty($this->userInfo['u_head'])) {
                $this->userInfo['u_head'] = 'dev/img/user-head.png';
            }else{
                $this->userInfo['u_head'] = IMG_URL . $this->userInfo['u_head'];
            }
        } else {
            $this->loginStatus = TRUE;
        }

        if (!empty($this->userInfo['u_wxopid']) AND $this->userInfo['u_wxopid'] != '') {
            $this->wechatStatus = TRUE;
        }else{
            $this->wechatStatus = FALSE;
        }
    }

    /**
     *  login page
     */
    public function login()
    {
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
    public function Success()
    {
        $data['token'] = $this->userInfo['u_token'];
        $userIndustry = Model::instance('Industry')->getUserIndustry($data);
        $data = array(
            'loginStatus' => $this->loginStatus,
            'userIndustry' => $userIndustry,
            'u_head' =>  $this->userInfo['u_head'],
            'u_name' => $this->userInfo['u_name']
        );
        View::instance('user/success.tpl')->show($data);
    }

    /**
     * 预留注册失败页面
     */
    public function Fail()
    {
        $data['token'] = $this->userInfo['u_token'];
        $userIndustry = Model::instance('Industry')->getUserIndustry($data);
        $data = array(
            'loginStatus' => $this->loginStatus,
            'userIndustry' => $userIndustry,
            'u_head' =>  $this->userInfo['u_head'],
            'u_name' => $this->userInfo['u_name']
        );
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
        $data['token'] = $this->userInfo['u_token'];
        $userIndustry = Model::instance('Industry')->getUserIndustry($data);
        $data = array(
            'loginStatus' => $this->loginStatus,
            'userIndustry' => $userIndustry,
            'u_head' => $this->userInfo['u_head'],
//            'u_head' =>  IMG_URL . $this->userInfo['u_head'],
            'u_name' => $this->userInfo['u_name']
        );
        View::instance('user/editUserInfo.tpl')->show($data);
    }

    /**
     * set safe
     */
    public function setSafe()
    {
        $data['token'] = $this->userInfo['u_token'];
        $userIndustry = Model::instance('Industry')->getUserIndustry($data);
        $data = array(
            'loginStatus'  => $this->loginStatus,
            'wechatStatus' => $this->wechatStatus,
            'userIndustry' => $userIndustry,
            'u_name'       => $this->userInfo['u_name'],
            'u_head'       => $this->userInfo['u_head'],
        );
        View::instance('user/user_safe.tpl')->show($data);
    }

    /**
     * binding we chat
     */
    public function setSafeWeChat()
    {
//        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $this->userInfo['u_token'];
        $userIndustry = Model::instance('Industry')->getUserIndustry($data);
        $data = array(
            'userIndustry' => $userIndustry,
            'u_head'       => $this->userInfo['u_head'],
            'u_name'       => $this->userInfo['u_name']
        );
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

    public function test()
    {
        pr($this->userInfo);
    }

    /**
     * logout
     */
    public function loginOut()
    {
        $this->model->setCancellation(array(
            'token'      => $this->userInfo['u_token'],
            'u_account'  => $this->userInfo['u_account']
        ));

        Session::instance()->destroy();

        header("Location:?m=user&a=login");
    }

    /**
     * 用户权限申请
     */
    public function applyManager()
    {
        $data['token'] = $this->userInfo['u_token'];
        $userIndustry = Model::instance('Industry')->getUserIndustry($data);
        $data = array(
            'userIndustry' => $userIndustry,
            'u_head'       => $this->userInfo['u_head'],
            'u_name'       => $this->userInfo['u_name']
        );
        View::instance('user/user_apply.tpl')->show($data);
    }

    /**
     * 用户管理
     */
    public function userManger()
    {
        $data['token'] = $this->userInfo['u_token'];
        $userIndustry = Model::instance('Industry')->getUserIndustry($data);
        $data = array(
            'userIndustry' => $userIndustry,
            'u_head'       => $this->userInfo['u_head'],
            'u_name'       => $this->userInfo['u_name']
        );
        View::instance('user/user_manager.tpl')->show($data);
    }

    /**
     * 用户权限详细
     */
    public function userAccessDetail()
    {
        $data['token'] = $this->userInfo['u_token'];
        $userIndustry = Model::instance('Industry')->getUserIndustry($data);
        $getUser = json_decode($this->model->getUserInfo(['token'=>$this->userInfo['u_token'],'u_account'=>$this->request()->get('u_account')]),TRUE);
        $getUser = $getUser['data'];

        if (empty($getUser['u_head']) OR $getUser['u_head'] == 'head.png') {
            $getUser['u_head'] = 'dev/img/user-head.png';
        }else{
            $getUser['u_head'] = IMG_URL . $getUser['u_head'];
        }

        $data = array(
            'userIndustry' => $userIndustry,
            'u_head'       => $this->userInfo['u_head'],
            'u_name'       => $this->userInfo['u_name'],
            'getUser'      => $getUser
        );

        View::instance('user/userAccess.tpl')->show($data);
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
            'u_head' =>  $this->userInfo['u_head'],
            'u_name' => $this->userInfo['u_name'],
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

    /**
     * register user api
     */
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
            $ret = $this->__sendMail('请点击以下链接完成邮箱绑定：
	     http://irv.iresearch.com.cn/iResearchDataWeb/?m=user&a=registerUserInfo&', '用户注册确认邮件', 1, $getAll['registerMail'], REGISTER_MAILADDR);
            $this->__json();
            echo $ret;
        } else {
            $this->__json();
            echo "{resMsg:'验证码错误'}";
        }
    }

    public function setStateAPI()
    {
        $data = [
            'operation' => $this->request()->requestAll('operation'),
            'token'     => $this->userInfo['u_token'],
            'u_account' => $this->request()->requestAll('u_account')
        ];

        echo $this->model->setState($data);
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
        if(substr($state,0,10)=='viewReport'){
            $state_tmp = explode('_',$state);
            $state = $state_tmp[0];
            $cfg_id = $state_tmp[1];
        }
        switch ($state) {

            case 'wxLogin':
                $ret = $this->__weChatAutoLogin(array(
                    'loginOpenid'  => $weChatObj['openid'],
                    'loginUnionid' => $weChatObj['unionid']
                ));
                if ($ret){
                    header('Location: ?m=index');
                }else{
                    header("Location: ?m=user&a=register");
                }

                break;
            //binding weChat
            case 'binding':
                $ret =  $this->__bindingWeChat(array(
                    'loginOpenid'  => $weChatObj['openid'],
                    'loginUnionid' => $weChatObj['unionid'],
                    'u_account'    => $userInfo['u_account'],
                    'token'        => $userInfo['u_token']
                ));
                $j_ret = json_decode($ret, TRUE);
                if ($j_ret['resCode'] == '000000') {
                    $this->wechatStatus = TRUE;
                    View::instance('usr/success.tpl')->show($j_ret);
                }else{
                    View::instance('user/fail.tpl')->show($j_ret);
                }
                break;
            case 'viewReport':
                print_r($state_tmp);
                break;
        }
    }

    public function getUserInfoList()
    {

        $userInfo = Session::instance()->get('userInfo');
        $postData = [
            'token'             => $userInfo['u_token'],
            'u_account'         => $userInfo['u_account'],
            'orderByColumn'     => $this->request()->requestAll('orderByColumn'),
            'orderByType'       => $this->request()->requestAll('orderByType'),
            'pageNo'            => $this->request()->requestAll('pageNo'),
            'pageSize'          => $this->request()->requestAll('length')
        ];

        $this->__json();
        echo $this->model->getUserInfoList($postData);
    }

    /**
     * update userinfo
     * @return mixed
     */
    public function setUserInfoAPI()
    {
        $updateUserInfo = array();
        $u_name = $this->request()->post('u_name');
        $u_department = $this->request()->post('u_department');
        $u_position = $this->request()->post('u_position');
        $u_mobile = $this->request()->post('u_mobile');
        $u_head = $this->request()->post('u_head');

        if (!empty($u_name)) {
            $updateUserInfo['u_name'] = $u_name;
        }

        if (!empty($u_department)) {
            $updateUserInfo['u_department'] = $u_department;
        }

        if (!empty($u_position)) {
            $updateUserInfo['u_position'] = $u_position;
        }

        if (!empty($u_mobile)) {
            $updateUserInfo['u_mobile'] = $u_mobile;
        }

        if (!empty($u_head)) {
            $serviceModel = Model::instance('Service');

            $imgUrl = $serviceModel->uploadImage($this->userInfo['u_token'],toBase64(UPLOAD_PATH . trim($u_head, 'uploads')),'png');
            $imgData = json_decode($imgUrl, true);
            $updateUserInfo['u_head'] = $imgData['data']['imageUrl'];
        }

        if (!empty($u_mobile) || !empty($u_name) || !empty($u_position) || !empty($u_department)) {
            $updateUserInfo['token'] = $this->userInfo['u_token'];
            $updateUserInfo['u_account'] = $this->userInfo['u_account'];
            $ret = json_decode($this->model->setUserInfo($updateUserInfo),TRUE);

            if ($ret['resCode'] == '000000') {
                $userinfo = json_decode($this->getUserInfo(),true);
                @ob_clean();
//                if (!empty($u_head)) {
                    $this->userInfo['u_head'] = $userinfo['data']['u_head'];
//                }else{
//                    echo 'no head';
//                    $this->userInfo['u_head'] =
//                }
//
                if (!empty($u_name)) {
                    $this->userInfo['u_name'] = $userinfo['data']['u_name'];
                }
//
//                if (!empty($u_department)) {
//                    $this->userInfo['u_department'] = $u_department;
//                }
//
//                if (!empty($u_position)) {
//                    $this->userInfo['u_position'] = $u_position;
//                }
//
//                if (!empty($u_mobile)) {
//                    $this->userInfo['u_mobile'] = $u_mobile;
//                }


//                $userinfo['token'] = $userinfo['data']['u_token'];

                var_dump($this->userInfo);

                Session::instance()->set('userInfo',$this->userInfo);

                header("Location: ?m=user&a=success");
            }else{
                header("Location: ?m=user&a=fail");
            }
        }


    }

    /**
     * 用户信息
     */
    public function getUserInfo()
    {
        $ret = $this->model->getUserInfo(array(
            'token'      => $this->userInfo['u_token'],
            'u_account'  => $this->userInfo['u_account']
        ));
//        return $ret;
        echo $ret;
        return $ret;
    }

    public function forgotPasswordAPI()
    {

    }

    ######################################################################################
    ##################################                     ###############################
    #################################   PRIVATE METHODS   ################################
    ################################                     #################################
    ######################################################################################

    /**
     * send mail
     *
     * @param $mailContent
     * @param $mailTitle
     * @param $mailType
     * @param $MailTo
     * @param $mailFrom
     * @return mixed
     */
    private function __sendMail($mailContent, $mailTitle, $mailType, $MailTo, $mailFrom)
    {
        $service = Model::instance('Service');
        return $service->sendmail($mailContent, $mailTitle, $mailType, $MailTo, $mailFrom);
    }

    /**
     * trans to  json
     */
    private function __json()
    {
        @@ob_clean();
        header('Content-type: application/json');
    }

    /**
     * 自动登入
     *
     * @param $data
     * @return mixed
     */
    private function __weChatAutoLogin($data)
    {
        return $this->model->WeChatAutoLogin($data);
    }

    /**
     * 绑定微信
     *
     * @param $data
     * @return mixed
     */
    private function __bindingWeChat($data)
    {
        return $this->model->bindWeChat($data);
    }

}