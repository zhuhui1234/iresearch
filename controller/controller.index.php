<?php

/**
 * Copyright © 艾瑞咨询集团(http://www.iresearch.com.cn/)
 * Author DavidWei <davidwei@iresearch.com.cn>
 * Create 16-08-10 14:34
 */
class IndexController extends Controller
{

    private $loginStatus, $userInfo;

    function __construct()
    {
        $this->userInfo = Session::instance()->get('userInfo');
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
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $userIndustry = Model::instance('Industry')->getUserIndustry($data);
        $data = array(
//            "YH" => YH_LOGIN,
            'loginStatus' => $this->loginStatus,
            'userInfo' => $this->userInfo,
            'token' => $this->userInfo['u_token'],
            'u_account' => $this->userInfo['u_account'],
            'title' => WEBSITE_TITLE
        );

        View::instance('index/index.tpl')->show($data);
    }

    /**
     * home page
     */
    public function index()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
//        var_dump($userInfo);
//        exit();
//        $userIndustry = Model::instance('Industry')->getUserIndustry($data);
        $data = array(
//            "YH" => YH_LOGIN,
//            "userIndustry" => $userIndustry,
            'loginStatus' => $this->loginStatus,
            'userInfo' => $this->userInfo,
            'token' => $this->userInfo['token'],
            'guid' => $this->userInfo['guid'],
            'role' => $this->userInfo['permissions'],
            'title' => WEBSITE_TITLE,
            'kolLink' => $this->kolLink()
        );

        View::instance('index/home.tpl')->show($data);
    }

    public function kolPage()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
//        $userIndustry = Model::instance('Industry')->getUserIndustry($data);
        $data = array(
//            "YH" => YH_LOGIN,
//            "userIndustry" => $userIndustry,
            'loginStatus' => $this->loginStatus,
            'userInfo' => $this->userInfo,
            'token' => $this->userInfo['token'],
            'guid' => $this->userInfo['guid'],
            'role' => $this->userInfo['permissions'],
            'title' => WEBSITE_TITLE,
            'kolLink' => $this->kolLink()
        );

        View::instance('service/kol.tpl')->show($data);
    }

    /**
     * 媒介计划
     */
    public function mutMedia()
    {
        $data = array(
            'token' => $this->userInfo['token'],
            'guid' => $this->userInfo['guid'],
            'role' => $this->userInfo['permissions'],
            'title' => WEBSITE_TITLE
        );


        if ((int)$this->userInfo['permissions'] > 0) {
            View::instance('index/mutmedia.tpl')->show($data);
        } else {
            echo("<SCRIPT LANGUAGE=\"JavaScript\">
            alert(\"您并未开通此功能\");
            window.location.href=\"?m=index\";
            </SCRIPT>");
        }

    }

    public function demo()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $data['cfg_model'] = 7;
        $ret = Model::instance('industry')->configList($data);
        $data = array(
            "listInfo" => $ret['data']['ConfigMaxList'][0]['ConfigMinList']
        );
        View::instance('index/demo.tpl')->show($data);
    }

    public function kolLink()
    {
        $rMail = $this->userInfo['mobile'];
        $mail = urlencode($rMail);
        $rkey = $rMail . $rMail . date('YmdH');
        $key = strtoupper(md5($rkey,false));
        $ret = KOL_API . "?u={$mail}&e={$mail}&ukey={$key}";
        return $ret;
    }

    public function test()
    {
        $Clear = json_encode(['mail'=>'wanghaiyan@iresearch.com.cn','pwd'=>'123456']);
        $userModel = Model::instance('user');
        echo $userModel->getIResearchDataAccount($Clear);
    }
}