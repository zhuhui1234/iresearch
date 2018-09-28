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

    private $model, $userInfo, $loginStatus, $wechatStatus, $userDetail, $cache, $cache_key;

    function __construct($className)
    {
        parent::__construct($className);

        $this->cache = new CacheClass();
        $this->cache = $this->cache->redis;

        $this->model = Model::instance('user');
        $this->userInfo = Session::instance()->get('userInfo');


        if (!empty($this->userInfo)) {

            //cache setup
            $this->cache_key = $this->userInfo['token'] . '_cache';

            if ($this->cache->hExists($this->cache_key, 'userDetail')) {
                $this->userDetail = $this->cache->hGet($this->cache_key, 'userDetail');
            } else {
                $this->userDetail = $this->model->getUserInfo([
                    'token' => $this->userInfo['token'],
                    'userID' => $this->userInfo['userID']
                ]);
                $this->cache->hSet($this->cache_key, 'userDetail', $this->userDetail);
                $this->cache->expire($this->cache_key, REDIS_TIME_OUT);
            };


            $this->loginStatus = FALSE;
//            $this->userInfo['token'] = $this->userInfo['token'];
            if (empty($this->userInfo['u_head'])) {
                $this->userInfo['headImg'] = null;
            } else {
                $this->userInfo['headImg'] = toBase64(IMG_URL . $this->userInfo['headImg']);
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
        Session::instance()->destroy();
        $data = array(
            'loginStatus' => $this->loginStatus,
            'mobile' => "1",
            'title' => WEBSITE_TITLE
        );
        View::instance('user/bj_login.tpl')->show($data);
    }


    public function b_login()
    {
//        Session::instance()->destroy();
        $data = array(
            'loginStatus' => $this->loginStatus,
            'mobile' => "1",
            'title' => WEBSITE_TITLE
        );

        View::instance('user/b_login.tpl')->show($data);
    }

    public function bj_login()
    {
//        Session::instance()->destroy();
        $data = array(
            'loginStatus' => $this->loginStatus,
            'mobile' => "1",
            'title' => WEBSITE_TITLE
        );

        View::instance('user/login.tpl')->show($data);
    }

    public function test()
    {
        $this->__json();
        echo $this->userDetail;

    }

    /**
     * jump jump jump, take me out..............
     */
    public function jump()
    {
        $pdt_id = $this->request()->get('pro');
        $from = $this->request()->get('from');
        $guid = $this->request()->get('guid');
        if (!empty($this->request()->requestAll()['redirect'])) {
            $redirect = '&redirect=' . urlencode($this->request()->requestAll()['redirect']);;
        } else {
            $redirect = '';
        }

        $irdStatus = '1';

        $mobile = "1";

        if (empty($from)) {
            Session::instance()->set('from', 'ird');
        }

        if (empty($guid)) {
            $guid = Session::instance()->get('irdGuid');
        }

        if ($from == 'ird' and !empty($guid)) {

            $reIrdAccount = $this->model->getIRDataAccount($guid);
            write_to_log($reIrdAccount, '_irdLogin');
            $irdAccount = json_decode($reIrdAccount, true);
            $irdAccount['iUserID'] = (int)$irdAccount['iUserID'];

            if ($irdAccount['iUserID'] !== 0) {
                write_to_log($reIrdAccount . '  success ', '_irdLogin');
                $userInfo = json_decode($this->model->getUserInfoByIRD(['iUserID' => $irdAccount['iUserID']]), true);

                Session::instance()->set('irdAccount', $irdAccount);
                Session::instance()->set('irdGuid', $guid);
                if (!empty($userInfo['data']['u_mobile'])) {
                    $mobile = substr_replace($userInfo['data']['u_mobile'], '****', 3, 4);
                }

                $irdStatus = '2';

            } else {
                $irdStatus = '3';
                write_to_log($guid . '   fails', '_irdLogin');
                http_response_code(500);
                echo '<script> 
                       if (confirm("iRD登录超时，请重新登录iRD，用跳转链接尝试重新绑定账号。")) {    
                            window.location.href="about:blank";
                            window.close(); 
                        } else {    
                            window.close();    
                        }  </script>';

            }
        }

        if (empty($pdt_id)) {
            http_response_code(500);
            echo '参数错误';
        } else {
            if (DEBUG) {
                var_dump($mobile);
            }

            $userInfo = json_decode($this->model->getUserInfo([
                'token' => $this->userInfo['token'],
                'userID' => $this->userInfo['userID']
            ]), true);

            if (!empty($userInfo)) {

                $d = [
                    'loginStatus' => $this->loginStatus,
                    'mobile' => $mobile,
                    'irdStatus' => $irdStatus,
                    'pdtID' => $pdt_id,

                ];

                if (!$this->loginStatus)
                    $d['expire'] = 1;

                if ($userInfo['resCode'] != 000000) {
                    View::instance('user/bj_login.tpl')->show($d);
                    exit();
                }
            }

            if (!$this->loginStatus) {
                if ($from == 'ird' and !empty($guid)) {
                    $uid = ['iUserID' => $irdAccount['iUserID']];
                    $uid = json_decode($this->model->getIRVuserid($uid), true);
                    if ($uid['resCode'] != '000000') {
                        $this->model->logOut();
                        Session::instance()->destroy();
                        write_to_log('destory_session:', '_session');
                        Session::instance()->set('irdAccount', $irdAccount);
                        Session::instance()->set('irdGuid', $guid);
                        $irdStatus = '2';

                        View::instance('user/ird_login.tpl')->show([
                            'loginStatus' => $this->loginStatus,
                            'pdtID' => $pdt_id,
                            'TrueName' => $irdAccount['TrueName'],
                            'UserName' => $irdAccount['UserName'],
                            'mobile' => $mobile,
                            'CompanyName' => $irdAccount['CompanyName']]);
                        return;
                    }
                }
                //登入成功
                $getPermission = json_decode($this->model->getPermission([
                    'token' => $this->userInfo['token'],
                    'pdt_id' => $pdt_id,
                    'userID' => $this->userInfo['userID']
                ]), true);
                write_to_log(json_encode($getPermission), '_premission');

//                if ($irdStatus) {
//                    // ird login is ok
//                    if ($this->model->__checkIRDPermission($irdAccount['pplist'], $pdt_id)) {
//
//                    }
//                }
                if ($pdt_id == '1') {
                    header('Location: https://data.iresearch.com.cn/iRView.shtml');
                    exit();
                }

                if ($getPermission['resCode'] == '20000') {

                    $this->model->pushLog([
                        'user' => $this->userInfo['userID'],
                        'companyID' => $this->userInfo['companyID'],
                        'status' => '20000',
                        'type' => 'irv用户日志',
                        'sub_id' => $pdt_id,
                        'resource' => 'iData',
                        'action' => '跳转产品',
                        'level' => '0',
                        'log_ip' => getIp()
                    ]);

                    if ($from == 'ird') {
                        switch ($pdt_id) {
                            case '42':
//                                header('Location: ' . ADT_URL);
                                header('Location: https://data.iresearch.com.cn/iRView.shtml');
                                break;
                            case '47':
//                                header('Location:' . VT_URL);
                                header('Location: https://data.iresearch.com.cn/iRView.shtml');
                                break;
                            case '48':
//                                header('Location: ' . UT_URL);
                                header('Location: https://data.iresearch.com.cn/iRView.shtml');
                                break;

                            default:
                                header('Location: https://data.iresearch.com.cn/iRView.shtml');
                                break;

                        }
                    } else {
                        if (DEBUG) {
                            var_dump($pdt_id);
                            exit();
                        }
                        if ($pdt_id == '49') {
                            $p = $this->request()->get('p');
                            switch ($p) {
                                case 'mut':
                                    header('Location: ?m=index&a=mutbeta');
                                    break;
                                case 'iut':
                                    header('Location: ?m=index&a=iutbeta');
                                    break;

                                default:
                                    header('Location: ' . $getPermission['data']['data']['pdt_url'] . $redirect);
                                    exit();
                            }
                        } else {
                            header('Location: ' . $getPermission['data']['data']['pdt_url'] . $redirect);
                            exit();
                        }

                    }

                } else {

                    if (($getPermission['resCode'] == '40004')) {
                        View::instance('user/bj_login.tpl')->show([
                            'loginStatus' => $this->loginStatus,
                            'expired' => 1,
                            'mobile' => $mobile,
                            'pdtID' => $pdt_id]);
                    } else {

                        /*
                         * 如果是信息流，则判断ADT是否有MOBILE权限，如果有则过。
                         */
                        if ($pdt_id == 60) {
                            $rq = [
                                'u_id' => $this->userInfo['userID']
                            ];
                            $p42 = json_decode($this->model->getProList($rq), true);

                            if (in_array('madt', $p42['data'])) {
                                header('Location: ' . $getPermission['data']['data']['pdt_url'] . $redirect);
                                exit();
                            } else {
                                header('Location: ?m=user&a=trialApply&ppname=' . $getPermission['data']['data']['pdt_name'] . '&menuID=' . $pdt_id);
                                exit();
                            }

                        }

                        if (empty($getPermission['data']['data'])) {
                            $pro = $this->model->getProduct(['pdt_id' => $pdt_id]);
                            $pro = json_decode($pro, true);

                            if ($pro['resCode'] == '0000000') {

                                if ($pdt_id == '49') {
                                    $p = $this->request()->get('p');
                                    switch ($p) {
                                        case 'mut':
                                            $pro['data'][0]['pdt_name'] = '移动用户行为监测(BETA)';
                                            break;
                                        case 'iut':
                                            $pro['data'][0]['pdt_name'] = '用户行为监测(BETA)';
                                            break;
                                    }
                                }

                                header('Location: ?m=user&a=trialApply&ppname=' . $pro['data'][0]['pdt_name'] . '&menuID=' . $pdt_id);
                            } else {
                                http_response_code(404);
                                echo '访问错误';
                            }

                        } else {
                            if ($pdt_id == '49') {
                                $p = $this->request()->get('p');
                                switch ($p) {
                                    case 'mut':
                                        $getPermission['data']['data']['pdt_name'] = '移动用户行为监测(BETA)';
                                        break;
                                    case 'iut':
                                        $getPermission['data']['data']['pdt_name'] = '用户行为监测(BETA)';
                                        break;


                                }
                            }

                            header('Location: ?m=user&a=trialApply&ppname=' . $getPermission['data']['data']['pdt_name'] . '&menuID=' . $pdt_id);
                        }
                    }
                }
            } else {

                //没有登入
                if ($from == 'ird' and !empty($guid)) {
                    $uid = ['iUserID' => $irdAccount['iUserID']];
                    $uid = json_decode($this->model->getIRVuserid($uid), true);

                    if ($uid['resCode'] == '000000') {
                        View::instance('user/bj_login.tpl')->show([
                            'loginStatus' => $this->loginStatus,
                            'irdStatus' => $irdStatus,
                            'mobile' => $mobile,
                            'pdtID' => $pdt_id]);
                    } else {

                        View::instance('user/ird_login.tpl')->show([
                            'loginStatus' => $this->loginStatus,
                            'pdtID' => $pdt_id,
                            'mobile' => $mobile,
                            'irdStatus' => $irdStatus,
                            'TrueName' => $irdAccount['TrueName'],
                            'UserName' => $irdAccount['UserName'],
                            'CompanyName' => $irdAccount['CompanyName']]);
                    }
                } else {

                    View::instance('user/bj_login.tpl')->show([
                        'loginStatus' => $this->loginStatus,
                        'mobile' => $mobile,
                        'irdStatus' => $irdStatus,
                        'pdtID' => $pdt_id]);
                }
            }
        }
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
    public function b_trialApply()
    {
        $data['token'] = $this->userInfo['token'];
        $data = $this->userDetail;
        $data['loginStatus'] = $this->loginStatus;
//        $userInfo = json_decode($this->model->getMyInfo(), true);
        $userInfo = json_decode($this->userDetail, true);
        $bindingUserInfo = json_decode($this->model->bindUserInfo($userInfo), true);
        $userInfo = $userInfo['data'];
        $userModel = Model::instance('user');
        $menu = json_decode($userModel->showMenu(), true);
        $menu = $menu['data']['dataList'];
        $menu = fillMenu($menu);
        $region = json_decode($userModel->regionList([
            'token' => $this->userInfo['token'],
            'userID' => $this->userInfo['userID']
        ]), true);
        foreach($region['data'] as $re){
            $mobile_region[] = [
                'id' => $re['id'],
                'value' =>$re['title']
            ];
        }
        $mobile_region = json_encode($mobile_region,JSON_UNESCAPED_UNICODE);
        $industry = json_decode($userModel->industryList([
            'token' => $this->userInfo['token'],
            'userID' => $this->userInfo['userID']
        ]), true);
        foreach($industry['data'] as $in){
            $mobile_industry[] = [
                'id' => $in['id'],
                'value' =>$in['title']
            ];
        }
        $mobile_industry = json_encode($mobile_industry,JSON_UNESCAPED_UNICODE);
//        var_dump($userInfo['mobile']);exit;
        View::instance('b_apply/apply.tpl')->show(
            [
                'username' => $userInfo['uname'],
                'company' => $userInfo['company'],
//                'mobile' => substr_replace($userInfo['mobile'], '****', 3, 4),
                'mobile' => $userInfo['mobile'],
                'u_mail' => $userInfo['companyEmail'],
                'expireDate' => substr($this->userInfo['validity'], 0, 10),
                'avatar' => $userInfo['headImg'],
                'permissions' => $this->userInfo['permissions'],
                'uname' => $userInfo['uname'],
                'position' => $userInfo['position'],
                'wechat' => $bindingUserInfo['data']['weixin']['type'],
                'weChatNickName' => $bindingUserInfo['data']['weixin']['name'],
                'menu' => $menu,
                'titleMenu' => $menu[1]['subMenu'],
                'ppname' => $this->request()->get('ppname'),
                'mainMenu' => is_array($menu[1]['subMenu']) ? $this->__mainMenu($menu[1]['subMenu']) : null,
                'regionList' => $region['data'],
                'industrylist' => $industry['data'],
                'mobile_region' => $mobile_region,
                'mobile_industry' => $mobile_industry
            ]
        );
    }


    /**
     * 更新注册信息
     */
    public function trialApply()
    {
        $data['token'] = $this->userInfo['token'];
        $data = $this->userDetail;
        $data['loginStatus'] = $this->loginStatus;
        $userInfo = json_decode($this->userDetail, true);
        $userInfo = $userInfo['data'];
        $userModel = Model::instance('user');

        $region = json_decode($userModel->regionList([
            'token' => $this->userInfo['token'],
            'userID' => $this->userInfo['userID']
        ]), true);

        $industry = json_decode($userModel->industryList([
            'token' => $this->userInfo['token'],
            'userID' => $this->userInfo['userID']
        ]), true);
        foreach($industry['data'] as $in){
            $mobile_industry[] = [
                'id' => $in['id'],
                'value' =>$in['title']
            ];
        }
        $mobile_industry = json_encode($mobile_industry,JSON_UNESCAPED_UNICODE);
        foreach($region['data'] as $re){
            $mobile_region[] = [
                'id' => $re['id'],
                'value' =>$re['title']
            ];
        }
        $mobile_region = json_encode($mobile_region,JSON_UNESCAPED_UNICODE);
        $productInfo = json_decode($userModel->productInfo([
            'pdt_id' => $this->request()->get('menuID'),
            'token' => $this->userInfo['token'],
            'userID' => $this->userInfo['userID']
        ]), true);

        /*
         * 显示三端图标
         */
        switch ($this->request()->get('menuID')) {

            case 11:
            case 41:
            case 46:
            default:
                //没三端
                $pc = $mobile = $ott = 'none';

                break;

            case 42:
            case 47:
                //三端
                $pc = $mobile = $ott = 'block';

                break;
            case 48:
                //no ott
                $ott = 'none';
                $pc = $mobile = 'block';
                break;

        }
        $mobile_industry = json_encode($mobile_industry,JSON_UNESCAPED_UNICODE);
        View::instance('b_apply/apply.tpl')->show(
            [
                'username' => $userInfo['uname'],
                'company' => $userInfo['company'],
                'u_mobile' => $userInfo['mobile'],
                'expireDate' => substr($this->userInfo['validity'], 0, 10),
                'uname' => $userInfo['uname'],
                'u_mail' => $userInfo['companyEmail'],
                'position' => $userInfo['position'],
                'regionList' => $region['data'],
                'industrylist' => $industry['data'],
                'productIntroduce' => $productInfo['data'][0]['pdt_intro'],
                'productLogoUrl' => $productInfo['data'][0]['pdt_logo_url'],
                'pc' => $pc,
                'mobile' => $mobile,
                'ott' => $ott,
                'mobile_region' => $mobile_region,
                'mobile_industry' => $mobile_industry
            ]
        );
    }


    /**
     * edit User Info
     */
    public function editUserInfo()
    {
        header('Location: https://irv.iresearch.com.cn/user-center/check?' . USERCENTER_VERSION);
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

    public function pointLog()
    {

        $data['token'] = $this->userInfo['token'];

        $data = $this->userDetail;
        $data['loginStatus'] = $this->loginStatus;
//        $userInfo = json_decode($this->model->getMyInfo(), true);
        $userInfo = json_decode($this->userDetail, true);
        $userInfo = $userInfo['data'];
        $bindingUserInfo = json_decode($this->model->bindUserInfo($this->userInfo), true);
        $userModel = Model::instance('user');
        $menu = json_decode($userModel->showMenu(), true);
        $menu = $menu['data']['dataList'];
        $menu = fillMenu($menu);

        if ($userInfo['headImg'] != 'upload/head/') {
            $userInfo['headImg'] = IMG_URL . $userInfo['headImg'];
        }
        View::instance('user/point_log.tpl')->show([
            'username' => $userInfo['uname'],
            'company' => $userInfo['company'],
            'mobile' => substr_replace($userInfo['mobile'], '****', 3, 4),
            'expireDate' => substr($this->userInfo['validity'], 0, 10),
            'avatar' => $userInfo['headImg'],
            'permissions' => $this->userInfo['permissions'],
            'uname' => $userInfo['uname'],
            'position' => $userInfo['position'],
            'wechat' => $bindingUserInfo['data']['weixin']['type'],
            'weChatNickName' => $bindingUserInfo['data']['weixin']['name'],
            'menu' => $menu,
            'titleMenu' => $menu[1]['subMenu'],
            'mainMenu' => is_array($menu[1]['subMenu']) ? $this->__mainMenu($menu[1]['subMenu']) : null
        ]);
    }


    /**
     * logout
     */
    public function logOut()
    {
        $cache_key = $this->userInfo['token'] . '_cache';
        $this->cache->hDel($cache_key);
        $this->cache->del($cache_key);
        $this->model->logOut();

        Session::instance()->destroy();
        setcookie('yh_irv_url', 'https://irv.iresearch.com.cn/iResearchDataWeb/?m=user&a=login&expired=1', time() + 2400, '/');
        setcookie('PHPSESSID', '', time() - 3600, '/');
        setcookie('JSESSIONID', '', time() - 3600, '/');
        setcookie('kittyID', '', time() - 3600, '/');
        // unset cookies
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach ($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time() - 1000);
                setcookie($name, '', time() - 1000, '/');
            }
        }

        write_to_log('cookie:' . json_encode($_COOKIE), '_session');

        $pdtID = $this->request()->get('pdtID');

        switch ($pdtID) {
            case '38':
                header("Location: https://data.iresearch.com.cn/iRCloud.shtml");
                break;
            case '43':
                header("Location: https://data.iresearch.com.cn/iRCloud.shtml");
                break;
            case '50':
                header("Location: https://data.iresearch.com.cn/iRCloud.shtml");
                break;
            case '0':
                header('Location: https://data.iresearch.com.cn/iRView.shtml');
                break;
            default:
                header('Location: https://data.iresearch.com.cn/iRView.shtml');
                break;
        }

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
        $getUser = json_decode($this->model->getUserInfo([
            'token' => $this->userInfo['u_token'],
            'u_account' => $this->request()->get('u_account')
        ]), TRUE);

        $getUser = $getUser['data'];

        if (empty($getUser['u_head']) OR $getUser['u_head'] == 'head.png') {
            $getUser['u_head'] = 'dev/img/user-head.png';
        } else {
            $getUser['u_head'] = IMG_URL . $getUser['headmg'];
        }

        $data = array(
            'userIndustry' => $userIndustry,
            'u_head' => IMG_URL . $this->userInfo['headimg'],
            'u_name' => $this->userInfo['uname'],
            'getUser' => $getUser,
            'token' => $this->userInfo['token'],
            'u_account' => $this->userInfo['mail']
        );

        View::instance('user/userAccess.tpl')->show($data);
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
            'loginMobile' => $this->request()->post('mobile'),
            'vCode' => $this->request()->post('vCode'),
            'LoginKey' => $this->request()->post('verNum'),
            'LoginType' => 'mobile'
        );

        $ird_guid = Session::instance()->get('irdGuid');
        $ird_account = Session::instance()->get('irdAccount');
        // 判断是否来自IRD的用户
        if (!empty($guid) and !empty($ird_account)) {
            $data['ird_guid'] = $ird_guid;
            $data['ird_user'] = $ird_account;
        }

        $rs = $this->model->login($data);
        $this->__json();
        echo $rs;
        //删除vCode的值
        //Session::instance()->del('vCode');
    }

    public function safeLoginAPI()
    {
        $data = array(
            'loginMobile' => $this->request()->post('mobile'),
            'vCode' => $this->request()->post('vCode'),
            'LoginKey' => $this->request()->post('verNum'),
            'LoginType' => $this->request()->post('login_type'),
            'loginMail' => $this->request()->post('mail')
        );

        $ird_guid = Session::instance()->get('irdGuid');
        $ird_account = Session::instance()->get('irdAccount');
        // 判断是否来自IRD的用户
        if (!empty($guid) and !empty($ird_account)) {
            $data['ird_guid'] = $ird_guid;
            $data['ird_user'] = $ird_account;
        }

        $rs = $this->model->b_login($data);
        $this->__json();
        echo $rs;
        //删除vCode的值
        Session::instance()->del('vCode');
    }


    /**
     * ird bind api
     */
    public function irdBindAPI()
    {
        $data = array(
            'loginMobile' => $this->request()->post('mobile'),
            'vCode' => $this->request()->post('vCode'),
            'LoginKey' => $this->request()->post('verNum'),
            'LoginType' => 'mobile'
        );

        $ird_guid = Session::instance()->get('irdGuid');
        $ird_account = Session::instance()->get('irdAccount');
        // 判断是否来自IRD的用户
        if (!empty($guid) and !empty($ird_account)) {
            $data['ird_guid'] = $ird_guid;
            $data['ird_user'] = $ird_account;
        }

        $rs = $this->model->irdBind($data);
        $this->__json();
        echo $rs;
        //删除vCode的值
        Session::instance()->del('vCode');
    }

    /**
     * login api for mobile
     */
    public function mobileLoginAPI()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $this->__json();
        echo $this->model->mobileLogin([
            'loginMobile' => $data['mobile'],
            'LoginKey' => $data['verNum'],
            'LoginType' => 'mobile'
        ]);
    }

    /**
     * point list API
     */
    public function pointListAPI()
    {
        $this->__json();
        echo $this->model->pointList(['dev_id' => $this->userInfo['dev_id']]);
    }

    /**
     * get point API
     */
    public function getPointAPI()
    {
        $this->__json();
        echo $this->model->getPoint(['dev_id' => $this->userInfo['dev_id']]);
    }

    /**
     * binding wechat api
     */
    public function bindingWxAPI()
    {
        $weChatObj = Session::instance()->get('wechatBinding');
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
            echo json_encode(['resCode' => '00005', 'msg' => '扫描微信异常']);
        }
    }

    /**
     * binding IRDA
     */
    public function bindingIRDA()
    {
        $data = json_encode($this->request()->post('data'));

        echo $this->model->bindingIRDAToUser($data);
        $this->model->getMyInfo();

    }


    public function trialApplyAPI()
    {
        $getVcode = Session::instance()->get('vcodes');
        $data = $this->request()->post('data');
//        var_dump($getVcode);
//        exit();
        if ($getVcode == $data['vCode']) {
            $data['pdt_id'] = $data['menuID'];
            $data['userID'] = $data['u_id'] = $this->userInfo['userID'];
            $data['companyID'] = $this->userInfo['companyID'];
            $data['mobile'] = $this->userInfo['mobile'];
            $data['mail'] = $data['mail'];
            $data['token'] = $data['TOKEN'] = $this->userInfo['token'];
            echo $this->model->trialApply($data);
        } else {
            echo json_encode(['resCode' => -1, 'resMsg' => '输入的图形验证码错误']);
        }
    }


    /**
     * register send mail
     */
    public function registerSendMailAPI()
    {
        $getVcodes = Session::instance()->get('vcodes');
        $getAll = $this->request()->requestAll();
        if ($getAll['vcode'] == $getVcodes) {
            $ret = $this->__sendMail(
                '请点击以下链接完成邮箱绑定： https://irv.iresearch.com.cn/iResearchDataWeb/?m=user&a=registerUserInfo&',
                '用户注册确认邮件',
                1,
                $getAll['registerMail'],
                REGISTER_MAILADDR);
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


    /**
     * update userinfo
     *
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
                $this->userInfo['u_head'] = $userinfo['data']['headImg'];
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
     * setup my info
     */
    public function setMyInfo()
    {
        $updateUserInfo = [];
        $getData = json_decode(file_get_contents('php://input'), true);

//        if (!empty($getData['uname'])) {
//            $updateUserInfo['uname'] = $getData['uname'];
//        }

        if (!empty($getData['position'])) {
            $updateUserInfo['position'] = $getData['position'];
        }

//        if (!empty($getData['companyEmail'])) {
//            $updateUserInfo['u_mail'] = $getData['companyEmail'];
//        }

        if (!empty($getData['headImg'])) {
            $headImg = $getData['headImg'];
        }

        if (!empty($getData['department'])) {
            $updateUserInfo['department'] = $getData['department'];
        }

        if (!empty($headImg)) {
//            $serviceModel = Model::instance('Service');
//            $imgUrl = $serviceModel->uploadImage($this->userInfo['u_token'], toBase64(UPLOAD_PATH . trim($getData['headImg'], 'uploads')), 'png');
//            $imgData = json_decode($imgUrl, true);
            $updateUserInfo['headImg'] = $this->request()->post('headImg');;
        }

        if (!empty($getData['position']) || !empty($updateUserInfo['department']) || !empty($headImg)) {
            $updateUserInfo['TOKEN'] = $this->userInfo['token'];
            $updateUserInfo['userID'] = $this->userInfo['userID'];
            $ret = json_decode($this->model->setUserInfo($updateUserInfo), true);


            if ($ret['resCode'] == '000000') {
                $userinfo = json_decode($this->getUserInfo(), true);
                @ob_clean();
                $this->userInfo['u_head'] = $userinfo['data']['headImg'];
                if (!empty($uname)) {
                    $this->userInfo['uname'] = $userinfo['data']['uname'];
                }
//
                Session::instance()->set('userInfo', $this->userInfo);

            } else {
//                header("Location: ?m=user&a=fail");

            }
            _SUCCESS('000000', '已更新', $this->userInfo);
        } else {
            _SUCCESS('0000000', '没有更新的内容');
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
        echo $ret;
        return $ret;
    }

    /**
     * show head menu jsonp
     */
    public function showMenu()
    {

        $menu = [
            [
                'menuID' => 1,
                'menuName' => '艾瑞指数',
                'menuEName' => 'iRIndex',
                'menuIntro' => '艾瑞指数简介',
                'functionLabel' => null,
                'curl' => 'http%3A%2F%2Fdata.iresearch.com.cn%2FiRIndex.shtml',
                'versionType' => 1,
                'series' => 0,
                'menuVersion' => null,
                'pState' => 0,
                'pcState' => null,
                'isSubMenu' => 1,
            ], [
                'menuID' => 2,
                'menuName' => '艾瑞睿见',
                'menuEName' => 'iRView',
                'menuIntro' => '艾瑞睿见简介',
                'functionLabel' => null,
                'curl' => 'http%3A%2F%2Fdata.iresearch.com.cn%2FiRView.shtml',
                'versionType' => 1,
                'series' => 0,
                'menuVersion' => null,
                'pState' => 0,
                'pcState' => null,
                'isSubMenu' => 1,
            ], [
                'menuID' => 3,
                'menuName' => '艾瑞智云',
                'menuEName' => 'iRCloud',
                'menuIntro' => '艾瑞智云简介',
                'functionLabel' => null,
                'curl' => 'http%3A%2F%2Fdata.iresearch.com.cn%2FiRCloud.shtml',
                'versionType' => 1,
                'series' => 0,
                'menuVersion' => null,
                'pState' => 0,
                'pcState' => null,
                'isSubMenu' => 1,
            ], [
                'menuID' => 4,
                'menuName' => '关于我们',
                'menuEName' => 'AboutUs',
                'functionLabel' => null,
                'curl' => 'http%3A%2F%2Fdata.iresearch.com.cn%2FAbout.shtml',
                'versionType' => 0,
                'series' => 0,
                'menuVersion' => null,
                'pState' => 0,
                'pcState' => null,
                'isSubMenu' => 1,
            ],


        ];

        $pdt_id = $this->request()->get('pdtid');

        $this->__json();
        if ($this->userInfo['permissions'] != 0) {

            $k = (bool)((int)$this->__checkUnread('k'));
//            $k = false;
//            $m = (bool)((int)$this->__checkUnread('m'));
            $m = false;


            $role = 'member';
            $state = '20000';
            $m = [
                'msg' => [
                    'name' => '系统公告',
                    'uri' => urlencode('//irv.iresearch.com.cn/user-center/check?type=m'),
                    'new' => $m
                ],
                'knowledge' => [
                    'name' => '知识库',
                    'uri' => urlencode('//irv.iresearch.com.cn/user-center/check?type=k'),
                    'new' => $k
                ],
                'userInfo' => [
                    'name' => '用户信息',
//                    'uri' => urlencode(IDATA_URL . '?m=user&a=editUserInfo')
                    'uri' => urlencode('//irv.iresearch.com.cn/user-center/check?' . USERCENTER_VERSION)
                ],
                'logOut' => [
                    'name' => '登出',
                    'uri' => urlencode(IDATA_URL . '?m=user&a=logOut&pdtID=' . $pdt_id)
                ],
                'home' => ['name' => '首页', 'uri' => urlencode('//data.iresearch.com.cn/'), 'role' => $role]
            ];
        } else {
            $state = '20002';
            $role = 'guest';
            $m = [
                'logOut' => [
                    'name' => '登出',
                    'uri' => urlencode(IDATA_URL . '?m=user&a=logOut&pdtID=' . $pdt_id)
                ],
                'home' => ['name' => '首页', 'uri' => urlencode('https://data.iresearch.com.cn/'), 'role' => $role]
            ];
        }
        echo $this->request()->get('callback') . '(' . json_encode(['code' => $state, 'data' => $menu, 'userMenu' => $m]) . ')';

    }


    /**
     * get my info
     *
     */
    public function getMyInfo()
    {
        $this->__json();
        $data['token'] = $this->userInfo['token'];
        $data = $this->userDetail;
        $data['loginStatus'] = $this->loginStatus;


        $userInfo = $this->model->getUserInfo([
            'token' => $this->userInfo['token'],
            'userID' => $this->userInfo['userID']
        ]);
        $userInfo = json_decode($userInfo, true);
        $userInfo = $userInfo['data'];
        $bindingUserInfo = json_decode($this->model->bindUserInfo($this->userInfo), true);

        if ($userInfo['headImg'] == 'upload/head/') {
            $userInfo['headImg'] = null;
            $userInfo['headImg_base'] = null;
        } else {
            $userInfo['headImg'] = API_URL . $userInfo['headImg'];
            $userInfo['headImg_base'] = 'data:image/png;base64,' . toBase64($userInfo['headImg']);
        }

        if (!empty($userInfo['mobile'])) {
            _SUCCESS('000000', 'ok',
                [
                    'u_mail' => $userInfo['companyEmail'],
                    'company' => $userInfo['company'],
                    'mobile' => substr_replace($userInfo['mobile'], '****', 3, 4),
                    'expireDate' => substr($this->userInfo['validity'], 0, 10),
                    'department' => $userInfo['department'],
                    'avatar' => $userInfo['headImg'],
                    'avatar_base64' => $userInfo['headImg_base'],
                    'permissions' => $userInfo['permissions'],
                    'uname' => $userInfo['uname'],
                    'position' => $userInfo['position'],
                    'wechat' => $bindingUserInfo['data']['weixin']['type'],
                    'weChatNickName' => $bindingUserInfo['data']['weixin']['name'],
                ]
            );
        } else {
            _ERROR('000001', '获取信息失败');
        }


    }

    public function upAvatar()
    {
        $data = $this->request()->requestAll();

        write_to_log(']]]' . json_encode($data), '_avatar');
        write_to_log('>>' . json_encode($_FILES), '_avatar');
        $crop = new CropAvatar(
            isset($data['avatar_src']) ? $data['avatar_src'] : null,
            isset($data['avatar_data']) ? $data['avatar_data'] : null,
            isset($_FILES['avatar_file']) ? $_FILES['avatar_file'] : null
        );
        $msg = $crop->getMsg();
        write_to_log(empty($msg), '_avatar');

        if (empty($msg)) {
            $userInfo = [
                'userID' => $this->userInfo['userID'],
                'token' => $this->userInfo['token']
            ];

            write_to_log('upload: ' . UPLOAD_PATH . trim($crop->getResult(), 'uploads/'), '_avatar');

//            $userInfo['headImg'] = toBase64(UPLOAD_PATH . trim($crop->getResult(), 'uploads/'));
            $userInfo['headImg'] = base64_encode(file_get_contents(UPLOAD_PATH . trim($crop->getResult(), 'uploads/')));
            $this->__json();
//            write_to_log($userInfo['headImg'], '_avatar');
            echo $this->model->setUserInfo($userInfo);
        } else {
            write_to_log('error: ' . $msg, '_avatar');
            write_to_log('error' . $crop->getMsg(), '_avatar');
            _ERROR('000001', $crop->getMsg());
        }

    }

    /**
     * message heads
     */

    /*
     * get msg list
     *
     *
     * -type:
     *  -1: all, without user msg
     *  1: all, just public msg list
     *  2: only user msg without public msg
     *  3: product msg
     *  4: product msg without user
     *  5: knowledge base
     *
     *
     */
    public function msgHeads()
    {
        $getData = json_decode(file_get_contents('php://input'), true);

        if (DEBUG) {
            $this->__json();
        }

        if (!$this->loginStatus) {
            $ret = json_decode($this->userDetail, true);
            $type = $getData['type'];

            switch ($type) {
                case 'm':
                    $type_val = '4';
                    $pdt_list = [
                        [
                            'pdtID' => '0',
                            'type' => '-1',
                            'tabName' => '艾瑞数据公告'
                        ]
                    ];
                    $this->cache->hSet('m', $this->cache_key, false);

                    break;
                case 'k':
                    $type_val = '6';
                    $pdt_list = [];
                    $this->cache->hSet('k', $this->cache_key, false);
                    break;
                default:
                    $type_val = '4';
                    $pdt_list = [
                        [
                            'pdtID' => '0',
                            'type' => '1',
                            'tabName' => '艾瑞数据公告'
                        ]
                    ];
                    break;
            }

            $ret = $ret['data']['productList'];

            foreach ($ret as $pdt) {
                array_push($pdt_list, [
                    'pdtID' => $pdt['pdt_id'],
                    'tabName' => $pdt['pdt_ename'],
                    'type' => $type_val
                ]);
            }

            _SUCCESS('000000', 'OK', $pdt_list);

        } else {

            _ERROR('000001', '超时登入');

        }

    }

    public function msgList()
    {
        $getData = json_decode(file_get_contents('php://input'), true);
        $this->__json();

        if (empty($getData) or empty($getData['type'])) {
            _ERROR('000001', '不能为空字段');
        }


        if (!$this->loginStatus) {
            $getData['userID'] = $this->userInfo['userID'];
            $ret = $this->model->msgList($getData);
            echo $ret;
        } else {
            _ERROR('000001', '超时登入');
        }
    }

    public function msgDetail()
    {
        $getData = json_decode(file_get_contents('php://input'), true);
        $this->__json();

        if (!$this->loginStatus) {
            if (!empty($getData['msg_id'])) {
                $getData['msgID'] = $getData['msg_id'];
            } else {
                _ERROR('000001', '不能为空字段');
            }
            $getData['userID'] = $this->userInfo['userID'];
            $ret = $this->model->msgDetail($getData);
            echo $ret;
        } else {
            _ERROR('000001', '超时登入');
        }
    }

    public function getUserPoint()
    {
        $getData = json_decode(file_get_contents('php://input'), true);
        if (empty($getData) or empty($getData['userID'])) {
            _ERROR('000001', '缺少参数');
        }
        $data = [
            'u_id' => $getData['userID'],
            'TOKEN' => $this->userInfo['token'],
            'userID' => $this->userInfo['userID'],
        ];
        echo $this->model->getUserPoint($data);
    }

    public function getUserPointList()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data) or empty($data['userID'])) {
            _ERROR('000001', '缺少参数');
        }
        echo $this->model->getUserPointList($data);
    }

    public function userProductInfo()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $data = [
            'u_id' => $data['userID'],
            'cpy_id' => $this->userInfo['companyID'],
            'TOKEN' => $this->userInfo['token'],
            'userID' => $this->userInfo['userID']
        ];
        echo $this->model->userProductInfo($data);
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
     *
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
        if (!DEBUG) {
            @@ob_clean();
            header('Content-type: application/json;charset=utf-8');
            header('Content-Encoding: utf-8');
        }
    }

    /**
     * main menu
     *
     * @param array $menuData
     *
     * @return array
     */
    private function __mainMenu(array $menuData)
    {
        foreach ($menuData as $menuDataKey => $menuDatum) {
            $re = [];
            if (count($menuDatum['lowerTree']) > 4) {
                for ($i = 0; $i < ceil(count($menuDatum['lowerTree'])); $i++) {
                    $v = array_slice($menuDatum['lowerTree'], $i * 4, 4);
                    if (!empty($v)) {
                        $re[$i]['list'] = $v;
                    }
                }
            } else {
                $re[0]['list'] = $menuDatum['lowerTree'];
            }
            $menuData[$menuDataKey]['reTree'] = $re;
        }
        return $menuData;
    }

    /**
     *
     * php: 1 is true and 0 is false
     *
     * true: unread
     * false: readed
     * @param $key
     * @return bool|string
     */
    private function __checkUnread($key)
    {
        if ($this->cache->hExists($key, $this->cache_key)) {
            //has set read status
            return $this->cache->hGet($key, $this->cache_key);

        } else {
            //not set read status
            return true;
        }
    }
}
