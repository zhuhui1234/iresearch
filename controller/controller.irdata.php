<?php

/**
 * Created by PhpStorm.
 * User: robinwong51
 * Date: 03/01/2017
 * Time: 5:34 PM
 */
class IRDataController extends Controller
{
    private $userModel, $irdUserInfo, $userInfo, $menu;

    function __construct($classname)
    {
        $this->userModel = Model::instance('User');
        $this->userInfo = Session::instance()->get('userInfo');
        $this->menu = json_decode($this->userModel->showMenu(),true);
        $this->menu = $this->menu['data']['dataList'];
//        if (!empty($this->userInfo['productKey'])) {
//            if (time() > Session::instance()->get('irdTimeOut') || empty(Session::instance()->get('irdTimeOut'))) {
//                $this->userModel->getIResearchDataAccount($this->userInfo['productKey']);
//            }
//
//            $this->irdUserInfo = json_decode(Session::instance()->get('iResearchDataUserInfo'), true);
//        }


    }

    public function classicSys()
    {
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


                //以下代码是解决被禁止第三方cooke下iframe无法登陆
//            if(strpos($_SERVER["HTTP_USER_AGENT"],"Safari")) {
                if ($this->request()->get('backType',0)=='0') {
                    $backURL = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                    $callBack = urlencode($backURL . '&backType=1');
                    $jumpURL = $data['ppurl'] . '&irv_callback=' . $callBack;
//                    var_dump($data['ppurl']);
//                    exit();
                    header("Location:".$jumpURL);
                }
//            }
//            if (DEBUG) {
//                pr($this->userInfo);
//                var_dump($this->irdUserInfo);
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
            alert(\"你并没有权限访问该模块功能\");
            top.location.href=\"?m=index\";
            </SCRIPT>");
                $this->errorPage('你并没有权限访问该模块功能');
                }
            } else {
                echo("<SCRIPT LANGUAGE=\"JavaScript\">
            alert(\"你并没有权限访问该模块功能\");
            top.location.href=\"?m=index\";
            </SCRIPT>");
                $this->errorPage('你并没有权限访问该模块功能');
            }
        }else{
            View::instance('user/login.tpl')->show([]);
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

                    if ($keyName == $lowerCon['menuName'] AND !empty($lowerCon['curl'] )) {
                        $url = $lowerCon['curl'];
                    }
                }

            }
        }
        return $url;
    }

}