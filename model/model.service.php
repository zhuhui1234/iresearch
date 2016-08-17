<?php
/**
 * Created by 艾瑞咨询集团.
 * User: DavidWei
 * Date: 16-8-10
 * Time: 下午3:00
 * Email:davidwei@iresearch.com.cn
 * FileName:model.service.php
 * 描述:
 */
class ServiceModel extends AgentModel {

    /**
     * 生成随即字符串
     * @param $length
     * @return string
     */
    function getRandChar($length){
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol)-1;

        for($i=0;$i<$length;$i++){
            $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }
        return $str;
    }
    function callBackYH(){
        $sessionKey = $this->request()->requestAll('sessionKey');
        $yhUser = $sessionKey;
        $rs = "<root><username>".$yhUser."</username></root>";
        l($sessionKey);
        return $rs;
    }

}