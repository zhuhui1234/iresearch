<?php

/**
 * Created by PhpStorm.
 * User: robinwong51
 * Date: 9/6/16
 * Time: 4:05 PM
 */
class WeChatModel extends API
{
    public function wxCheckLogin($code)
    {
        $postURL = WECHAT_API_URL . 'appid=' . W_APP_ID . '&secret=' . W_SECRET . '&code=' . $code . '&grant_type=authorization_code';

        $ret = $this->_curlGet(WECHAT_API_URL,array(
            'appid'       =>  W_APP_ID,
            'secret'      =>  W_SECRET,
            'code'        =>  $code,
            'grant_type'  => 'authorization_code'
        ));
        var_dump($ret);
    }
}