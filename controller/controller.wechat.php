<?php

/**
 * Created by PhpStorm.
 * User: robinwong51
 * Date: 25/11/2016
 * Time: 7:14 PM
 */
class WeChatController extends Controller
{

    private $model, $wechatStatus;

    public function __construct($classname)
    {
        parent::__construct($classname);
        $this->model = Model::instance('user');
    }

    /**
     * wechat login api
     */
    public function wxLoginAPI()
    {

        $wechatModel = Model::instance('wechat');
        $code = $this->request()->get('code');
        $state = $this->request()->get('state');
        $pdtID = $this->request()->get('pdtID');
        if (!empty($_REQUEST['redirect'])) {
            $redirect = urlencode($_REQUEST['redirect']);
        } else {
            $redirect = null;
        }
        $ppName = urldecode($this->request()->get('ppname'));
        $jumpURI = '?m=user&a=jump&pro=' . $pdtID;
        $classicSysURI = '?m=irdata&a=classicSys&ppname=' . $ppName . '&pro=' . $pdtID;
        $weChatObj = $wechatModel->wxCheckLogin($code);
        $weChatUser = $wechatModel->getUserInfo($code);
        $userInfo = Session::instance()->get('userInfo');

        write_to_log("get state: {$state}", '_wx');
        write_to_log('wechatObj: ' . json_encode($weChatObj), '_wx');
        write_to_log('wechatUser: ' . json_encode($weChatUser), '_wx');
        if (DEBUG) {
            pr('微信返回值:');

            if (substr($state, 0, 10) == 'viewReport') {
                $state_tmp = explode('_', $state);
                $state = $state_tmp[0];
//                $cfg_id = $state_tmp[1];
            }
        }

        switch ($state) {

            case 'wxLogin':
                $ret = $this->__weChatAutoLogin(array(
                    'Account' => $weChatObj['openid'],
                    'LoginKey' => $weChatObj['unionid'],
                    'wxName' => $weChatUser['nickname'],
                ), $wechatModel->getUserInfo($code));

                write_to_log('ret: ' . json_encode($ret), '_wx');
                if ($ret) {
                    if ($ret === 20) {
                        header('Location: ?m=user&a=login&recode=502');
                        exit();
                    }

                    if ($ret !== null) {
                        write_to_log('ppname: ' . $ppName, '_debug');
                        write_to_log('pdtid: ' . $pdtID, '_debug');

                        if (!empty($pdtID) and empty($ppName)) {
                            header('Location: ' . $jumpURI);
                        } elseif (!empty($pdtID) and !empty($ppName)) {
                            header('Location: ' . $classicSysURI);
                        } else {
                            header('Location: ?m=index');
                        }
                    } else {
                        header('Location: ?m=user&a=login&recode=402');
                    }

                } else {
                    header("Location: ?m=user&a=BindingWeChat");
                }

                break;

            case 'goToUt':
                $ret = $this->__weChatAutoLogin(array(
                    'Account' => $weChatObj['openid'],
                    'LoginKey' => $weChatObj['unionid'],
                    'wxName' => $weChatUser['nickname'],
                ), $wechatModel->getUserInfo($code));

                write_to_log('ret: ' . json_encode($ret), '_wx');
                if ($ret) {
                    if ($ret === 20) {
                        header('Location: ?m=user&a=login&recode=502');
                        exit();
                    }
                    if ($ret !== null) {
                        write_to_log('ppname: ' . $ppName, '_debug');
                        write_to_log('pdtid: ' . $pdtID, '_debug');
                        header('Location: ?m=index&a=xut');

                    } else {
                        header('Location: ?m=user&a=login?recode=402');
                    }

                } else {
                    header("Location: ?m=user&a=BindingWeChat");
                }

                break;

            case 'goToVT':
                $ret = $this->__weChatAutoLogin(array(
                    'Account' => $weChatObj['openid'],
                    'LoginKey' => $weChatObj['unionid'],
                    'wxName' => $weChatUser['nickname'],
                ), $wechatModel->getUserInfo($code));

                write_to_log('ret: ' . json_encode($ret), '_wx');
                if ($ret) {
                    if ($ret === 20) {
                        header('Location: ?m=user&a=login&recode=502');
                        exit();
                    }
                    if ($ret !== null) {
                        write_to_log('ppname: ' . $ppName, '_debug');
                        write_to_log('pdtid: ' . $pdtID, '_debug');
                        header('Location: ?m=index&a=xvt');
                    } else {
                        header('Location: ?m=user&a=login?recode=402');
                    }

                } else {
                    header("Location: ?m=user&a=BindingWeChat");
                }

                break;

            case 'wxLoginUserCenter':
                $ret = $this->__weChatAutoLogin(array(
                    'Account' => $weChatObj['openid'],
                    'LoginKey' => $weChatObj['unionid'],
                    'wxName' => $weChatUser['nickname'],
                ), $wechatModel->getUserInfo($code));
//                var_dump($ret);
//                exit();
                write_to_log('ret: ' . json_encode($ret), '_wx');
                if ($ret) {
                    if ($ret === 20) {
                        header('Location: ?m=user&a=login&recode=502');
                        exit();
                    }

                    if ($ret !== null) {
                        if (!empty($pdtID)) {
                            header('Location: ' . $jumpURI);
                        } else if (!empty($ppName)) {
                            header('Location: ' . $classicSysURI);
                        } else {
                            header('Location: https://irv.iresearch.com.cn/user-center/check/?' . USERCENTER_VERSION);
                        }
                    } else {
                        header('Location: ?m=user&a=login?recode=402');
                    }

                } else {
                    header("Location: ?m=user&a=BindingWeChat");
                }

                break;


            case 'wxLoginKnowledge':
                $ret = $this->__weChatAutoLogin(array(
                    'Account' => $weChatObj['openid'],
                    'LoginKey' => $weChatObj['unionid'],
                    'wxName' => $weChatUser['nickname'],
                ), $wechatModel->getUserInfo($code));
//                var_dump($ret);
//                exit();
                write_to_log('ret: ' . json_encode($ret), '_wx');
                if ($ret) {
                    if ($ret === 20) {
                        header('Location: ?m=user&a=login&recode=502');
                        exit();
                    }

                    if ($ret !== null) {
                        if (!empty($pdtID)) {
                            header('Location: ' . $jumpURI);
                        } else if (!empty($ppName)) {
                            header('Location: ' . $classicSysURI);
                        } else {
                            header('Location: https://irv.iresearch.com.cn/user-center/check?type=k');
                        }
                    } else {
                        header('Location: ?m=user&a=login?recode=402');
                    }

                } else {
                    header("Location: ?m=user&a=BindingWeChat");
                }

                break;

            case 'wxLoginUtVideo':
                $ret = $this->__weChatAutoLogin(array(
                    'Account' => $weChatObj['openid'],
                    'LoginKey' => $weChatObj['unionid'],
                    'wxName' => $weChatUser['nickname'],
                ), $wechatModel->getUserInfo($code));

                write_to_log('ret: ' . json_encode($ret), '_wx');
                if ($ret) {
                    if ($ret === 20) {
                        header('Location: ?m=user&a=login&recode=502');
                        exit();
                    }

                    if ($ret !== null) {
                        if (!empty($redirect)) {
                            header('Location: ?m=index&a=video_manual&redirect=' . $redirect);
                        } else {
                            header('Location: ?m=index&a=video_manual');
                        }
                    } else {
                        header('Location: ?m=user&a=login?recode=402');
                    }

                } else {
                    header("Location: ?m=user&a=BindingWeChat");
                }

                break;

            case 'wxLoginMsg':
                $ret = $this->__weChatAutoLogin(array(
                    'Account' => $weChatObj['openid'],
                    'LoginKey' => $weChatObj['unionid'],
                    'wxName' => $weChatUser['nickname'],
                ), $wechatModel->getUserInfo($code));
//                var_dump($ret);
//                exit();
                write_to_log('ret: ' . json_encode($ret), '_wx');
                if ($ret) {
                    if ($ret === 20) {
                        header('Location: ?m=user&a=login&recode=502');
                        exit();
                    }

                    if ($ret !== null) {
                        if (!empty($pdtID)) {
                            header('Location: ' . $jumpURI);
                        } else if (!empty($ppName)) {
                            header('Location: ' . $classicSysURI);
                        } else {
                            header('Location: https://irv.iresearch.com.cn/user-center/check?type=m');
                        }
                    } else {
                        header('Location: ?m=user&a=login?recode=402');
                    }

                } else {
                    header("Location: ?m=user&a=BindingWeChat");
                }

                break;


            //binding weChat
            case 'binding':
                $ret = $this->__bindingWeChat(array(
                    'loginOpenid' => $weChatObj['openid'],
                    'loginUnionid' => $weChatObj['unionid'],
                    'u_account' => $userInfo['u_account'],

                    'token' => $userInfo['token']
                ));
                $j_ret = json_decode($ret, TRUE);
                if ($j_ret['resCode'] == '000000') {
                    $this->wechatStatus = true;
                    View::instance('usr/success.tpl')->show($j_ret);
                } else {
                    View::instance('user/fail.tpl')->show($j_ret);
                }
                break;

            //用户在个人信息里绑定
            case 'bindingUser':
                $bindingData = [
                    'TOKEN' => $userInfo['token'],
                    'userID' => $userInfo['userID'],
                    'wxName' => $weChatUser['nickname'],
                    'wxOpenid' => $weChatObj['openid'],
                    'wxUnionid' => $weChatObj['unionid']
                ];
                $ret = $this->__bindingWeChatForUser($bindingData);
                $j_ret = json_decode($ret, true);
                if ($j_ret['resCode'] == "000000") {
                    echo("<SCRIPT LANGUAGE=\"JavaScript\">
                    alert(\"微信绑定成功\");
//                    window.location.href=\"?m=user&a=editUserInfo\";
                    window.location.href=\"?m=user&a=editUserInfo\";
                    </SCRIPT>");
                } else {
                    echo("<SCRIPT LANGUAGE=\"JavaScript\">
                    alert(\"微信绑定失败\");
                    window.location.href=\"?m=user&a=editUserInfo\";
                    </SCRIPT>");
                }
                break;

            case 'bindingUserFromIRD':
                $bindingData = [
                    'TOKEN' => $userInfo['token'],
                    'userID' => $userInfo['userID'],
                    'wxName' => $weChatUser['nickname'],
                    'wxOpenid' => $weChatObj['openid'],
                    'wxUnionid' => $weChatObj['unionid']
                ];
                $ret = $this->__bindingWeChatForUser($bindingData);
                $j_ret = json_decode($ret, true);
                if ($j_ret['resCode'] == "000000") {
                    echo("<SCRIPT LANGUAGE=\"JavaScript\">
                    alert(\"微信绑定成功\");
                    window.location.href=\"?m=index&a=index\";
                    </SCRIPT>");
                } else {
                    echo("<SCRIPT LANGUAGE=\"JavaScript\">
                    alert(\"微信绑定失败\");
                    window.location.href=\"?m=index&a=index\";
                    </SCRIPT>");
                }

//            case 'viewReport':
//                print_r($state_tmp);
//                break;
        }
    }


    /**
     * 自动登入
     * @param $data
     * @param $weChatData
     *
     * @return mixed
     */
    private function __weChatAutoLogin($data, $weChatData)
    {
        return $this->model->WeChatAutoLogin($data, $weChatData);
    }

    /**
     * binding wechat
     * @param $data
     *
     * @return mixed
     */
    private function __bindingWeChat($data)
    {
        return $this->model->bindWeChat($data);
    }

    /**
     * binding wechat for user
     * @param $data
     *
     * @return mixed
     */
    private function __bindingWeChatForUser($data)
    {
        return $this->model->bindingWeChartUser($data);
    }
}