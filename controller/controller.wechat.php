<?php
/**
 * Created by PhpStorm.
 * User: robinwong51
 * Date: 25/11/2016
 * Time: 7:14 PM
 */

class WeChatController extends Controller
{

    private $model;

    public function __construct()
    {
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
        $weChatObj = $wechatModel->wxCheckLogin($code);
        $userInfo = Session::instance()->get('userInfo');
        pr('微信返回值:');
//        var_dump($state);
//        var_dump($weChatObj);
//        var_dump($wechatModel->getUserInfo($code));
//        var_dump($userInfo);
//        exit();
//        if(substr($state,0,10)=='viewReport'){
//            $state_tmp = explode('_',$state);
//            $state = $state_tmp[0];
//            $cfg_id = $state_tmp[1];
//        }
        switch ($state) {

            case 'wxLogin':
                $ret = $this->__weChatAutoLogin(array(
                    'Account'  => $weChatObj['openid'],
                    'LoginKey' => $weChatObj['unionid']
                ),$wechatModel->getUserInfo($code));
//                var_dump($ret);
//                exit();
                if ($ret){
                    header('Location: ?m=index');
                }else{
                    header("Location: ?m=user&a=BindingWeChat");
                }

                break;
            //binding weChat
            case 'binding':
                $ret =  $this->__bindingWeChat(array(
                    'loginOpenid'  => $weChatObj['openid'],
                    'loginUnionid' => $weChatObj['unionid'],
                    'u_account'    => $userInfo['u_account'],
                    'token'        => $userInfo['u_token']
                ));
                $j_ret = json_decode($ret, TRUE);
                if ($j_ret['resCode'] == '000000') {
                    $this->wechatStatus = TRUE;
                    View::instance('usr/success.tpl')->show($j_ret);
                }else{
                    View::instance('user/fail.tpl')->show($j_ret);
                }
                break;
//            case 'viewReport':
//                print_r($state_tmp);
//                break;
        }
    }


    /**
     * 自动登入
     *
     * @param $data
     * @return mixed
     */
    private function __weChatAutoLogin($data,$weChatData)
    {
        return $this->model->WeChatAutoLogin($data,$weChatData);
    }

    private function __bindingWeChat($data)
    {
        return $this->model->bindWeChat($data);
    }
}