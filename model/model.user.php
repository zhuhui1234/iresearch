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
     * 用户访问报告写入记录,用户只能访问一次,访问一次后回删除该条记录
     *
     * @param $guid
     *
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
     *
     * @return mixed
     */
    public function login($data)
    {
        $getVcode = Session::instance()->get('vcodes');
        $ird_guid = Session::instance()->get('irdGuid');
        $ird_account = Session::instance()->get('irdAccount');
        if (empty($data['log_ip'])) {
            $data['log_ip'] = getIp();
        }
        // 判断是否来自IRD的用户
        if (!empty($ird_guid) and !empty($ird_account)) {
            $data['ird_guid'] = $ird_guid;
            $data['ird_user'] = $ird_account;
        }
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
                setcookie('kittyID', $rs['data']['token']);
                if (!empty($rs['data']['productKey'])) {
                    $this->getIResearchDataAccount($rs['data']['ird_user_id']);
                }
                $this->pushLog([
                    'user' => $rs['data']['userID'],
                    'companyID' => $rs['data']['companyID'],
                    'status' => '20000',
                    'type' => 'irv用户日志',
                    'resource' => 'iData',
                    'action' => '睿见登入',
                    'content' => '手机',
                    'level' => '0',
                ]);
            } else {
                write_to_log('mobile error login: ' . $ret, '_login');
            }
            return $ret;
        } else {
            return json_encode(['resCode' => -1, 'resMsg' => '输入的图形验证码错误']);
        }
    }

    public function b_login($data)
    {
//        $getVcode = Session::instance()->get('vcodes');
        $ird_guid = Session::instance()->get('irdGuid');
        $ird_account = Session::instance()->get('irdAccount');
        if (empty($data['log_ip'])) {
            $data['log_ip'] = getIp();
        }
        // 判断是否来自IRD的用户
        if (!empty($ird_guid) and !empty($ird_account)) {
            $data['ird_guid'] = $ird_guid;
            $data['ird_user'] = $ird_account;
        }
//        write_to_log($getVcode, '_session');
//        if ($getVcode == $data['vCode']) {
        $url = API_URL . '?m=User&a=b_login';
        write_to_log('login url :' . $url, '_login');
        write_to_log('post data: ' . json_encode($data), '_login');
        $ret = $this->_curlPost($url, $data, 'cs_login');
        $rs = json_decode($ret, true);
        if ($rs['resCode'] == '000000') {
            write_to_log('mobile login: ' . $ret, '_login');
            Session::instance()->set('userInfo', $rs['data']);
            setcookie('kittyID', $rs['data']['token']);
            if (!empty($rs['data']['productKey'])) {
                $this->getIResearchDataAccount($rs['data']['ird_user_id']);
            }

            $this->pushLog([
                'user' => $rs['data']['userID'],
                'companyID' => $rs['data']['companyID'],
                'status' => '20000',
                'type' => 'irv用户日志',
                'resource' => 'iData',
                'action' => '睿见登入',
                'content' => '手机',
                'level' => '0',
            ]);
        } else {
            write_to_log('mobile error login: ' . $ret, '_login');
        }
        return $ret;
//        } else {
//            return json_encode(['resCode' => -1, 'resMsg' => '输入的图形验证码错误']);
//        }
    }

    /**
     * mobile login
     *
     * @param $data
     * @return mixed
     */
    public function mobileLogin($data)
    {
        $ird_guid = Session::instance()->get('irdGuid');
        $ird_account = Session::instance()->get('irdAccount');
        write_to_log('ird: ' . $ird_guid, '_session');
        // 判断是否来自IRD的用户
        if (!empty($ird_guid) and !empty($ird_account)) {
            $data['ird_guid'] = $ird_guid;
            $data['ird_user'] = $ird_account;
        }

        $url = API_URL . '?m=User&a=login';
        return $this->_curlPost($url, $data, 'cs_login');
    }

    /**
     * check WeChat openid
     *
     * @return mixed
     */
    public function WeChatAutoLogin($data, $weChatData)
    {
        $ird_guid = Session::instance()->get('irdGuid');
        $ird_account = Session::instance()->get('irdAccount');
        // 判断是否来自IRD的用户
        if (!empty($guid) and !empty($ird_account)) {
            $data['ird_guid'] = $ird_guid;
            $data['ird_user'] = $ird_account;
        }

        $url = API_URL . '?m=User&a=login';
        $data['LoginType'] = 'weixin';

        $ret = $this->_curlPost($url, $data, 'wxlogin');
        $rs = json_decode($ret, true);
        if ($rs['resCode'] == '000000') {
            write_to_log('wechat login: ' . $ret, '_login');
            Session::instance()->set('userInfo', $rs['data']);
            setcookie('kittyID', $rs['data']['token']);

            $this->pushLog([
                'user' => $rs['data']['userID'],
                'companyID' => $rs['data']['companyID'],
                'status' => '20000',
                'type' => 'irv用户日志',
                'resource' => 'iData',
                'action' => '睿见登入',
                'content' => '微信',
                'level' => '0',
            ]);


            return TRUE;
        } else {
            write_to_log('wechat error login: ' . $ret, '_login');
            if ($rs['resCode'] == '000010') {
                return null;
            } else {
                Session::instance()->set('wechatBinding', $weChatData);
                return FALSE;
            }

        }
    }

    /**
     * bind WeChat
     *
     * @param $data
     *
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
     *
     * @param $data
     *
     * @return array $ret
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
     *
     * @return string
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
     *
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
     *
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

        if (DEBUG) {
            echo ' DEBUG: ';
            echo($userInfo);
            echo '----';
        }
        return $this->getUserInfo([
            'userID' => $userInfo['userID'],
            'TOKEN' => $userInfo['token']
        ]);
    }

    public function getUserPoint($data)
    {
        $url = API_URL . '?m=points&a=getPoint';
        $ret = $this->_curlPost($url, $data, 'getPoint');
        return $ret;
    }

    public function getUserPointList($getData)
    {
        $data = [
            'pageNo' => $getData['pageNo'],
            'pageSize' => $getData['pageSize'],
            'u_id' => $getData['userID'],
            'TOKEN' => Session::instance()->get('userInfo')['token'],
            'userID' => Session::instance()->get('userInfo')['userID']
        ];
        $url = API_URL . '?m=points&a=getPointListUser';
        $ret = $this->_curlPost($url, $data, 'getPointListUser');
        return $ret;
    }


    /**
     * 用户详情
     *
     * @param $data
     *
     * @return mixed
     */
    public function getUserInfo($data)
    {
        $url = API_URL . '?m=User&a=getUserInfo';
        $ret = $this->_curlPost($url, $data, 'getUserInfo');

        return $ret;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function userProductInfo($data)
    {
        $url = API_URL . '?m=User&a=userProductInfo';
        $ret = $this->_curlPost($url, $data, 'userProductInfo');

        return $ret;
    }

    /**
     * show home menu
     * @return mixed
     */
    public function showMenu()
    {
        $userInfo = Session::instance()->get('userInfo');

        if ($userInfo['companyID'] == null) {
            $userInfo['companyID'] = '0';
        }

        $m = $this->__showHomeMenu([
            'TOKEN' => $userInfo['token'],
            'companyID' => $userInfo['companyID'],
            'userID' => $userInfo['userID']
        ]);
        return $m;

    }

    /**
     * user logs
     *
     * @param array $data
     *
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
     *
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
     *
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
            $userInfoArr = json_decode($this->__checkToken([
                'token' => $data['token'],
                'userID' => $data['userID']]), TRUE);
            $rs = true;
            if ($userInfoArr['resCode'] != '000000' || $userInfo == null) {
//            Session::instance()->destroy();
                $cache = new CacheClass();
                $cache->redis->hdel($data['token'] . '_cache');
                $rs = false;
//            $rs = true;
            }
        }


        return $rs;
    }

    /**
     * check permission
     * @param $data
     * @return bool
     */
    public function checkPermission($data)
    {
        $check = json_decode($this->_curlPost(API_URL . "?m=Permissions&a=checkPermission", $data), true);
        return $check['resCode'] == 20000;
    }

    public function checkPermissionSource($data)
    {
        $url = API_URL . '?m=Permissions&a=checkPermission';
        $ret = $this->_curlPost($url, $data, 'checkPermission');
        return $ret;
    }

    /**
     * binding IRDA
     *
     * @param $data
     *
     * @return mixed
     */
    public function bindingIRDAToUser($data)
    {
        $userInfo = Session::instance()->get('userInfo');
        $data = json_decode($data, true);
        $data['userID'] = $userInfo['userID'];
        $data['userid'] = $userInfo['userID'];
        $data['cpy_id'] = $userInfo['companyID'];
        $data['token'] = $userInfo['token'];
        $ret = $this->__bindingProduct($data);
        $tempRet = json_decode($ret, true);
        if ($tempRet['resCode'] == '000000') {
            $userInfo['productKey'] = '1';
            Session::instance()->set('userInfo', $userInfo);
            $m = $this->__showHomeMenu([
                'TOKEN' => $userInfo['token'],
                'companyID' => $userInfo['companyID'],
                'userID' => $userInfo['userID']
            ]);
            Session::instance()->set('menu', $m);
            unset($tempRet);
        }
        return $ret;
    }

    /**
     * get IRDA
     *
     * @param $productKey
     * @return mixed|string
     */
    public function getIResearchDataAccount($productKey)
    {
        $saveOldIResearchDataInfo = $this->__getIResearchDataAccount(json_encode(['iUserID' => $productKey]));
        Session::instance()->set('iResearchDataUserInfo', $saveOldIResearchDataInfo);
        Session::instance()->set('irdTimeOut', time() * 60);
        return $saveOldIResearchDataInfo;
    }

    public function getIRDataAccount($guid)
    {
        $irdAccountInfo = $this->__getIResearchDataAccountNoLogin(json_encode(['guid' => $guid]));
        return $irdAccountInfo;
    }

    public function logOut()
    {
        $userInfo = Session::instance()->get('userInfo');
        $url = API_URL . '?m=Login&a=cancel';
        $ret = $this->_curlPost($url, ['TOKEN' => $userInfo['token'], 'userID' => $userInfo['userID']], 'cancel');
    }

    /**
     * block user
     *
     * @param array $data
     *
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
     *
     * @param array $data
     *
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
     *
     * @param $userInfo
     *
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

    /**
     * trial apply
     *
     * @param $data
     * @return mixed
     */
    public function trialApply($data)
    {
        $url = API_URL . '?m=permissions&a=applyPermission';
        $ret = $this->_curlPost($url, $data, 'applyPermission');
        write_to_log(json_encode($data), '_apply');
        return $ret;
    }

    /**
     * get permission
     *
     * @param $data
     * @return mixed
     */
    public function getPermission($data)
    {
        return $this->__getPermissionInfo($data);
    }

    /**
     * get product
     *
     * @param $data
     * @return mixed
     */
    public function getProduct($data)
    {
        $url = API_URL . '?m=permissions&a=getProduct';
        $ret = $this->_curlPost($url, $data, 'getProduct');
        return $ret;
    }

    /**
     * check mail
     * @param $data
     * @return mixed
     */
    public function checkMail($data)
    {
        $url = API_URL . '?m=permissions&a=checkMail';
        return $this->_curlPost($url, $data, 'checkMail');
    }

    /**
     * point list
     * @param $data
     * @return mixed
     */
    public function pointList($data)
    {
        $url = API_URL . '?m=points&a=pointList';
        return $this->_curlPost($url, $data, 'pointList');
    }

    /**
     * get point
     *
     * @param $data
     * @return mixed
     */
    public function getPoint($data)
    {
        $url = API_URL . '?m=points&a=getPoint';
        return $this->_curlPost($url, $data, 'getPoint');
    }

    public function getIRVuserid($data)
    {
        $url = API_URL . '?m=user&a=getIRVuserid';
        return $this->_curlPost($url, $data, 'getIRVuserid');
    }

    public function pushLog($data)
    {
        if (empty($data['log_ip'])) {
            $data['log_ip'] = getIp();
        }
        $url = API_URL . '?m=logs&a=pushLog';
        return $this->_curlPost($url, $data, 'pushLog');
    }

    public function regionList($data)
    {
        $url = API_URL . '?m=user&a=regionList';
        return $this->_curlPost($url, $data, 'regionList');
    }

    public function industryList($data)
    {
        $url = API_URL . '?m=user&a=industryList';
        return $this->_curlPost($url, $data, 'industryList');
    }

    public function getUserInfoByIRD($data)
    {
        $url = API_URL . '?m=user&a=getUserInfoByIRD';
        return $this->_curlPost($url, $data, 'getUserInfoByIRD');
    }

    public function productInfo($data)
    {
        $url = API_URL . '?m=user&a=productInfo';
        return $this->_curlPost($url, $data, 'productInfo');
    }


    ######################################################################################
    ##################################                     ###############################
    #################################   PRIVATE METHODS   ################################
    ################################                     #################################
    ######################################################################################


    /**
     * iReSearch Data Account
     *
     * @param $data
     *
     * @return mixed|string
     */
    public function __getIResearchDataAccount($data)
    {
        $url = 'http://sys.itracker.cn/api/WebForm1.aspx';
        $encryptData = fnEncrypt($data, KEY);

        if (DEBUG) {
            echo 'Resource:';
            var_dump($data);
            echo 'Encrypt: ';
            var_dump($encryptData);
        }
        write_to_log('resouce: ' . json_encode($data), '_ird_en');
        write_to_log('encrypt: ' . json_encode($encryptData), '_ird_en');
        $ret = $this->_curlAPost($url, ['v' => $encryptData]);


        return $ret;
    }


    public function __getIResearchDataAccountNoLogin($data)
    {
        $url = 'http://sys.itracker.cn/api/WebForm2.aspx';
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
     *
     * @param $data
     *
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
     *
     * @param $data
     *
     * @return mixed
     */
    private function __showHomeMenu($data)
    {
        $url = API_URL . '?m=Permissions&a=getHomeMenu';
        $ret = $this->_curlPost($url, $data, 'getHomeMenu');
        return $ret;
    }

    /**
     * get permissions
     *
     * @param $data ['token','pdt_id']
     *
     * @return mixed
     */
    private function __getPermissionInfo($data)
    {
        $url = API_URL . '?m=Permissions&a=checkPermission';
        return $this->_curlPost($url, $data, 'checkPermission');
    }

    /**
     * msg list
     * @param $data
     * @return mixed|string
     */
    public function msgList($data)
    {
        $url = API_URL . '?m=service&a=msgList';
        return $this->_curlPost($url, $data, 'msgList');
    }

    /**
     * countUnMsg
     * @param $data
     * @return mixed|string
     */
    public function countUnMsg($data)
    {
        $url = API_URL . '?m=service&a=countUnMsg';
        return $this->_curlPost($url, $data, 'countUnMsg');
    }

    /**
     * msg Detail
     * @param $data
     * @return mixed|string
     */
    public function msgDetail($data)
    {
        $url = API_URL . '?m=service&a=msgDetail';
        return $this->_curlPost($url, $data, 'msgDetail');
    }


    /**
     * check ird permission
     *
     * @param array $pplist
     * @param $pdt_id
     * @return bool
     */
    private function __checkIRDPermission(array $pplist, $pdt_id)
    {
        $stat = false;
        // check ivt
        foreach ($this->irdUserInfo['pplist'] as $p) {
            if ($p['ppname'] == 'ivt' and ($pdt_id == 45 or $pdt_id == 18 or $pdt_id == 19)) {
                $stat = true;
            }
        }

        return $stat;
    }

    private function __checkToken($data)
    {
        $url = API_URL . '?m=user&a=checkToken';
        return $this->_curlPost($url, $data, 'checkToken');
    }

}
