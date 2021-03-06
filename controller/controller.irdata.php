<?php

/**
 * Created by PhpStorm.
 * User: robinwong51
 * Date: 03/01/2017
 * Time: 5:34 PM
 */
class IRDataController extends Controller
{
    private $userModel, $irdUserInfo, $userInfo, $menu, $guid, $userDetail, $cache;

    function __construct($classname)
    {
        $this->cache = new CacheClass();
        $this->cache = $this->cache->redis;
        $this->userModel = Model::instance('User');
        $this->userInfo = Session::instance()->get('userInfo');
        $this->menu = json_decode($this->userModel->showMenu(), true);
        $this->guid = $this->menu['data']['ird_guid'];
        $this->menu = $this->menu['data']['dataList'];
        if (!empty($this->userInfo['ird_user_id'])) {
//            if (time() > Session::instance()->get('irdTimeOut') || empty(Session::instance()->get('irdTimeOut'))) {
            $this->userModel->getIResearchDataAccount($this->userInfo['ird_user_id']);
//            }

            $this->irdUserInfo = json_decode(Session::instance()->get('iResearchDataUserInfo'), true);
        }


        $this->userDetail = json_decode($this->userModel->getUserInfo([
            'token' => $this->userInfo['token'],
            'userID' => $this->userInfo['userID']
        ]), true);

        if ($this->userDetail['resCode'] !== '000000') {
            $this->userDetail = false;
        }

    }

    public function mediaPlaner()
    {
        if (!empty($this->userInfo['token'])) {
            if (!empty($this->guid)) {
                header('Location: ' . 'http://iutmain.itracker.cn/NLogin.aspx?guid=' . $this->guid . '&mpl=1');
            } else {
                echo("<SCRIPT LANGUAGE=\"JavaScript\">
                        alert(\"你并没有权限访问该模块功能,或没有绑定老产品账号，请与客服联系！\");
            //            top.location.href=\"?m=index\";
                        </SCRIPT>");
            }


        } else {
            View::instance('user/bj_login.tpl')->show(['mobile' => 1]);
        }
    }

    public function PlannerPlus()
    {
        if (!empty($this->userInfo['token'])) {
            if (!empty($this->guid)) {
                header('Location: ' . 'http://iutmain.itracker.cn/NLogin.aspx?ppl=1&guid=' . $this->guid);
            } else {
                echo("<SCRIPT LANGUAGE=\"JavaScript\">
                        alert(\"你并没有权限访问该模块功能,或没有绑定老产品账号，请与客服联系！\");
            //            top.location.href=\"?m=index\";
                        </SCRIPT>");
            }


        } else {
            View::instance('user/bj_login.tpl')->show(['mobile' => 1]);
        }
    }

    public function jumpAdt()
    {
        if (!empty($this->userInfo['token'])) {
            if (!empty($this->guid)) {
                header('Location: ' . 'http://madt.irs01.net/ProductSelection.aspx?guid=' . $this->guid);
            } else {
                echo("<SCRIPT LANGUAGE=\"JavaScript\">
                        alert(\"你并没有权限访问该模块功能,或没有绑定老产品账号，请与客服联系！\");
            //            top.location.href=\"?m=index\";
                        </SCRIPT>");
            }


        } else {
            View::instance('user/bj_login.tpl')->show(['mobile' => 1]);
        }

    }

    public function test()
    {


        if (!empty($this->userInfo['ird_user_id'])) {
//            if (time() > Session::instance()->get('irdTimeOut') || empty(Session::instance()->get('irdTimeOut'))) {
            $this->userModel->getIResearchDataAccount($this->userInfo['ird_user_id']);
//            }

            $this->irdUserInfo = json_decode(Session::instance()->get('iResearchDataUserInfo'), true);
        }

        if (!empty($this->userInfo['token'])) {
            if (!empty($this->userInfo['productKey'])) {
                $ppname = $this->request()->get('ppname');
                $stat = false;
                $data = [
                    'loginStatus' => $this->loginStatus,
                    'userInfo' => $this->userInfo,
                    'token' => $this->userInfo['token'],
//                'userID' => $this->userInfo['userID'],
//                'role' => $this->userInfo['permissions'],
                    'title' => WEBSITE_TITLE,
                    'kolLink' => $this->kolLink(),
                    'menu' => fillMenu($this->menu),
                    'ppurl' => $this->__getCURL($ppname)
                ];

                switch ($ppname) {
                    case 'PC端用户行为监测_经典版':
                        $e_pname = 'iut';
                        break;
                }


                //以下代码是解决被禁止第三方cooke下iframe无法登陆
//            if(strpos($_SERVER["HTTP_USER_AGENT"],"Safari")) {

                if ($this->request()->get('backType', 0) == '0') {
                    $backURL = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                    $callBack = urlencode($backURL . '&backType=1');
                    $jumpURL = $data['ppurl'] . '&irv_callback=' . $callBack;

                    header("Location:" . $jumpURL);
                }
//            }

//            if (DEBUG) {
//                pr($this->userInfo);

//                exit();
//            }
                $u = json_decode(Model::instance('user')->getMyInfo(), true);

                if (empty($this->irdUserInfo)) {

                    $this->userModel->getIResearchDataAccount($u['data']['ird_user_Id']);
                    $this->irdUserInfo = json_decode(Session::instance()->get('iResearchDataUserInfo'), true);
                }
//                var_dump($this->userModel->getUserInfo());
//                var_dump($this->userInfo);


//                var_dump($this->irdUserInfo);

                foreach ($this->irdUserInfo['pplist'] as $p) {
                    if ($p['ppname'] == $e_pname) {
                        $data['ppurl'] = $p['ppurl'] . '?guid=' . $this->irdUserInfo['iRGuid'];
                        $stat = true;
                    }
                }
//                exit();
                if ($stat) {
                    View::instance('service/ird.tpl')->show($data);
                } else {
                    echo("<SCRIPT LANGUAGE=\"JavaScript\">
                            alert(\"你并没有权限访问该模块功能1\");
                //            top.location.href=\"?m=index\";
                            </SCRIPT>");
//                    $this->errorPage('你并没有权限访问该模块功能');
                }
            } else {
                echo("<SCRIPT LANGUAGE=\"JavaScript\">
                        alert(\"你并没有权限访问该模块功能\");
            //            top.location.href=\"?m=index\";
                        </SCRIPT>");
//                $this->errorPage('你并没有权限访问该模块功能');
            }
        } else {
            View::instance('user/bj_login.tpl')->show([]);
        }
    }

    public function classicSys()
    {
        $ppname = $this->request()->get('ppname');
        $pdtID = (int)$this->request()->get('pro');
        $expired = $this->request()->get('expired');

        if ($expired == 1) {
            $cache_key = $this->userInfo['token'] . '_cache';
            $this->cache->hDel($cache_key);
            $this->cache->del($cache_key);
            Model::instance('user')->logOut();

            Session::instance()->destroy();
            setcookie('yh_irv_url', 'http://irv.iresearch.com.cn/iResearchDataWeb/?m=user&a=login&expired=1', time() + 2400, '/');
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
        }

        $mobile = "1";
        if ($this->userDetail) {

            if (!empty($this->userInfo['ird_user_id'])) {
//            if (time() > Session::instance()->get('irdTimeOut') || empty(Session::instance()->get('irdTimeOut'))) {
                $this->userModel->getIResearchDataAccount($this->userInfo['ird_user_id']);
//            }

                $this->irdUserInfo = json_decode(Session::instance()->get('iResearchDataUserInfo'), true);
            }

            if (!empty($this->userInfo['productKey'])) {


                $stat = false;
                $data = [
                    'loginStatus' => $this->loginStatus,
                    'userInfo' => $this->userInfo,
                    'token' => $this->userInfo['token'],
//                'userID' => $this->userInfo['userID'],
//                'role' => $this->userInfo['permissions'],
                    'title' => WEBSITE_TITLE,
                    'kolLink' => $this->kolLink(),
                    'menu' => fillMenu($this->menu),
                    'ppurl' => $this->__getCURL($ppname)
                ];

                if (DEBUG) {
                    pr($data);
//                    var_dump($this->irdUserInfo);
                    exit();
                }

                if ($ppname == 'iut-en') {
                    if ($this->request()->get('backType', 0) == '0') {
                        $backURL = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                        $callBack = urlencode($backURL . '&backType=1');
                        $jumpURL = 'http://iutmain.itracker.cn/NLogin_EN.aspx?guid=' . $this->irdUserInfo['iRGuid'];
                        header("Location:" . $jumpURL);
                        exit();
                    }
                }

                if ($ppname == 'mut-en') {
                    if ($this->request()->get('backType', 0) == '0') {
                        $backURL = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                        $callBack = urlencode($backURL . '&backType=1');
                        $jumpURL = 'http://mut-en.itracker.cn/mut.html?guid=' . $this->irdUserInfo['iRGuid'];
                        header("Location:" . $jumpURL);
                        exit();
                    }
                }

                if ($ppname == 'old-ad') {
                    if ($this->request()->get('backType', 0) == '0') {
                        header('Location: ' . 'http://madt.irs01.net/ProductSelection.aspx?guid=' . $this->guid);
                        exit();
                    }
                }


                //以下代码是解决被禁止第三方cooke下iframe无法登陆
//            if(strpos($_SERVER["HTTP_USER_AGENT"],"Safari")) {
                if (DEBUG) {
                    var_dump($data);
                }
                if (!empty($data['ppurl'])) {
                    $userModel = Model::instance('user');

                    $userModel->pushLog([
                        'user' => $this->userInfo['userID'],
                        'companyID' => $this->userInfo['companyID'],
                        'status' => '20000',
                        'type' => 'irv用户日志',
                        'sub_id' => $pdtID,
                        'resource' => 'iData',
                        'action' => '跳转产品_' . $ppname,
                        'level' => '0',
                        'log_ip' => getIp()
                    ]);
                    if ($this->request()->get('backType', 0) == '0') {
                        $backURL = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                        $callBack = urlencode($backURL . '&backType=1');
                        $jumpURL = $data['ppurl'] . '&irv_callback=';
                        header("Location:" . $jumpURL);
                    }
                } else {
                    echo("<SCRIPT LANGUAGE=\"JavaScript\">
                    alert(\"你并没有权限访问该模块功能 ~\");
                    top.location.href=\"?m=index\";
                    </SCRIPT>");
                }
//            }

                foreach ($this->irdUserInfo['pplist'] as $p) {
                    if ($p['ppname'] == $ppname) {
                        $data['ppurl'] = $p['ppurl'] . '?guid=' . $this->irdUserInfo['iRGuid'];
                        $stat = true;
                    }
                }

                if ($stat) {
                    View::instance('service/ird.tpl')->show($data);
                } else {
                    echo("<SCRIPT LANGUAGE=\"JavaScript\">
                    alert(\"你并没有权限访问该模块功能~\");
                    top.location.href=\"?m=index\";
                    </SCRIPT>");
                }
            } else {
                echo("
                 <SCRIPT LANGUAGE=\"JavaScript\">
                alert(\"你并没有权限访问该模块功能!\");
                top.location.href=\"?m=user&a=trialApply&ppname={$ppname}&menuID={$pdtID}\"
                </SCRIPT>");
            }
        } else {
            View::instance('user/bj_login.tpl')->show(['msg' => '', 'mobile' => $mobile]);
        }


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

    public function errorPage($msg)
    {
        $data = ['message' => $msg];

        View::instance('index/error.tpl')->show($data);
    }

    ######################################################################################
    ##################################                     ###############################
    #################################   PRIVATE METHODS   ################################
    ################################                     #################################
    ######################################################################################

    private function __getCURL($keyName)
    {
        $metaData = $this->menu[1]['lowerTree'];
        foreach ($metaData as $key => $value) {
//            pr(len($value['lowerTree']));

            if (count($value['lowerTree']) > 0) {
                foreach ($value['lowerTree'] as $lowerKey => $lowerCon) {
//                    var_dump($lowerCon);

                    if ($keyName == $lowerCon['menuName'] AND !empty($lowerCon['curl'])) {
                        $url = $lowerCon['curl'];
                    }
                }

            }
        }

        return $url;
    }

}