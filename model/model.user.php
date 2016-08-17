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
class UserModel extends AgentModel {
    public function upUserSessionKey($yu){
//        $userSessionKey = md5(KEY.time());
        $userSessionKey = $yu;
        $upInfo = array(
            "userinfo"=>$userSessionKey
        );
        $res = $this->mysqlEdit("user",$upInfo,'uid=1');
        return $userSessionKey;
    }
}
