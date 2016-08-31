<?php
/**
 * Created by 艾瑞咨询集团.
 * User: DavidWei
 * Date: 16-8-29
 * Time: 下午3:38
 * Email:davidwei@iresearch.com.cn
 * FileName:model.industry.php
 * 描述:
 */
class IndustryModel extends API {
    public function industryMaxList($data){
        $url = API_URL . '?m=industry&a=IndustryMaxList';
        $ret = $this->_curlPost($url, $data,'industryMaxList');
        $ret = json_decode($ret,true);
        return $ret;
    }

    public function industryMinList($data){
        $url = API_URL . '?m=industry&a=IndustryMinList';
        $ret = $this->_curlPost($url, $data,'industryMinList');
        $ret = json_decode($ret,true);
        return $ret;
    }
    public function configList($data){
        $url = API_URL . '?m=config&a=configList';
        $ret = $this->_curlPost($url, $data,'configList');
        $ret = json_decode($ret,true);
        return $ret;
    }
}
