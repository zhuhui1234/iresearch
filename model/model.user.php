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
        $url = API_URL . '?m=user&a=login';
        $ret = $this->_curlPost($url, $data, 'cs_login');
        $rs = json_decode($ret, true);

        if ($rs['resCode'] == '000000') {
            Session::instance()->set('userInfo', $rs['data']);
        }
        return $ret;
    }

    /**
     * register user info
     * @param $data
     * @return mixed
     */
    public function registerUserInfo($data)
    {
        $url = API_URL . '?m=user&a=createUserinfo';
        $ret = $this->_curlPost($url, $data, 'createUserinfo');
        return $ret;
    }

    /**
     * check wechat openid
     * @param $data
     * @return mixed
     */
    public function WeChatAutoLogin($data)
    {
        $url = API_URL . '?m=user&a=wxlogin';
        $ret = $this->_curlPost($url, $data, 'wxlogin');
        $rs = json_decode($ret, true);
        if ($rs['resCode'] == '000000') {
            Session::instance()->set('userInfo', $rs['data']);
            return TRUE;
        }else{
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
        $url = API_URL . '?m=user&a=bindingWeixin';
        $ret = $this->_curlPost($url, $data, 'bindingWeixin');
        return $ret;
    }

    /**
     * get userinfo list
     *
     * @param $data
     */
    public function getUserInfoList($data)
    {
        $url = API_URL . '?m=user&a=getUserInfoList';
        $ret = $this->_curlPost($url, $data, 'getUserInfoList');
        return $ret;
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

}
