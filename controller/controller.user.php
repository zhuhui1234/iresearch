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

    private $model, $userInfo, $loginStatus, $wechatStatus, $userDetail;

    function __construct()
    {
        $this->model = Model::instance('user');
        $this->userInfo = Session::instance()->get('userInfo');
        $this->userDetail = $this->model->getUserInfo(['token' => $this->userInfo['token'], 'userID' => $this->userInfo['userID']]);

        if (!empty($this->userInfo)) {
            $this->loginStatus = FALSE;
            $this->userInfo['token'] = $this->userInfo['token'];
            if (empty($this->userInfo['u_head'])) {
                $this->userInfo['headImg'] = 'dev/img/user-head.png';
            } else {
                $this->userInfo['headImg'] = IMG_URL . $this->userInfo['headImg'];
            }
        } else {
            $this->loginStatus = TRUE;
        }

        if (!empty($this->userInfo['u_wxopid']) AND $this->userInfo['u_wxopid'] != '') {
            $this->wechatStatus = TRUE;
        } else {
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
            'title' => WEBSITE_TITLE
        );
        View::instance('user/login.tpl')->show($data);
    }

    /**
     * user register page
     */
    public function register()
    {

    }

    /**
     * 预留注册成功页面
     */
    public function SuccessPage()
    {
        $data['token'] = $this->userInfo['u_token'];
        $userIndustry = Model::instance('Industry')->getUserIndustry($data);
        $data = array(
            'loginStatus' => $this->loginStatus,
            'userIndustry' => $userIndustry,
            'u_head' => $this->userInfo['headimg'],
            'u_name' => $this->userInfo['uname']
        );
        View::instance('user/success.tpl')->show($data);
    }

    /**
     * 绑定微信
     */
    public function BindingWeChat()
    {
        $weChatObj = Session::instance()->get('wechatBinding');
//        var_dump($weChatObj);
//        exit();
        if (!empty($weChatObj)) {
            $data = [
                'WeChatAvatar' => $weChatObj['headimgurl'],
                'WeChatNickName' => $weChatObj['nickname'],
                'title' => WEBSITE_TITLE
            ];
            View::instance('user/bindwx.tpl')->show($data);
        } else {
            header('Location: ?m=user&a=login');
        }
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
            'u_head' => $this->userInfo['headimg'],
            'u_name' => $this->userInfo['name']
        );
        View::instance('user/fail.tpl')->show($data);
    }

    /**
     * 更新注册信息
     */
    public function trailApply()
    {

    }

    /**
     * editUserInfo
     */
    public function editUserInfo()
    {
        $data['token'] = $this->userInfo['token'];
//        var_dump($this->loginStatus);
        $data = $this->userDetail;
        $data['loginStatus'] = $this->loginStatus;
        $userInfo = json_decode($this->model->getMyInfo(), true);
        $bindingUserInfo = json_decode($this->model->bindUserInfo(),true);
        if($userInfo['headImg']!='upload/head/') {
            $userInfo['headImg'] = IMG_URL.$userInfo['headImg'];
        }
        $userInfo = $userInfo['data'];
        View::instance('user/user.tpl')->show(
            [
                'username' => $userInfo['uname'],
                'company' => $userInfo['company'],
                'mobile' => substr_replace($userInfo['mobile'], '****', 3, 4),
                'expireDate' => substr($this->userInfo['validity'],0,10),
                'avatar' => $userInfo['headImg'],
                'permissions' => $this->userInfo['permissions'],
                'uname' => $userInfo['uname'],
                'position' => $userInfo['position'],
                'wechat' => $bindingUserInfo['data']['weixin']['type'],
                'weChatNickName' => $bindingUserInfo['data']['weixin']['name']
            ]
        );
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
            'u_head' => $this->userInfo['headimg'],
            'u_name' => $this->userInfo['uname'],
            'token' => $this->userInfo['token'],
            'u_account' => $this->userInfo['mail']
        );
        View::instance('user/manager.tpl')->show($data);
    }

    public function permissionManager()
    {

    }

    public function userLog()
    {

    }

    public function test()
    {
        pr($this->userInfo);
    }

    /**
     * logout
     */
    public function logOut()
    {
        $this->model->logOut();
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
            'u_head' => $this->userInfo['headimg'],
            'u_name' => $this->userInfo['uname'],
            'token' => $this->userInfo['token'],
            'u_account' => $this->userInfo['mail']
        );
        View::instance('user/user_apply.tpl')->show($data);
    }


    /**
     * 用户权限详细
     */
    public function userAccessDetail()
    {
        $data['token'] = $this->userInfo['token'];
        $userIndustry = Model::instance('Industry')->getUserIndustry($data);
        $getUser = json_decode($this->model->getUserInfo(['token' => $this->userInfo['u_token'], 'u_account' => $this->request()->get('u_account')]), TRUE);
        $getUser = $getUser['data'];

        if (empty($getUser['u_head']) OR $getUser['u_head'] == 'head.png') {
            $getUser['u_head'] = 'dev/img/user-head.png';
        } else {
            $getUser['u_head'] = IMG_URL . $getUser['headmg'];
        }

        $data = array(
            'userIndustry' => $userIndustry,
            'u_head' => IMG_URL.$this->userInfo['headimg'],
            'u_name' => $this->userInfo['uname'],
            'getUser' => $getUser,
            'token' => $this->userInfo['token'],
            'u_account' => $this->userInfo['mail']
        );

        View::instance('user/userAccess.tpl')->show($data);
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
        $data['token'] = $userInfo['token'];
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
            'u_head' => $this->userInfo['headimg'],
            'u_name' => $this->userInfo['uname'],
            'loginStatus' => $this->loginStatus,
            'bigIndustry' => $bigIndustry['data']['IndustryMaxList']['data'],
            'smallIndustry' => $smallIndustry['data']['IndustryMinList'],
            'token' => $this->userInfo['token'],
            'u_account' => $this->userInfo['mail']
        );
        View::instance('user/permissionAccess.tpl')->show($data);
    }

    ######################################################################################
    ##################################                     ###############################
    #################################     API METHODS     ################################
    ################################                     #################################
    ######################################################################################


    /**
     * login api
     */
    public function loginAPI()
    {
        $data = array(
            'Account' => $this->request()->post('mobile'),
            'vCode' => $this->request()->post('vCode'),
            'LoginKey' => $this->request()->post('verNum'),
            'LoginType' => 'mobile'
        );

        $rs = $this->model->login($data);
        $this->__json();
        echo $rs;
    }

    public function bindingWxAPI()
    {
        $weChatObj = Session::instance()->get('wechatBinding');
//        var_dump($weChatObj);
//        exit();
        if (!empty($weChatObj)) {
            $data = [
                'loginMobile' => $this->request()->post('mobile'),
                'loginKey' => $this->request()->post('verNum'),
                'vCode' => $this->request()->post('vCode'),
                'wxOpenid' => $weChatObj['openid'],
                'wxUnionid' => $weChatObj['unionid'],
                'wxName' => $weChatObj['nickname']
            ];
            $this->__json();
            echo $this->model->bindWeChat($data);
        } else {
            echo json_encode([resCode => '00005', 'msg' => '扫描微信异常']);
        }


    }

    /**
     *
     */
    public function bindingIRDA()
    {
        $data = json_encode($this->request()->post('data'));

        echo $this->model->bindingIRDAToUser($data);
    }

    /**
     * register user api
     */
    public function registerUserInfoAPI()
    {

    }


    /**
     * register send mail
     */
    public function registerSendMailAPI()
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
            'token' => $this->userInfo['token'],
            'u_account' => $this->request()->requestAll('mail')
        ];

        echo $this->model->setState($data);
    }


    public function getUserInfoList()
    {

    }

    /**
     * update userinfo
     * @return mixed
     */
    public function setUserInfoAPI()
    {
        $updateUserInfo = [];
        $uname = $this->request()->post('uname');
        $position = $this->request()->post('position');
        $headImg = $this->request()->post('headImg');
        $companyEmail = $this->request()->post('companyEmail');

        if (!empty($uname)) {
            $updateUserInfo['uname'] = $uname;
        }

        if (!empty($position)) {
            $updateUserInfo['position'] = $position;
        }

        if (!empty($headImg)) {
//            $serviceModel = Model::instance('Service');
//
//            $imgUrl = $serviceModel->uploadImage($this->userInfo['u_token'], toBase64(UPLOAD_PATH . trim($getData['headImg'], 'uploads')), 'png');
//            $imgData = json_decode($imgUrl, true);
            $updateUserInfo['headImg'] = toBase64(UPLOAD_PATH . trim($headImg, 'uploads'));
        }

        if (!empty($uname) || !empty($companyEmail) || !empty($position) || !empty($headImg)) {
            $updateUserInfo['TOKEN'] = $this->userInfo['token'];
            $updateUserInfo['userID'] = $this->userInfo['userID'];
            $ret = json_decode($this->model->setUserInfo($updateUserInfo), true);


            if ($ret['resCode'] == '000000') {
                $userinfo = json_decode($this->getUserInfo(), true);
                @ob_clean();
//                if (!empty($u_head)) {
                $this->userInfo['u_head'] = $userinfo['data']['headImg'];
//                }else{
//                    echo 'no head';
//                    $this->userInfo['u_head'] =
//                }
//
                if (!empty($uname)) {
                    $this->userInfo['uname'] = $userinfo['data']['uname'];
                }
//
                Session::instance()->set('userInfo', $this->userInfo);

            } else {
//                header("Location: ?m=user&a=fail");
            }
            echo json_encode($ret);
        }
    }

    /**
     * 用户信息
     */
    public function getUserInfo()
    {
        $ret = $this->model->getUserInfo(array(
            'token' => $this->userInfo['token'],
            'userID' => $this->userInfo['userID']
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

}