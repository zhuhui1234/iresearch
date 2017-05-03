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


        header('Location: http://data.iresearch.com.cn/Home.shtml');
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
            echo $jumpURL;
            exit();
            header("Location:" . $jumpURL);
        }
        View::instance('index/publicFrame.tpl')->show($data);
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
                'sub_id' => $pdtID,
                'recordLogs' => 'KOL访问',
                'status' => '20000',
                'resouce' => 'iData',
                'level' => '1',
                'type' => '用户日志'
            ]);

            View::instance('service/kol.tpl')->show($data);
        } else {
            View::instance('index/error.tpl')->show(['message' => '访问错误']);
            $logs = $this->serviceModel->recordLogs([
                'user' => $this->userInfo['userID'],
                'sub_id' => $pdtID,
                'recordLogs' => 'KOL访问',
                'status' => '40000',
                'resouce' => 'iData',
                'level' => '1',
                'type' => '用户日志'
            ]);
        }
        write_to_log(json_encode($logs,'_logs'));
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

        View::instance('index/publicFrame.tpl')->show($data);
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

        View::instance('index/publicFrame.tpl')->show($data);
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

        View::instance('index/publicFrame.tpl')->show($data);
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
        View::instance('index/publicFrame.tpl')->show($data);
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

    ######################################################################################
    ##################################                     ###############################
    #################################   PRIVATE METHODS   ################################
    ################################                     #################################
    ######################################################################################

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