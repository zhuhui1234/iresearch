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
        $url = API_URL_REPORT . '?m=User&a=setReportToken';
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
            $url = API_URL . '?m=User&a=login';
            write_to_log('login url :' . $url, '_login');
            write_to_log('post data: ' . json_encode($data), '_login');
            $ret = $this->_curlPost($url, $data, 'cs_login');
            $rs = json_decode($ret, true);
            if ($rs['resCode'] == '000000') {
                write_to_log('mobile login: ' . $ret, '_login');
                Session::instance()->set('userInfo', $rs['data']);
                if (!empty($rs['data']['productKey'])) {
                    $this->getIResearchDataAccount($rs['data']['productKey']);
                }
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
        $url = API_URL . '?m=User&a=login';
        $data['LoginType'] = 'weixin';
        $ret = $this->_curlPost($url, $data, 'wxlogin');
        $rs = json_decode($ret, true);
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
            $url = API_URL . '?m=User&a=addUser';
            $ret = $this->_curlPost($url, $data, 'addUser');
            $rs = json_decode($ret, true);
            if ($rs['resCode'] == '000000') {
                write_to_log('binding wx: ' . $ret, '_wx');
                Session::instance()->set('userInfo', $rs['data']);
                if (!empty($rs['data']['productKey'])) {

                }
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
     * 绑定已注册用户
     * @param $data
     */
    public function bindingWeChartUser($data)
    {
        $url = API_URL . '?m=Service&a=setWxService';
        $ret = $this->_curlPost($url, $data, 'setWxService');
        return $ret;
    }

    /**
     * get user info list
     *
     * @param $data
     */
    public function getUserInfoList($data)
    {
        $url = API_URL . '?m=User&a=getUserInfoList';
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
        $url = API_URL . '?m=User&a=setState';
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
        $url = API_URL . '?m=User&a=editUserInfo';
        $ret = $this->_curlPost($url, $data, 'editUserInfo');
        return $ret;
    }

    /**
     * get user info
     * @return mixed
     */
    public function getMyInfo()
    {
        $userInfo = Session::instance()->get('userInfo');
        return $this->getUserInfo([
            'userID' => $userInfo['userID'],
            'TOKEN' => $userInfo['token']
        ]);
    }

    /**
     * 用户详情
     *
     * @param $data
     * @return mixed
     */
    public function getUserInfo($data)
    {
        $url = API_URL . '?m=User&a=getUserInfo';
        $ret = $this->_curlPost($url, $data, 'getUserInfo');
        return $ret;
    }

    /**
     * show home menu
     * @return mixed
     */
    public function showMenu()
    {
        $userInfo = Session::instance()->get('userInfo');
        return $this->__showHomeMenu([
            'TOKEN' => $userInfo['token'],
            'companyID' => $userInfo['companyID'],
            'userID' => $userInfo['userID']
        ]);
    }

    /**
     * user logs
     * @param array $data
     * @return mixed
     */
    public function userLogs(array $data)
    {
        $url = API_URL . '?m=Logs&a=logList';
        $ret = $this->_curlPost($url, $data, 'logList');
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
        $url = API_URL . '?m=User&a=setCancellation';
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
        $url = API_URL . '?m=User&a=resetPassword';
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
        $data['token'] = $userInfo['token'];
        $data['userID'] = $userInfo['userID'];
        if (empty($data['token']) && empty($data['userID'])) {
            $rs = false;
        } else {
            $userInfoArr = json_decode($this->getUserInfo($data), TRUE);
            $rs = true;
            if ($userInfoArr['resCode'] != '000000' || $userInfo == null) {
//            Session::instance()->destroy();
                $rs = false;
//            $rs = true;
            }
        }


        return $rs;
    }


    /**
     * binding IRDA
     * @param $data
     */
    public function bindingIRDAToUser($data)
    {
        $userInfo = Session::instance()->get('userInfo');
        $data = json_decode($data, true);
        $data['userID'] = $userInfo['userID'];
        $data['token'] = $userInfo['token'];
        $ret = $this->__bindingProduct($data);
        $tempRet = json_decode($ret, true);
        if ($tempRet['resCode'] == '000000') {
            $userInfo['productKey'] = '1';
            Session::instance()->set('userInfo', $userInfo);
            unset($tempRet);
        }
        return $ret;
    }

    /**
     * get IRDA
     * @param $data
     * @return mixed|string
     */
    public function getIResearchDataAccount($productKey)
    {
        $saveOldIResearchDataInfo = $this->__getIResearchDataAccount(json_encode(['iUserID' => $productKey]));
        Session::instance()->set('iResearchDataUserInfo', $saveOldIResearchDataInfo);
        Session::instance()->set('irdTimeOut', time() * 60);
        return $saveOldIResearchDataInfo;
    }

    public function logOut()
    {
        $userInfo = Session::instance()->get('userInfo');
        $url = API_URL . '?m=Login&a=cancel';
        $ret = $this->_curlPost($url, ['TOKEN' => $userInfo['token'], 'userID' => $userInfo['userID']], 'cancel');
    }

    /**
     * block user
     * @param array $data
     * @return mixed
     */
    public function freezeUser(array $data)
    {
        $url = API_URL . '?m=User&a=iceUser';
        $ret = $this->_curlPost($url, $data, 'iceUser');
        return $ret;
    }

    /**
     * unblock user
     * @param array $data
     * @return mixed
     */
    public function unblockUser(array $data)
    {
        $url = API_URL . '?m=User&a=thawUser';
        $ret = $this->_curlPost($url, $data, 'thawUser');
        return $ret;
    }

    /**
     * get binding user info
     * @param $userInfo
     * @return mixed
     */
    public function bindUserInfo($userInfo)
    {
        if (empty($userInfo)) {
            $ui = Session::instance()->get('userInfo');
            $userInfo = [
                'TOKEN' => $ui['token'],
                'userID' => $ui['userID']
            ];
        }
        $url = API_URL . '?m=Service&a=getService';
        $ret = $this->_curlPost($url, $userInfo, 'getService');
        return $ret;
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

    /**
     * binding product key
     * @param $data
     * @return mixed
     */
    private function __bindingProduct($data)
    {
        $url = API_URL . '?m=User&a=setProductKey';
        $ret = $this->_curlPost($url, $data, 'setProduct');
        return $ret;
    }

    /**
     * 更新Session
     * 但更新UserInfo
     */
    private function __updateUserInfoSession()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data = [
            'userID' => $userInfo['userID'],
            'token' => $userInfo['token']
        ];
        $userInfo = $this->getUserInfo($data);
        Session::instance()->set('userInfo', json_decode($userInfo, true));
    }

    /**
     * show menu
     * @param $data
     * @return mixed
     */
    private function __showHomeMenu($data)
    {
        $url = API_URL . '?m=Permissions&a=getHomeMenu';
        $ret = $this->_curlPost($url, $data, 'getHomeMenu');
        return $ret;
    }
}
