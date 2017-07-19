<?php

/**
 * Copyright © 艾瑞咨询集团(http://www.iresearch.com.cn/)
 * Author DavidWei <davidwei@iresearch.com.cn>
 * Create 16-08-10 14:34
 */
class IndexController extends Controller
{

    private $loginStatus, $userInfo, $serviceModel;

    function __construct()
    {
        $this->userInfo = Session::instance()->get('userInfo');
        $this->serviceModel = Model::instance('service');
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
//        $userInfo = Session::instance()->get('userInfo');
//        $data['token'] = $userInfo['token'];
//        $userIndustry = Model::instance('Industry')->getUserIndustry($data);
//        $data = array(
////            "YH" => YH_LOGIN,
//            'loginStatus' => $this->loginStatus,
//            'userInfo' => $this->userInfo,
//            'token' => $this->userInfo['token'],
////            'u_account' => $this->userInfo['u_account'],
//            'title' => WEBSITE_TITLE,
//        );
//        if (empty(trim($userInfo['productKey']))) {
//            $data['irdStatus'] = 1;
//        } else {
//            $data['irdStatus'] = 0;
//        }
//        View::instance('index/index.tpl')->show($data);
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

//        header('Location: http://data.iresearch.com.cn/Home.shtml');
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
        $ret = json_decode($ret,true);

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
            'url' => 'http://ircdemo.iresearchdata.cn?token=' . $this->userInfo['token']
        );

        header("Location:" . $data['url']);
    }
    /**
     * ir cloud
     */
    public function iECTracker()
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
            'url' => 'http://ect.itracker.cn?token=' . $this->userInfo['token']
        );
        echo $data['url'];
        //header("Location:" . $data['url']);
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
            'url' => YH_REPORT . '&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B663&token=' . $this->userInfo['token'] . '&userID=' . $this->userInfo['userID'] . '&pdt_id=19'
        );
        header("Location:" . $data['url']);
//        View::instance('index/publicFrame.tpl')->show($data);
    }

    /**
     * iut
     */
    public function iut()
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
            'url' => YH_REPORT . '&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B900&token=' . $this->userInfo['token'] . '&userID=' . $this->userInfo['userID'] . '&pdt_id=12'
        );

        header("Location:" . $data['url']);
//        View::instance('index/publicFrame.tpl')->show($data);
    }

    /**
     * mvt
     */
    public function mvt()
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
            'url' => YH_REPORT . '&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B616&token=' . $this->userInfo['token'] . '&userID=' . $this->userInfo['userID'] . '&pdt_id=18'
        );
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
            'url' => YH_REPORT . '&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B901&token=' . $this->userInfo['token'] . '&userID=' . $this->userInfo['userID'] . '&pdt_id=37'
        );
        header("Location:" . $data['url']);
//        View::instance('index/publicFrame.tpl')->show($data);
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
        if (isset($userInfo['token'])) {
            $data['token'] = $userInfo['token'];
        } else {
            $data['token'] = 1;
        }


        if (empty(trim($userInfo['productKey']))) {
            //没有绑定
            $data['irdStatus'] = 1;
        } else {
            //绑定
            $data['irdStatus'] = 2;
        }

//        pr($data);
//        exit();
        View::instance('xvt/vt.tpl')->show($data);
    }

    public function xvtSearch()
    {
        $data = [];
        $userInfo = Session::instance()->get('userInfo');

        if (isset($userInfo['token'])) {
            $data['token'] = $userInfo['token'];
        } else {
            $data['token'] = 1;
        }

        if (empty(trim($userInfo['productKey']))) {
            //没有绑定
            $data['irdStatus'] = 1;
        } else {
            //绑定
            $data['irdStatus'] = 2;
        }
        View::instance('xvt/search.tpl')->show($data);
    }


    public function xut()
    {
        $data = [];
        $userInfo = Session::instance()->get('userInfo');

        if (isset($userInfo['token'])) {
            $data['token'] = $userInfo['token'];
        } else {
            $data['token'] = 1;
        }

        if (empty(trim($userInfo['productKey']))) {
            //没有绑定
            $data['irdStatus'] = 1;
        } else {
            //绑定
            $data['irdStatus'] = 2;
        }
        View::instance('xvt/ut.tpl')->show($data);
    }

    public function ad()
    {
        $data = [];
        $userInfo = Session::instance()->get('userInfo');
        if (isset($userInfo['token'])) {
            $data['token'] = $userInfo['token'];
        } else {
            $data['token'] = 1;
        }
        if (empty(trim($userInfo['productKey']))) {
            //没有绑定
            $data['irdStatus'] = 1;
        } else {
            //绑定
            $data['irdStatus'] = 2;
        }
        View::instance('xvt/ad.tpl')->show($data);
    }

    /**
     * test function
     */
    public function test()
    {
//        $Clear = json_encode(['mail' => 'wanghaiyan@iresearch.com.cn', 'pwd' => '123456']);
//        $userModel = Model::instance('user');
//        echo $userModel->getIResearchDataAccount($this->userInfo['productKey']);
//        pr(Session::instance()->get('userInfo'));
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
                    return 'http://irv.iresearch.com.cn/iReport/?m=service&a=irv&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B905&&token=' . $userInfo['token'] . '&pdt_id=18&userID=' . $userInfo['userID'] . '&video=' . $tvName . '&channel=' . $channel;
                } else {
                    return $mvt;
                }
                break;
            case 'ovt':
                $ovt = $check(19);
                if ($ovt == 'ok') {
                    return 'http://irv.iresearch.com.cn/iReport/?m=service&a=irv&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B909&token=' . $userInfo['token'] . '&pdt_id=19&userID=' . $userInfo['userID'] . '&video=' . $tvName . '&channel=' . $channel;
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

}