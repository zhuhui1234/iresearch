<?php

/**
 * Created by PhpStorm.
 * User: robinwong51
 * Date: 9/6/16
 * Time: 4:05 PM
 */
class WeChatModel extends API
{
    private $code,$appid, $secret, $api,$openid,$weChatResponse, $weChatResponseArray,$token,$refresh_token,$userInfo,$unionid;

    /**
     * WeChatModel constructor.
     */
    public function __construct()
    {
        $this->appid              =   W_APP_ID;
        $this->secret             =   W_SECRET;
        $this->api                =   WECHAT_API_URL;
    }

    /**
     * weChat login
     * @param $code
     * @return mixed
     */
    public function wxCheckLogin($code)
    {
        $this->__WeChat($code);
        if (!$this->getError($this->weChatResponseArray)) {

            $this->openid                      =  $this->weChatResponseArray['openid'];
            $this->token                       =  $this->weChatResponseArray['access_token'];
            $this->refresh_token               =  $this->weChatResponseArray['refresh_token'];

            return $this->weChatResponseArray;
        } else {

            $this->weChatResponseArray['tmsg'] =  $this->getError($this->weChatResponseArray);

            return $this->weChatResponseArray;
        }
    }

    /**
     * weChat user Info
     * @param $code
     * @return bool|mixed
     */
    public function getUserInfo($code = null)
    {
        if (!empty($this->token)) {
            $this->userInfo       =  $this->__getUserInfo();
            return json_decode($this->userInfo, TRUE);
        }else{
            if (!empty($code)) {
                $this->wxCheckLogin($code);
                $this->userInfo   =  $this->__getUserInfo();
                return $this->userInfo;
            } else {
                $this->wxCheckLogin($code);
                $this->userInfo   =  $this->__getUserInfo();
                return $this->userInfo;
            }
        }
    }

    public function refresh()
    {
        $res                      =   $this->_curlGet(WECHAT_API_REFRESH_URL, array(

        ));

        $res                      =    json_decode($res,TRUE);

        $this->token              =   $res['access_token'];
        $this->refresh_token      =   $res['refresh_token'];
        $this->openid             =   $res['openid'];

        return $res;

    }

    /**
     * we chat make response
     * @param $code
     */
    private function __WeChat($code)
    {
        $this->weChatResponse     =   $this->_curlGet($this->api,array(
            'appid'               =>  $this->appid,
            'secret'              =>  $this->secret,
            'code'                =>  $code,
            'grant_type'          =>  'authorization_code'
        ));

        madTest($this->weChatResponse);

        $this->weChatResponseArray = json_decode($this->weChatResponse,true);
    }


    /**
     * get user infor
     * @return bool|mixed
     */
    private function __getUserInfo()
    {
        if (!$this->getError($this->weChatResponseArray)) {
            $userInfo             =  $this->_curlGet(WECHAT_API_USERINFO, array(
                access_token      => $this->token,
                openid            => $this->openid
            ));

            $userInfo             =  json_decode($userInfo, TRUE);

            if (isset($userInfo['unionid'])) {
                $this->unionid    = $userInfo['unionid'];
            }
            return $userInfo;
        } else {
                return FALSE;
        }
    }


    /**
     * get error info
     * @return bool|string
     */
    public function getError($res)
    {

        if (isset($res['errcode'])) {
            switch ($res['errcode']) {
                case "40001":
                    return "invalid credential	不合法的调用凭证";
                    break;
                case "40002":
                    return "invalid grant_type	不合法的grant_type";
                    break;
                case "40003":
                    return "invalid openid	不合法的OpenID";
                    break;
                case "40004":
                    return "invalid media type	不合法的媒体文件类型";
                    break;
                case "40007":
                    return "invalid media_id	不合法的media_id";
                    break;
                case "40008":
                    return "invalid message type	不合法的message_type";
                    break;
                case "40009":
                    return "invalid image size	不合法的图片大小";
                    break;
                case "40010":
                    return "invalid voice size	不合法的语音大小";
                    break;
                case "40011":
                    return "invalid video size	不合法的视频大小";
                    break;
                case "40012":
                    return "invalid thumb size	不合法的缩略图大小";
                    break;
                case "40013":
                    return "invalid appid	不合法的AppID";
                    break;
                case "40014":
                    return "invalid access_token	不合法的access_token";
                    break;
                case "40015":
                    return "invalid menu type	不合法的菜单类型";
                    break;
                case "40016":
                    return "invalid button size	不合法的菜单按钮个数";
                    break;
                case "40017":
                    return "invalid button type	不合法的按钮类型";
                case "40018":
                    return "invalid button name size	不合法的按钮名称长度";
                    break;
                case "40019":
                    return "invalid button key size	不合法的按钮KEY长度";
                    break;
                case "40020":
                    return "invalid button url size	不合法的url长度";
                case "40023":
                    return "invalid sub button size	不合法的子菜单按钮个数";
                    break;

                case "40024":
                    return "invalid sub button type	不合法的子菜单类型";
                    break;

                case "40025":
                    return "invalid sub button name size	不合法的子菜单按钮名称长度";
                    break;

                case "40026":
                    return "invalid sub button key size	不合法的子菜单按钮KEY长度";
                    break;

                case "40027":
                    return "invalid sub button url size	不合法的子菜单按钮url长度";
                    break;

                case "40029":
                    return "invalid code	不合法或已过期的code";
                    break;

                case "40030":
                    return "invalid refresh_token	不合法的refresh_token";
                    break;

                case "40036":
                    return "invalid template_id size	不合法的template_id长度";
                    break;

                case "40037":
                    return "invalid template_id	不合法的template_id";
                    break;

                case "40039":
                    return "invalid url size	不合法的url长度";
                    break;

                case "40048":
                    return "invalid url domain	不合法的url域名";
                    break;

                case "40054":
                    return "invalid sub button url domain	不合法的子菜单按钮url域名";
                    break;

                case "40055":
                    return "invalid button url domain	不合法的菜单按钮url域名";
                    break;

                case "40066":
                    return "invalid url	不合法的url";
                    break;

                case "41001":
                    return "access_token missing	缺失access_token参数";
                    break;

                case "41002":
                    return "appid missing	缺失appid参数";
                    break;

                case "41003":
                    return "refresh_token missing	缺失refresh_token参数";
                    break;

                case "41004":
                    return "appsecret missing	缺失secret参数";
                    break;

                case "41005":
                    return "media data missing	缺失二进制媒体文件";
                    break;

                case "41006":
                    return "media_id missing	缺失media_id参数";
                    break;

                case "41007":
                    return "sub_menu data missing	缺失子菜单数据";
                    break;

                case "41008":
                    return "missing code	缺失code参数";
                    break;
                case "41009":
                    return "missing openid	缺失openid参数";
                    break;
                case "41010":
                    return "missing url	缺失url参数";
                    break;
                case "42001":
                    return "access_token expired	access_token超时";
                    break;
                case "42002":
                    return "refresh_token expired	refresh_token超时";
                    break;
                case "42003":
                    return "code expired code超时";
                    break;
                case "43001":
                    return "require GET method	需要使用GET方法请求";
                    break;
                case "43002":
                    return "require POST method	需要使用POST方法请求";
                    break;
                case "43003":
                    return "require https	需要使用HTTPS";
                    break;
                case "43004":
                    return "require subscribe	需要订阅关系";
                    break;
                case "44001":
                    return "empty media data	空白的二进制数据";
                    break;
                case "44002":
                    return "empty post data	空白的POST数据";
                    break;
                case "44003":
                    return "empty news data	空白的news数据";
                    break;
                case "44004":
                    return "empty content	空白的内容";
                    break;
                case "44005":
                    return "empty list size	空白的列表";
                    break;
                case "45001":
                    return "media size out of limit	二进制文件超过限制";
                    break;
                case "45002":
                    return "content size out of limit	content参数超过限制";
                    break;
                case "45003":
                    return "title size out of limit	title参数超过限制";
                    break;
                case "45004":
                    return "description size out of limit	description参数超过限制";
                    break;
                case "45005":
                    return "url size out of limit	url参数长度超过限制";
                    break;
                case "45006":
                    return "picurl size out of limit	picurl参数超过限制";
                    break;
                case "45007":
                    return "playtime out of limit	播放时间超过限制（语音为60s最大）";
                    break;
                case "45008":
                    return "article size out of limit	article参数超过限制";
                    break;
                case "45009":
                    return "api freq out of limit	接口调动频率超过限制";
                    break;
                case "45010":
                    return "create menu limit	建立菜单被限制";
                    break;
                case "45011":
                    return "api limit	频率限制";
                    break;
                case "45012":
                    return "template size out of limit	模板大小超过限制";
                    break;
                case "45016":
                    return "can't modify sys group	不能修改默认组";
                    break;
                case "45017":
                    return "can't set group name too long sys group	修改组名过长";
                    break;
                case "45018":
                    return "too many group now, no need to add new	组数量过多";
                    break;
                case "50001":
                    return "api unauthorreturnized	接口未授权";
                    break;
                case "0":
                    return FALSE;
                    break;
                default:
                    return '未知错误';
                    break;
            }
        }else{
            return FALSE;
        }
    }

}