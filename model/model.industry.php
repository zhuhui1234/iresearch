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

    /**
     * 取得用户大行业、小行业
     */
    public function getUserIndustry($data){
        $rs=array();
        $ret = $this->industryMaxList($data);
        if($ret['resCode']=='000000'){
            for($i=0;$i<count($ret['data']['IndustryMaxList']['data']);$i++){
                $rs['max'][$i] = $ret['data']['IndustryMaxList']['data'][$i];
                $data['ity_sid']=$ret['data']['IndustryMaxList']['data'][$i]['ity_id'];
                $minInfo = $this->industryMinList($data);
                if($minInfo['data']['totalSize']>0){
                    $rs['min'][$i]['info']=$minInfo['data']['IndustryMinList'];
                    $rs['min'][$i]['pid']=$data['ity_sid'];
                }
                else {
                    $rs['min'][$i]['info']=array("ity_name"=>"暂无数据");
                    $rs['min'][$i]['pid']=$data['ity_sid'];
                }
            }
        }
        return $rs;
    }
}
