<?php

/**
 * Copyright © 艾瑞咨询集团(http://www.iresearch.com.cn/)
 * Author DavidWei <davidwei@iresearch.com.cn>
 * Create 16-08-10 14:34
 */
class IndexController extends Controller
{

    private $loginStatus, $userInfo, $serviceModel, $userDetail, $userModel, $cache_key;

    function __construct()
    {
        $this->userInfo = Session::instance()->get('userInfo');
        $this->serviceModel = Model::instance('service');
        $this->userModel = Model::instance('user');

        $this->cache = new CacheClass();
        $this->cache = $this->cache->redis;

        if (!empty($this->userInfo)) {

            $this->cache_key = $this->userInfo['token'] . '_cache';

            $this->loginStatus = FALSE;
            if ($this->cache->hExists($this->cache_key, 'userDetail')) {
                $this->userDetail = json_decode($this->cache->hGet($this->cache_key, 'userDetail'),true);
            } else {
                $userDetail = $this->userModel->getUserInfo([
                    'token' => $this->userInfo['token'],
                    'userID' => $this->userInfo['userID']
                ]);
                $this->userDetail = json_decode($userDetail, true);
                $this->cache->hSet($this->cache_key, 'userDetail', $userDetail);
                $this->cache->expire($this->cache_key, REDIS_TIME_OUT);
            }

            if (DEBUG){
                var_dump($this->userModel->checkToken());
            }

            if (!$this->userModel->checkToken()) {
                $this->loginStatus = true;
                $this->userDetail = false;
            }
        } else {
            $this->loginStatus = TRUE;
            $this->userDetail = false;
        }
    }

    /**
     * 首页
     */
    public function home()
    {
        $this->index();
    }

    public function index()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['token'];

        //$userIndustry = Model::instance('Industry')->getUserIndustry($data);
        $userModel = Model::instance('user');
        $menu = json_decode($userModel->showMenu(), true);

        $menu = $menu['data']['dataList'];

        if (empty(trim($userInfo['productKey']))) {
            //没有绑定
            $data['irdStatus'] = 1;
        } else {
            //绑定
            $data['irdStatus'] = 2;
        }

        $menu = fillMenu($menu, null, $data['irdStatus']);

        $data = array(
            "YH" => YH_LOGIN,
            //"userIndustry" => $userIndustry,
            'loginStatus' => $this->loginStatus,
            'userInfo' => $this->userInfo,
            'token' => $this->userInfo['token'],
            'userID' => $this->userInfo['userID'],
            'role' => $this->userInfo['permissions'],
            'title' => WEBSITE_TITLE,
//            'kolLink' => $this->kolLink(),
            'company' => $this->userInfo['companyName'],
            'menu' => $menu,
            'titleMenu' => $menu[1]['subMenu'],
            'mainMenu' => is_array($menu[1]['subMenu']) ? $this->__mainMenu($menu[1]['subMenu']) : null
        );

        foreach ($data['titleMenu'] as $i => $v) {
            if (!isset($v['lowerTree'])) {
                unset($data['titleMenu'][$i]);
            }
        }
//        pr($data);
        View::instance('index/home.tpl')->show($data);

//        header('Location: http://data.iresearch.com.cn/iRView.shtml');
    }

    public function irIndex()
    {
        $userModel = Model::instance('user');
        $menu = json_decode($userModel->showMenu(), true);
        $menu = $menu['data']['dataList'];
        $menu = fillMenu($menu);

        $data = array(
            'token' => $this->userInfo['token'],
            'userID' => $this->userInfo['userID'],
            'role' => $this->userInfo['permissions'],
            'title' => WEBSITE_TITLE,
            'menu' => $menu,
            'titleMenu' => $menu[1]['subMenu'],
            'mainMenu' => is_array($menu[1]['subMenu']) ? $this->__mainMenu($menu[1]['subMenu']) : null
        );
        View::instance('index/irIndex.tpl')->show($data);
    }

    public function oneInsight()
    {
        $userModel = Model::instance('user');
        $menu = json_decode($userModel->showMenu(), true);
        $menu = $menu['data']['dataList'];
        $menu = fillMenu($menu);

        $data = array(
            'token' => $this->userInfo['token'],
            'userID' => $this->userInfo['userID'],
            'role' => $this->userInfo['permissions'],
            'title' => WEBSITE_TITLE,
            'menu' => $menu,
            'titleMenu' => $menu[1]['subMenu'],
            'mainMenu' => is_array($menu[1]['subMenu']) ? $this->__mainMenu($menu[1]['subMenu']) : null,
        );
        $data['url'] = "http://180.76.182.158:9123/oneinsight-user/cas/authenticate?token=" . $data['token'] . "&pid=36";
        if ($this->request()->get('backType', 0) == '0') {
            $backURL = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $callBack = urlencode($backURL . '&backType=1&active_menu=iRCloud');
            $jumpURL = $data['url'] . '&irv_callback=' . $callBack;
//            echo $jumpURL;
//            exit();
            header("Location:" . $jumpURL);
        }
        View::instance('index/publicFrame.tpl')->show($data);
    }

    public function checkMail()
    {
        $data = [
            'pi' => $this->request()->get('pi'),
            'cd' => $this->request()->get('cd')
        ];

        $ret = Model::instance('user')->checkMail($data);
        $ret = json_decode($ret, true);

        echo("<SCRIPT LANGUAGE=\"JavaScript\">
            alert(\"{$ret['resMsg']} \");
            window.parent.frames.location.href=\"?m=index\";
            </SCRIPT>");

    }

    /**
     * ir cloud
     */
    public function iCloud()
    {

        header("Location:" . 'http://ircloud.iresearchdata.cn/irbase/check/?token=' . $this->userInfo['token']);
    }

    /**
     * ir cloud
     */
    public function iAppCheck()
    {

        header("Location:" . 'http://ircloud.iresearchdata.cn/ircloud-app-check/check?token=' . $this->userInfo['token']);
    }

    /**
     * ir cloud
     */
    public function xAdt()
    {
        header("Location:" . 'http://irv.iresearch.com.cn/adt/?language=zh-CN&token=' . $this->userInfo['token']);
    }

    public function testAdt()
    {
        header("Location:" . 'http://irv.iresearch.com.cn/adt2/?language=zh-CN&token=' . $this->userInfo['token']);
    }

    public function mst()
    {

        $data = array(
            'url' => 'http://113.200.91.81/web/login?token=' . $this->userInfo['token']
        );

        header("Location:" . $data['url']);
    }


    public function iCloudInApp()
    {

        $data = array(
            'url' => 'http://ircloud.iresearchdata.cn/ircloud-inapp/login?token=' . $this->userInfo['token']
        );

        header("Location:" . $data['url']);
    }

    /**
     * ir cloud
     */
    public function iECTracker()
    {
        header("Location:" . 'http://ect.itracker.cn/nloginv2/?token=' . $this->userInfo['token']);
    }

    /**
     * home page
     */


    public function indexTest()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['token'];
        $userModel = Model::instance('user');
        $menu = json_decode($userModel->showMenu(), true);
        $menu = $menu['data']['dataList'];
        $menu = fillMenu($menu);

        $data = array(
//            "YH" => YH_LOGIN,
//            "userIndustry" => $userIndustry,
            'loginStatus' => $this->loginStatus,
            'userInfo' => $this->userInfo,
            'token' => $this->userInfo['token'],
            'userID' => $this->userInfo['userID'],
            'role' => $this->userInfo['permissions'],
            'title' => WEBSITE_TITLE,
            'kolLink' => $this->kolLink(),
            'company' => $this->userInfo['companyName'],
            'menu' => $menu,
            'titleMenu' => $menu[1]['subMenu']
        );
        if (empty(trim($userInfo['productKey']))) {
            $data['irdStatus'] = 1;
        } else {
            $data['irdStatus'] = 0;
        }

        View::instance('index/home.tpl')->show($data);
    }

    /**
     * KOL PAGE
     */
    public function kolPage()
    {
        $pdtID = 31;
        //在将艾瑞数据域名调整为 iresearchdata.cn前新窗口打开ikol
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $userModel = Model::instance('user');
        $menu = json_decode($userModel->showMenu(), true);
        $menu = $menu['data']['dataList'];
        $menu = fillMenu($menu);
//        $userIndustry = Model::instance('Industry')->getUserIndustry($data);
        $data = array(
//            "YH" => YH_LOGIN,
//            "userIndustry" => $userIndustry,
            'loginStatus' => $this->loginStatus,
            'userInfo' => $this->userInfo,
            'token' => $this->userInfo['token'],
            'userID' => $this->userInfo['userID'],
            'role' => $this->userInfo['permissions'],
            'title' => WEBSITE_TITLE,
            'kolLink' => $this->kolLink(),
            'menu' => $menu,
            'titleMenu' => $menu[1]['subMenu'],
            'mainMenu' => is_array($menu[1]['subMenu']) ? $this->__mainMenu($menu[1]['subMenu']) : null
        );

        if ($this->__checkPermission($pdtID)) {

            $logs = $this->serviceModel->recordLogs([
                'user' => $this->userInfo['userID'],
                'userID' => $this->userInfo['userID'],
                'TOKEN' => $this->userInfo['token'],
                'token' => $this->userInfo['token'],
                'companyID' => $this->userInfo['companyID'],
                'action' => '访问产品',
                'sub_id' => $pdtID,
                'recordLogs' => 'KOL访问',
                'status' => '20000',
                'resource' => 'iData',
                'level' => '1',
                'type' => '用户日志',
                'log_ip' => getIp()
            ]);

            View::instance('service/kol.tpl')->show($data);
        } else {
            View::instance('index/error.tpl')->show(['message' => '访问错误']);
            $logs = $this->serviceModel->recordLogs([
                'user' => $this->userInfo['userID'],
                'sub_id' => $pdtID,
                'recordLogs' => 'KOL访问',
                'status' => '40000',
                'resource' => 'iData',
                'level' => '1',
                'action' => '访问产品',
                'type' => '用户日志',
                'log_ip' => getIp()
            ]);
        }
        write_to_log(json_encode($logs, '_logs'));
//        header("Location:".$this->kolLink());
    }

    /**
     * 媒介计划
     */
    public function mutMedia()
    {
        $pdt_id = 11;
        $userModel = Model::instance('user');
        $menu = json_decode($userModel->showMenu(), true);
        $menu = $menu['data']['dataList'];
        $menu = fillMenu($menu);

        $data = array(
            'token' => $this->userInfo['token'],
            'userID' => $this->userInfo['userID'],
            'role' => $this->userInfo['permissions'],
            'title' => WEBSITE_TITLE,
            'menu' => $menu,
            'titleMenu' => $menu[1]['subMenu'],
            'mainMenu' => is_array($menu[1]['subMenu']) ? $this->__mainMenu($menu[1]['subMenu']) : null
        );


        if ((int)$this->userInfo['permissions'] > 0) {
            if ($this->__checkPermission($pdt_id)) {
                View::instance('index/mutmedia.tpl')->show($data);
            } else {

            }
        } else {
            echo("<SCRIPT LANGUAGE=\"JavaScript\">
            alert(\"您并未开通此功能\");
            window.parent.frames.location.href=\"?m=index\";
            </SCRIPT>");
        }
    }

    public function ottMonitorApp()
    {


        $data = array(

            'url' => YH_REPORT71 . '&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B908&token=' . $this->userInfo['token'] .
                '&userID=' . $this->userInfo['userID'] . '&pdt_id=19'
        );
        //'url' => YH_REPORT.'&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B663&token=' . $this->userInfo['token'].'&userID='.$this->userInfo['userID'].'&pdt_id=19'
        //'url' => YH_REPORT71.'&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B908&token=' . $this->userInfo['token'].'&userID='.$this->userInfo['userID'].'&pdt_id=19'
        header("Location:" . $data['url']);
//        View::instance('index/publicFrame.tpl')->show($data);
    }

    /**
     * iut
     */
    public function iut()
    {

        $data = array(

            'url' => YH_REPORT71 . '&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B906&token=' . $this->userInfo['token'] . '&userID=' . $this->userInfo['userID'] . '&pdt_id=12'
        );
        //'url' => YH_REPORT . '&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B900&token=' . $this->userInfo['token'] . '&userID=' . $this->userInfo['userID'] . '&pdt_id=12'
        //'url' => YH_REPORT71 . '&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B906&token=' . $this->userInfo['token'] . '&userID=' . $this->userInfo['userID'] . '&pdt_id=12'
        header("Location:" . $data['url']);
//        View::instance('index/publicFrame.tpl')->show($data);
    }

    /**
     * mvt
     */
    public function mvt()
    {

        $data = array(
            'url' => YH_REPORT71 . '&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B902&token=' . $this->userInfo['token'] . '&userID=' . $this->userInfo['userID'] . '&pdt_id=18'
        );
        //'url' => YH_REPORT.'&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B616&token=' . $this->userInfo['token'].'&userID='.$this->userInfo['userID'].'&pdt_id=18'
        //'url' => YH_REPORT71 . '&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B902&token=' . $this->userInfo['token'] . '&userID=' . $this->userInfo['userID'] . '&pdt_id=18'
        header("Location:" . $data['url']);
//        View::instance('index/publicFrame.tpl')->show($data);
    }


    public function ivt()
    {
        $userModel = Model::instance('user');
        $menu = json_decode($userModel->showMenu(), true);
        $menu = $menu['data']['dataList'];
        $menu = fillMenu($menu);
        $data = array(
            'token' => $this->userInfo['token'],
            'userID' => $this->userInfo['userID'],
            'role' => $this->userInfo['permissions'],
            'title' => WEBSITE_TITLE,
            'menu' => $menu,
            'titleMenu' => $menu[1]['subMenu'],
            'mainMenu' => is_array($menu[1]['subMenu']) ? $this->__mainMenu($menu[1]['subMenu']) : null,
            'url' => YH_REPORT71 . '&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B914&token=' . $this->userInfo['token'] . '&userID=' . $this->userInfo['userID'] . '&pdt_id=45'
        );
        //'url' => YH_REPORT.'&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B616&token=' . $this->userInfo['token'].'&userID='.$this->userInfo['userID'].'&pdt_id=18'
        //'url' => YH_REPORT71 . '&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B902&token=' . $this->userInfo['token'] . '&userID=' . $this->userInfo['userID'] . '&pdt_id=18'
        header("Location:" . $data['url']);
//        View::instance('index/publicFrame.tpl')->show($data);
    }

    /**
     * mut
     */
    public function mut()
    {
        $userModel = Model::instance('user');
        $menu = json_decode($userModel->showMenu(), true);
        $menu = $menu['data']['dataList'];
        $menu = fillMenu($menu);
        $data = array(
            'token' => $this->userInfo['token'],
            'userID' => $this->userInfo['userID'],
            'role' => $this->userInfo['permissions'],
            'title' => WEBSITE_TITLE,
            'menu' => $menu,
            'titleMenu' => $menu[1]['subMenu'],
            'mainMenu' => is_array($menu[1]['subMenu']) ? $this->__mainMenu($menu[1]['subMenu']) : null,
            'url' => YH_REPORT71 . '&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B907&token=' . $this->userInfo['token'] . '&userID=' . $this->userInfo['userID'] . '&pdt_id=37'
        );
        //'url' => YH_REPORT . '&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B901&token=' . $this->userInfo['token'] . '&userID=' . $this->userInfo['userID'] . '&pdt_id=37'
        //'url' => YH_REPORT71 . '&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B907&token=' . $this->userInfo['token'] . '&userID=' . $this->userInfo['userID'] . '&pdt_id=37'
        header("Location:" . $data['url']);
//        View::instance('index/publicFrame.tpl')->show($data);
    }

    public function iutbeta()
    {
        $userModel = Model::instance('user');
        $menu = json_decode($userModel->showMenu(), true);
        $menu = $menu['data']['dataList'];
        $menu = fillMenu($menu);
        $data = array(
            'token' => $this->userInfo['token'],
            'userID' => $this->userInfo['userID'],
            'role' => $this->userInfo['permissions'],
            'title' => WEBSITE_TITLE,
            'menu' => $menu,
            'titleMenu' => $menu[1]['subMenu'],
            'mainMenu' => is_array($menu[1]['subMenu']) ? $this->__mainMenu($menu[1]['subMenu']) : null,
            'url' => YH_REPORT71 . '&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B929&token=' . $this->userInfo['token'] . '&userID=' . $this->userInfo['userID'] . '&pdt_id=49&terminal=pc'
        );

        $info = array(
            "token" => $this->userInfo['token'],
            "TOKEN" => $this->userInfo['token'],
            "pdt_id" => '49',
            "userID" => $this->userInfo['userID'],
            'terminal' => 'pc'
        );

        $getP = json_decode(Model::instance('user')->getPermission($info), true);

        if ($getP['resCode'] == '20000') {
            header("Location:" . $data['url']);
        } else {
            header('Location: ?m=user&a=trialApply&ppname=网络用户行为监测BETA版本&menuID=49');
        }
    }

    public function mutbeta()
    {
        $userModel = Model::instance('user');
        $menu = json_decode($userModel->showMenu(), true);
        $menu = $menu['data']['dataList'];
        $menu = fillMenu($menu);
        $data = array(
            'token' => $this->userInfo['token'],
            'userID' => $this->userInfo['userID'],
            'role' => $this->userInfo['permissions'],
            'title' => WEBSITE_TITLE,
            'menu' => $menu,
            'titleMenu' => $menu[1]['subMenu'],
            'mainMenu' => is_array($menu[1]['subMenu']) ? $this->__mainMenu($menu[1]['subMenu']) : null,
            'url' => YH_REPORT71 . '&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B930&token=' . $this->userInfo['token'] . '&userID=' . $this->userInfo['userID'] . '&pdt_id=49&terminal=mobile'
        );
        $info = array(
            "token" => $this->userInfo['token'],
            "TOKEN" => $this->userInfo['token'],
            "pdt_id" => '49',
            "userID" => $this->userInfo['userID'],
            'terminal' => 'mobile'
        );

        $getP = json_decode(Model::instance('user')->getPermission($info), true);

        if ($getP['resCode'] == '20000') {
            header("Location:" . $data['url']);
        } else {
            header('Location: ?m=user&a=trialApply&ppname=网络用户行为监测BETA版本&menuID=49');
        }
    }

    /**
     * 个推报告
     */
    public function sReport()
    {
        $guid = $this->request()->get('guid');
        $pdtID = $this->request()->get('pdtid');
        $taskID = $this->request()->get('taskid');
        $showMenu = $this->request()->get('showMemu');
        $url = YH_REPORT37 . '&guid=' . $guid . '&token=' . $this->userInfo['token'] . '&userID=' .
            $this->userInfo['userID'] . '&pdt_id=' . $pdtID . '&taskid=' . $taskID . '&showMemu=' . $showMenu;
        header("Location:" . $url);
    }


    public function kReport()
    {
        $guid = $this->request()->get('guid');
        $pdtID = $this->request()->get('pdtid');
        $key = $this->request()->get('key');
        $showMenu = $this->request()->get('showMemu');
        $url = YH_REPORT37 . '&guid=' . $guid . '&token=' . $this->userInfo['token'] . '&userID=' .
            $this->userInfo['userID'] . '&pdt_id=' . $pdtID . '&key=' . $key . '&showMemu=' . $showMenu;
        header("Location:" . $url);
    }

    public function nReport()
    {
        $url = YH_REPORT37 . '&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B913' . '&token=' . $this->userInfo['token'] .
            '&userID=' . $this->userInfo['userID'] . '&pdt_id=37';
        header("Location:" . $url);
    }

    public function bReport()
    {
        $guid = $this->request()->get('guid');
        $url = YH_REPORT37 . '&guid=' . $guid . '&token=' . $this->userInfo['token'] .
            '&userID=' . $this->userInfo['userID'] . '&pdt_id=13';
        header("Location:" . $url);
    }

    /**
     * demo
     */
    public function demo()
    {
//        $userModel = Model::instance('user');
//        $menu = json_decode($userModel->showMenu(), true);
//        $menu = $menu['data']['dataList'];
//        $menu = fillMenu($menu);
//        $data = array(
//            'token' => $this->userInfo['token'],
//            'userID' => $this->userInfo['userID'],
//            'role' => $this->userInfo['permissions'],
//            'title' => WEBSITE_TITLE,
//            'menu' => $menu,
//            'titleMenu' => $menu[1]['subMenu'],
//            'mainMenu' => is_array($menu[1]['subMenu']) ? $this->__mainMenu($menu[1]['subMenu']) : null,
//            'url' => YH_REPORT.'&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B901&token=' . $this->userInfo['token'].'&userID='.$this->userInfo['userID'].'&pdt_id=37'
//        );
//        View::instance('index/publicFrame.tpl')->show($data);
    }

    public function kolLink()
    {
        $rMail = $this->userInfo['mobile'];
        $mail = urlencode($rMail);
        $rkey = $rMail . $rMail . date('YmdH');
        $key = strtoupper(md5($rkey, false));
        $ret = KOL_API . "?u={$mail}&e={$mail}&ukey={$key}";
        return $ret;
    }

    public function xvt()
    {

        $userInfo = Session::instance()->get('userInfo');
//        if (isset($userInfo['token'])) {
//            $data['token'] = $userInfo['token'];
//        } else {
//            $data['token'] = 1;
//        }
        $data = [];

        if (empty(trim($userInfo['productKey']))) {
            //没有绑定
            $data['irdStatus'] = 1;
        } else {
            //绑定
            $data['irdStatus'] = 2;
        }

        $data['apply_ivt'] = $data['apply_mvt'] = $data['apply_ovt'] = '登录使用';
        $data['apply_beta_ivt'] = $data['apply_beta_mvt'] = '登录使用(老版本)';
        $data['apply_ivt_en'] = $data['apply_mvt_en'] = $data['apply_beta_ivt_en'] = $data['apply_beta_mvt_en'] = 'Sign In';

        $data['ivt_oldurl'] = '?m=irdata&a=classicSys&ppname=PC端视频内容市场监测&pro=47';
        $data['ivt_oldurl_en'] = '?m=irdata&a=classicSys&ppname=ivt-en&pro=52';
        $data['mvt_oldurl'] = '?m=irdata&a=classicSys&ppname=移动端用户行为监测_经典版&pro=47';
        $data['mvt_oldurl_en'] = '?m=irdata&a=classicSys&ppname=mvt-en&pro=52';
        $data['ovt_oldurl'] = '?m=irdata&a=classicSys&ppname=移动端用户行为监测_经典版&pro=47';
        $data['ovt_oldurl_en'] = '?m=irdata&a=classicSys&ppname=ovt-en&pro=52';

        if ($this->userDetail) {
            $data['apply_ivt'] = $data['apply_mvt'] = $data['apply_ovt'] = '申请试用';
            $data['apply_beta_ivt'] = $data['apply_beta_mvt'] = '申请试用(老版本)';
            $data['apply_ivt_en'] = $data['apply_mvt_en'] = $data['apply_beta_ivt_en'] = $data['apply_beta_mvt_en'] = 'Trial';

            $data['ovt_oldurl'] = '?m=user&a=trialApply&ppname=移动端视频市场监测&menuID=47';
            $data['ovt_oldurl_en'] = '?m=user&a=trialApply&ppname=移动端视频市场监测(英文)&menuID=52';
            $data['ivt_oldurl'] = '?m=user&a=trialApply&ppname=PC端视频内容市场监测&menuID=47';
            $data['ivt_oldurl_en'] = '?m=user&a=trialApply&ppname=PC端视频内容市场监测(英文)&menuID=52';
            $data['mvt_oldurl'] = '?m=user&a=trialApply&ppname=移动端视频市场监测&menuID=47';
            $data['mvt_oldurl_en'] = '?m=user&a=trialApply&ppname=移动端视频市场监测(英文)&menuID=52';

            if (isset($userInfo['token'])) {
                $data['token'] = $userInfo['token'];

                $date = date('Y-m-d');

                if (is_array($this->userDetail['data']['productList'])) {
                    foreach ($this->userDetail['data']['productList'] as $datum) {

                        if ($datum['pdt_id'] == 47) {
                            if ($date >= $datum['pc_start_time'] and $date <= $datum['pc_due_time']) {
                                $data['apply_ivt'] = '开始使用';
                                $data['apply_beta_ivt'] = '开始使用(老版本)';
//                                $data['apply_ivt_en'] = 'English Version';
                                $data['ivt_oldurl'] = '?m=irdata&a=classicSys&ppname=PC端视频内容市场监测&pro=47';
//                                $data['ivt_oldurl_en'] = '?m=irdata&a=classicSys&ppname=ivt-en&pro=52';

                            } else {
                                $data['apply_ivt'] = '申请试用';
                                $data['apply_beta_ivt'] = '申请试用(老版本)';
                                $data['apply_ivt_en'] = 'Trial';
                                $data['ivt_oldurl'] = '?m=user&a=trialApply&ppname=PC端视频内容市场监测&menuID=47';
                                $data['ivt_oldurl_en'] = '?m=user&a=trialApply&ppname=PC端视频内容市场监测(英文)&menuID=52';
                            }

                            if ($date >= $datum['mobile_start_time'] and $date <= $datum['mobile_due_time']) {
                                $data['apply_mvt'] = '开始使用';
//                                $data['apply_mvt_en'] = 'English Version';
                                $data['mvt_oldurl'] = '?m=irdata&a=classicSys&ppname=移动端用户行为监测_经典版&pro=47';
//                                $data['mvt_oldurl_en'] = '?m=irdata&a=classicSys&ppname=mvt-en&pro=52';

                            } else {
                                $data['apply_mvt'] = '申请试用';
                                $data['apply_mvt_en'] = 'Trial';
                                $data['mvt_oldurl'] = '?m=user&a=trialApply&ppname=移动端视频市场监测&menuID=47';
                                $data['mvt_oldurl_en'] = '?m=user&a=trialApply&ppname=移动端视频市场监测(英文)&menuID=52';
                            }

                            if ($date >= $datum['ott_start_time'] and $date <= $datum['ott_due_time']) {
                                $data['apply_ovt'] = '开始使用';
//                                $data['apply_ovt_en'] = 'English Version';
                                $data['ovt_oldurl'] = '?m=irdata&a=classicSys&ppname=移动端用户行为监测_经典版&pro=47';
//                                $data['ovt_oldurl_en'] = '?m=irdata&a=classicSys&ppname=mvt-en&pro=52';

                            } else {
                                $data['apply_ovt'] = '申请试用';
                                $data['apply_ovt_en'] = 'Trial';
                                $data['ovt_oldurl'] = '?m=user&a=trialApply&ppname=移动端视频市场监测&menuID=47';
//                                $data['ovt_oldurl_en'] = '?m=user&a=trialApply&ppname=移动端视频市场监测(英文)&menuID=52';
                            }
                        }

                        //vt english
                        if ($datum['pdt_id'] == 52) {
                            if ($date >= $datum['pc_start_time'] and $date <= $datum['pc_due_time']) {
                                $data['apply_ivt'] = '开始使用';
                                $data['apply_ivt_en'] = 'English Version';
                                $data['ivt_oldurl_en'] = '?m=irdata&a=classicSys&ppname=ivt-en&pro=52';

                            } else {
                                $data['apply_ivt_en'] = 'Trial';
                                $data['ivt_oldurl_en'] = '?m=user&a=trialApply&ppname=PC端视频内容市场监测(英文)&menuID=52';
                            }

                            if ($date >= $datum['mobile_start_time'] and $date <= $datum['mobile_due_time']) {
                                $data['apply_mvt_en'] = 'English Version';
                                $data['mvt_oldurl_en'] = '?m=irdata&a=classicSys&ppname=mvt-en&pro=52';

                            } else {
                                $data['apply_mvt_en'] = 'Trial';
                                $data['mvt_oldurl_en'] = '?m=user&a=trialApply&ppname=移动端视频市场监测(英文)&menuID=52';
                            }

                            if ($date >= $datum['ott_start_time'] and $date <= $datum['ott_due_time']) {
                                $data['apply_ovt_en'] = 'English Version';
                                $data['ovt_oldurl_en'] = '?m=irdata&a=classicSys&ppname=mvt-en&pro=52';

                            } else {
                                $data['apply_ovt_en'] = 'Trial';
                                $data['ovt_oldurl_en'] = '?m=user&a=trialApply&ppname=移动端视频市场监测(英文)&menuID=52';
                            }
                        }


                    }
                }


            } else {
                $data['token'] = 1;
            }

        } else {
            $data['token'] = 1;
        }

        if (DEBUG) {
            pr($data);
            pr($this->userDetail);
            exit();
        }
        View::instance('xvt/vt.tpl')->show($data);
    }

//    public function xvtSearch()
//    {
//        $data = [];
//        $userInfo = Session::instance()->get('userInfo');
//
//        if (isset($userInfo['token'])) {
//            $data['token'] = $userInfo['token'];
//        } else {
//            $data['token'] = 1;
//        }
//
//        if (empty(trim($userInfo['productKey']))) {
//            //没有绑定
//            $data['irdStatus'] = 1;
//        } else {
//            //绑定
//            $data['irdStatus'] = 2;
//        }
//        View::instance('xvt/search.tpl')->show($data);
//    }


    public function xut()
    {
        $data = [];
        $userInfo = Session::instance()->get('userInfo');


        if (preg_match('/^400/', $userInfo['mobile'])) {
            $data['authType'] = 1;
        } else {
            $data['authType'] = 2;
        }

//        if (isset($userInfo['token'])) {
//            $data['token'] = $userInfo['token'];
//        } else {
//            $data['token'] = 1;
//        }
        $data['apply_iut'] = $data['apply_mut'] = '登录使用';
        $data['apply_beta_iut'] = $data['apply_beta_mut'] = '登录使用(BETA)';
        $data['apply_iut_en'] = $data['apply_mut_en'] = $data['apply_beta_iut_en'] = $data['apply_beta_mut_en'] = 'Sign In';

        $data['iut_oldurl'] = '?m=irdata&a=classicSys&ppname=PC端用户行为监测_经典版&pro=48';
        $data['iut_oldurl_en'] = '?m=irdata&a=classicSys&ppname=iut-en&pro=51';
        $data['mut_oldurl'] = '?m=irdata&a=classicSys&ppname=移动端用户行为监测_经典版&pro=48';
        $data['mut_oldurl_en'] = '?m=irdata&a=classicSys&ppname=mut-en&pro=51';


        if ($this->userDetail) {

            $data['apply_iut'] = $data['apply_mut'] = '申请试用';
            $data['apply_beta_iut'] = $data['apply_beta_mut'] = '申请试用(BETA)';
            $data['apply_iut_en'] = $data['apply_mut_en'] = $data['apply_beta_iut_en'] = $data['apply_beta_mut_en'] = 'Trial';
            $data['iut_oldurl'] = '?m=user&a=trialApply&ppname=网络视频市场监测&menuID=48';
            $data['iut_oldurl_en'] = '?m=user&a=trialApply&ppname=网络视频市场监测(英文)&menuID=51';
            $data['mut_oldurl'] = '?m=user&a=trialApply&ppname=移动端视频市场监测&menuID=48';
            $data['mut_oldurl_en'] = '?m=user&a=trialApply&ppname=移动端视频市场监测(英文)&menuID=51';

            if (isset($userInfo['token'])) {
                $data['token'] = $userInfo['token'];

                $date = date('Y-m-d');

                if (is_array($this->userDetail['data']['productList'])) {
                    foreach ($this->userDetail['data']['productList'] as $datum) {

                        if ($datum['pdt_id'] == 48) {
                            if ($date >= $datum['pc_start_time'] and $date <= $datum['pc_due_time']) {
                                $data['apply_iut'] = '开始使用';
//                                $data['apply_iut_en'] = 'English Version';
                                $data['iut_oldurl'] = '?m=irdata&a=classicSys&ppname=PC端用户行为监测_经典版&pro=48';
//                                $data['iut_oldurl_en'] = '?m=irdata&a=classicSys&ppname=iut-en&pdtID=51';

                            } else {
                                $data['apply_iut'] = '申请试用';
//                                $data['apply_iut_en'] = 'Trial';
                                $data['iut_oldurl'] = '?m=user&a=trialApply&ppname=网络视频市场监测&menuID=48';
//                                $data['iut_oldurl_en'] = '?m=user&a=trialApply&ppname=网络视频市场监测(英文)&menuID=48';
                            }

                            if ($date >= $datum['mobile_start_time'] and $date <= $datum['mobile_due_time']) {
                                $data['apply_mut'] = '开始使用';
//                                $data['apply_mut_en'] = 'English Version';
                                $data['mut_oldurl'] = '?m=irdata&a=classicSys&ppname=移动端用户行为监测_经典版&pro=48';
//                                $data['mut_oldurl_en'] = '?m=irdata&a=classicSys&ppname=mut-en&pro=51';
                            } else {
                                $data['apply_mut'] = '申请试用';
//                                $data['apply_mut_en'] = 'Trial';
                                $data['mut_oldurl'] = '?m=user&a=trialApply&ppname=移动端视频市场监测&menuID=48';
//                                $data['mut_oldurl_en'] = '?m=user&a=trialApply&ppname=移动端视频市场监测(英文)&menuID=51';
                            }
                        }

                        if ($datum['pdt_id'] == 51) {
                            echo('a');
                            if ($date >= $datum['pc_start_time'] and $date <= $datum['pc_due_time']) {
                                $data['apply_iut_en'] = 'English Version';
                                $data['iut_oldurl_en'] = '?m=irdata&a=classicSys&ppname=iut-en&pdtID=51';

                            } else {
                                $data['apply_iut_en'] = 'Trial';
                                $data['iut_oldurl_en'] = '?m=user&a=trialApply&ppname=网络视频市场监测(英文)&menuID=48';
                            }

                            if ($date >= $datum['mobile_start_time'] and $date <= $datum['mobile_due_time']) {
                                $data['apply_mut_en'] = 'English Version';
                                $data['mut_oldurl_en'] = '?m=irdata&a=classicSys&ppname=mut-en&pro=51';
                            } else {
                                $data['apply_mut_en'] = 'Trial';
                                $data['mut_oldurl_en'] = '?m=user&a=trialApply&ppname=移动端视频市场监测(英文)&menuID=51';
                            }
                        }

                        if ($datum['pdt_id'] == 49) {

                            if ($date >= $datum['pc_start_time'] and $date <= $datum['pc_due_time']) {
                                $data['apply_beta_iut'] = '开始使用(BETA)';
                                $data['apply_beta_iut_en'] = 'English Version';
                            } else {
                                $data['apply_beta_iut'] = '申请试用';
                                $data['apply_beta_iut_en'] = 'Trial';
                            }

                            if ($date >= $datum['mobile_start_time'] and $date <= $datum['mobile_due_time']) {
                                $data['apply_beta_mut'] = '开始使用(BETA)';
                                $data['apply_beta_mut_en'] = 'English Version';
                            } else {
                                $data['apply_beta_mut'] = '申请试用';
                                $data['apply_beta_mut_en'] = 'Trial';
                            }
                        }

                    }
                } else {
                    if (DEBUG) {
                        echo 'ahahaahahaha';
                    }
                }


            } else {
                if (DEBUG) {
                    echo 'ahahaahahaha1';
                }
                $data['token'] = 1;
            }

        } else {
            if (DEBUG) {
                var_dump($this->userDetail);
                echo 'ahahaahahaha2';
            }
            $data['token'] = 1;
        }


        if (empty(trim($userInfo['productKey']))) {
            //没有绑定
            $data['irdStatus'] = 1;
        } else {
            //绑定
            $data['irdStatus'] = 2;
        }
//
        if (DEBUG) {
            pr($data);
            pr($this->userDetail);
            pr($userInfo);
            exit();
        }
        View::instance('xvt/ut.tpl')->show($data);
    }

    public function ad()
    {
        $data = [];
        $userInfo = Session::instance()->get('userInfo');

        if ($this->userDetail) {

            if (isset($userInfo['token'])) {
                $data['token'] = $userInfo['token'];
                $data['apply'] = 1;

                if ($this->__findPdt($this->userDetail['data']['productList'], 42)) {
                    $data['apply'] = 2;

                }


                if ($this->__findPdt($this->userDetail['data']['productList'], 54)) {
                    $data['innerTest'] = 1;

                }


            } else {
                $data['token'] = 1;
            }

        } else {
            $data['token'] = 1;
        }

        if (empty(trim($userInfo['productKey']))) {
            //没有绑定
            $data['irdStatus'] = 1;
            $data['adUrl'] = '?m=irdata&a=classicSys&ppname=old-ad';
        } else {
            //绑定
            $data['irdStatus'] = 2;
//            $data['adUrl'] = '?m=irdata&a=jumpadt';
            $data['adUrl'] = '?m=irdata&a=classicSys&ppname=old-ad';
        }


        View::instance('xvt/ad.tpl')->show($data);
    }


    /**
     * test function
     */
    public function test()
    {
//        var_dump($this->userDetail);
        if ($this->userDetail) {
            foreach ($this->userDetail['data']['productList'] as $datum) {

                if ($datum['pdt_id'] = 42) {

                }

            }
        } else {
            echo 'false';
        }
    }

    /**
     *
     */
    public function xvtSearchAPI()
    {
        $userInfo = Session::instance()->get('userInfo');
        $model = Model::instance('service');
        $data = file_get_contents('php://input');
//        $getData = json_decode($data,true);
        $ret = $model->xvtSearch($data);
        $ret = json_decode($ret, true);
        if (isset($userInfo['token'])) {
            $token = $userInfo['token'];
        }

        if (isset($ret['data'])) {

            foreach ($ret['data'] as $i => $v) {
                if (!empty($token)) {
                    $ret['data'][$i]['hasToken'] = true;
//                    $ret['data'][$i]['mvtURL'] = 'http://irv.iresearch.com.cn/iReport/?m=service&a=irv&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B905&&token=' . $token . '&pdt_id=18&userID=' . $userInfo['userID'] . '&video=' . $v['tv_name'] . '&channel=' . $v['channel'];
//                    $ret['data'][$i]['ovtURL'] = 'http://irv.iresearch.com.cn/iReport/?m=service&a=irv&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B909&token=' . $token . '&pdt_id=19&userID=' . $userInfo['userID'] . '&video=' . $v['tv_name'] . '&channel=' . $v['channel'];
//                    $ret['data'][$i]['ivtURL'] = 'http://irv.iresearch.com.cn/iReport/?m=service&a=irv&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B911&token=' . $token . '&pdt_id=17&userID=' . $userInfo['userID'] . '&video=' . $v['tv_name'] . '&channel=' . $v['channel'];
                    $ret['data'][$i]['mvtURL'] = $this->__getURL($v['tv_name'], $v['channel'], 'mvt');
                    $ret['data'][$i]['ovtURL'] = $this->__getURL($v['tv_name'], $v['channel'], 'ovt');
                    $ret['data'][$i]['ivtURL'] = $this->__getURL($v['tv_name'], $v['channel'], 'ivt');
                } else {
                    $ret['data'][$i]['hasToken'] = false;
                    $ret['data'][$i]['mvtURL'] = '';
                    $ret['data'][$i]['ovtURL'] = '';
                    $ret['data'][$i]['ivtURL'] = '';
                }
            }

        }

        echo json_encode($ret);
    }

    public function ircJump()
    {
        $getData = json_decode(urldecode(base64_decode($this->request()->get('v'))), true);

        return $this->model->ircJump($getData);

    }



    ######################################################################################
    ##################################                     ###############################
    #################################   PRIVATE METHODS   ################################
    ################################                     #################################
    ######################################################################################

    private function __getURL($tvName, $channel, $vtType)
    {
        $userInfo = Session::instance()->get('userInfo');
        $check = function ($pdtID) {
            $userModel = Model::instance('user');
            $getPermission = json_decode($userModel->getPermission([
                'token' => $this->userInfo['token'],
                'pdt_id' => $pdtID,
                'userID' => $this->userInfo['userID']
            ]), true);
            if ($getPermission['resCode'] == '20000') {
                return 'ok';
            } else {
                $m = Model::instance('user');
                $pro = $m->getProduct(['pdt_id' => $pdtID]);
                $pro = json_decode($pro, true);

                return '?m=user&a=trialApply&ppname=' . $pro['data'][0]['pdt_name'] . '&menuID=' . $pdtID;
            }
        };

        switch ($vtType) {
            case 'mvt':
                $mvt = $check(18);
                if ($mvt == 'ok') {
                    return 'http://irv.iresearch.com.cn/iReport/?m=service&a=irv&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B905&&token=' .
                        $userInfo['token'] . '&pdt_id=18&userID=' . $userInfo['userID'] . '&video=' . $tvName . '&channel=' . $channel;
                } else {
                    return $mvt;
                }
                break;
            case 'ovt':
                $ovt = $check(19);
                if ($ovt == 'ok') {
                    return 'http://irv.iresearch.com.cn/iReport/?m=service&a=irv&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B909&token=' .
                        $userInfo['token'] . '&pdt_id=19&userID=' . $userInfo['userID'] . '&video=' . $tvName . '&channel=' . $channel;
                } else {
                    return $ovt;
                }
                break;
            case 'ivt':
                $ivt = $check(17);
                if ($ivt == 'ok') {
//                    return 'http://irv.iresearch.com.cn/iReport/?m=service&a=irv&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B911&token=' . $userInfo['token'] . '&pdt_id=17&userID=' . $userInfo['userID'] . '&video=' . $tvName . '&channel=' . $channel;
                    return '';
                } else {
                    return $ivt;
                }
                break;
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
        try {
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
//        pr($menuData);
            return $menuData;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * @param $pdtID
     *
     * @return bool
     */
    private function __checkPermission($pdtID)
    {
        $userModel = Model::instance('user');
        $getPermission = json_decode($userModel->getPermission([
            'token' => $this->userInfo['token'],
            'pdt_id' => $pdtID,
            'userID' => $this->userInfo['userID']
        ]), true);
//        var_dump($getPermission);
        if ($getPermission['resCode'] == '20000') {
            return true;
        } else {
            if (empty($getPermission['data']['data'])) {
                http_response_code(404);
                echo '访问错误';
                return false;
            } else {
                header('Location: ?m=user&a=trialApply&ppname=' . $getPermission['data']['data']['pdt_name'] . '&menuID=' . $pdtID);
                return false;
            }
        }
    }

    private function __findPdt($product_list, $pdt_id)
    {
        if (is_array($product_list)) {
            foreach ($product_list as $datum) {

                if ($datum['pdt_id'] == $pdt_id) {
                    $ret = true;
                };
            }

            return $ret;
        } else {
            return false;
        }
    }


}