<?php

/**
 * Created by 艾瑞咨询集团.
 * User: DavidWei
 * Date: 16-8-10
 * Time: 下午4:03
 * Email:davidwei@iresearch.com.cn
 * FileName:model.user.php
 * 描述:
 */
class UserModel extends API
{
    /**
     * @param $guid
     * 用户访问报告写入记录,用户只能访问一次,访问一次后回删除该条记录
     */
    public function upUserSessionKey($guid)
    {
        $data = array("guid" => $guid);
        $url = API_URL_REPORT . '?m=user&a=setReportToken';
        $ret = $this->_curlPost($url, $data, 'cs_login');
    }

    /**
     * login
     *
     * @param $data
     * @return mixed
     */
    public function login($data)
    {
        $getVcode = Session::instance()->get('vcodes');
        write_to_log($getVcode, '_session');
        if ($getVcode == $data['vCode']) {
            $url = API_URL . '?m=user&a=login';
            write_to_log('login url :' . $url, '_login');
            write_to_log('post data: ' . json_encode($data), '_login');
            $ret = $this->_curlPost($url, $data, 'cs_login');
            $rs = json_decode($ret, true);
            if ($rs['resCode'] == '000000') {
                write_to_log('mobile login: ' . $ret, '_login');
                Session::instance()->set('userInfo', $rs['data']);
            } else {
                write_to_log('mobile error login: ' . $ret, '_login');
            }
            return $ret;
        } else {
            return json_encode(['resCode' => -1, 'resMsg' => '输入的图形验证码错误']);
        }

    }


    /**
     * check wechat openid
     * @param $data
     * @return mixed
     */
    public function WeChatAutoLogin($data, $weChatData)
    {
        $url = API_URL . '?m=user&a=login';
        $data['LoginType'] = 'weixin';
        $ret = $this->_curlPost($url, $data, 'wxlogin');
        $rs = json_decode($ret, true);
//        pr($data);
//        pr($rs);
//        exit();
        if ($rs['resCode'] == '000000') {
            write_to_log('wechat login: ' . $ret, '_login');
            Session::instance()->set('userInfo', $rs['data']);
            return TRUE;
        } else {
            write_to_log('wechat error login: ' . $ret, '_login');
            Session::instance()->set('wechatBinding', $weChatData);
            return FALSE;
        }

    }

    /**
     * bind WeChat
     * @param $data
     * @return mixed
     */
    public function bindWeChat($data)
    {
        $getVCode = Session::instance()->get('vcodes');
        if ($getVCode == $data['vCode']) {
            $url = API_URL . '?m=user&a=addUser';
            $ret = $this->_curlPost($url, $data, 'bindingWeixin');
            $rs = json_decode($ret, true);
            if ($rs['resCode'] == '000000') {
                write_to_log('binding wx: ' . $ret, '_wx');
                Session::instance()->set('userInfo', $rs['data']);
            } else {
                write_to_log('post binding: ' . json_encode($data), '_wx');
                write_to_log('binding error: ' . $ret, '_wx');
            }
            return $ret;
        } else {
            return json_encode(['resCode' => 1, 'getvcode' => $getVCode, 'vcode' => $data['vCode']]);
        }
    }

    /**
     * get user info list
     *
     * @param $data
     */
    public function getUserInfoList($data)
    {
        $url = API_URL . '?m=user&a=getUserInfoList';
        $ret = $this->_curlPost($url, $data, 'getUserInfoList');
        $ret = json_decode($ret, TRUE);
        $ret['recordsFiltered'] = $ret['recordsTotal'] = $ret['data']['totalSize'];
        $ret['data'] = $ret['data']['UserInfoList'];
        return json_encode($ret);
    }

    /**
     * 冰结接口
     *
     * @param $data
     * @return mixed
     */
    public function setState($data)
    {
        $url = API_URL . '?m=user&a=setState';
        $ret = $this->_curlPost($url, $data, 'setState');
        return $ret;
    }

    /**
     * 用户编辑
     *
     * @param $data
     * @return mixed
     */
    public function setUserInfo($data)
    {
        $url = API_URL . '?m=user&a=setUserInfo';
        $ret = $this->_curlPost($url, $data, 'setUserInfo');
        return $ret;
    }

    /**
     * 用户详情
     *
     * @param $data
     * @return mixed
     */
    public function getUserInfo($data)
    {
        $url = API_URL . '?m=user&a=getUserInfo';
        $ret = $this->_curlPost($url, $data, 'getUserInfo');
        return $ret;
    }

    /**
     * 退出登录
     *
     * @param $data
     * @return mixed
     */
    public function setCancellation($data)
    {
        $url = API_URL . '?m=user&a=setCancellation';
        $ret = $this->_curlPost($url, $data, 'setCancellation');
        return $ret;
    }

    /**
     * 重置密码
     *
     * @param $data
     * @return mixed
     */
    public function resetPassword($data)
    {
        $url = API_URL . '?m=user&a=resetPassword';
        $ret = $this->_curlPost($url, $data, 'resetPassword');
        return $ret;
    }

    /**
     * check token
     * 判断当前token是否有效
     */
    public function checkToken()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
//        $userInfoArr = json_decode($this->getUserInfo($data), TRUE);
        $userInfoArr = json_decode($this->getUserInfo($data), TRUE);
        $rs = True;
        if ($userInfoArr['resCode'] != '000000' || $userInfo == null) {
//            Session::instance()->destroy();
            $rs = False;
//            $rs = true;
        }
        return $rs;
    }


    /**
     * binding IRDA
     * @param $data
     */
    public function bindingIRDAToUser($data)
    {
        $irda = $this->__getIResearchDataAccount($data);
        if ($irda != '登录失败ws,returntxt:-2') {
            //binding
            return $irda;
        } else {
            return $irda;
        }
    }

    /**
     * get IRDA
     * @param $data
     * @return mixed|string
     */
    public function getIResearchDataAccount($data)
    {
        return $this->__getIResearchDataAccount($data);
    }


    ######################################################################################
    ##################################                     ###############################
    #################################   PRIVATE METHODS   ################################
    ################################                     #################################
    ######################################################################################


    /**
     * iReSearch Data Account
     * @param $data
     * @return mixed|string
     */
    private function __getIResearchDataAccount($data)
    {
        $url = 'http://sys.itracker.cn/api/WebForm1.aspx';
        $encryptData = fnEncrypt($data, KEY);
        if (DEBUG) {
            echo 'Resource:';
            var_dump($data);
            echo 'Encrypt: ';
            var_dump($encryptData);
        }
        $ret = $this->_curlAPost($url, ['v' => $encryptData]);
        return $ret;
    }

}
