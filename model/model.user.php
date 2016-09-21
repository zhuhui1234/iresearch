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
        $data = array("guid"=>$guid);
        $url  = API_URL_REPORT . '?m=user&a=setReportToken';
        $ret  = $this->_curlPost($url, $data,'cs_login');
   }

    public function login($data)
    {
        $url = API_URL . '?m=user&a=login';
        $ret = $this->_curlPost($url, $data,'cs_login');
        $ret = json_decode($ret,true);
        $rs  = false;
        if($ret['resCode']=='000000'){
            $rs = true;
            Session::instance()->set('userInfo',$ret['data'] );
        }
        return $rs;
    }

    public function registerUserInfo($data)
    {
        $url = API_URL . '?m=user&a=createUserinfo';
        $ret = $this->_curlPost($url, $data, 'createUserinfo');
        return $ret;
    }


}
