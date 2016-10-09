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
class IndustryModel extends API
{
    public function industryMaxList($data)
    {
        $url = API_URL . '?m=industry&a=IndustryMaxList';
        $ret = $this->_curlPost($url, $data, 'industryMaxList');
        $ret = json_decode($ret, true);
        return $ret;
    }

    public function industryMinList($data)
    {
        $url = API_URL . '?m=industry&a=IndustryMinList';
        $ret = $this->_curlPost($url, $data, 'industryMinList');
        $ret = json_decode($ret, true);
        return $ret;
    }

    public function configList($data)
    {
        $url = API_URL . '?m=config&a=configList';
        $ret = $this->_curlPost($url, $data, 'configList');
        $ret = json_decode($ret, true);
        return $ret;
    }

    public function configListJson($data)
    {
        $ret = $this->configList($data);
        $info = $ret['data']['ConfigMaxList'];
        $rs = array();
        for ($i = 0; $i < count($info); $i++) {
            $rs[$i]['text'] = $info[$i]['cfg_name'];
            $rs[$i]['cfg_id'] = $info[$i]['cfg_id'];
            for ($j = 0; $j < count($info[$i]['ConfigMinList']); $j++) {
                $rs[$i]['nodes'][$j]['text'] = $info[$i]['ConfigMinList'][$j]['cfg_name'];
                $rs[$i]['nodes'][$j]['cfg_id'] = $info[$i]['ConfigMinList'][$j]['cfg_id'];
            }
        }
        return $rs;
    }

    public function getPermissionsList($data)
    {
        $url = API_URL . '?m=user&a=getPermissionsList';
        $ret = $this->_curlPost($url, $data, 'getPermissionsList');
        $ret = json_decode($ret, true);
        return $ret;
    }
    public function getPermissionsListDataTable($data)
    {
        $ret = $this->getPermissionsList($data);
        $rs=array();
//        $rs['draw']=$data['pageNo'];
        $rs['recordsTotal'] = $ret['data']['totalSize'];
        $rs['recordsFiltered'] = $ret['data']['totalSize'];
        $rs['data'] = $ret['data']['PermissionsList'];
//        for($i=0;$i<count($ret['data']['PermissionsList']);$i++){
//            $rs['data'][$i]=array_values($ret['data']['PermissionsList'][$i]);
//        }
        return $rs;
    }

    /**
     * 取得用户大行业、小行业
     */
    public function getUserIndustry($data)
    {
        $rs = Session::instance()->get('userIndustry');
        if ($rs == null or $rs == '') {
            $ret = $this->industryMaxList($data);
            if ($ret['resCode'] == '000000') {
                for ($i = 0; $i < count($ret['data']['IndustryMaxList']['data']); $i++) {
                    $rs['max'][$i] = $ret['data']['IndustryMaxList']['data'][$i];
                    $data['ity_sid'] = $ret['data']['IndustryMaxList']['data'][$i]['ity_id'];
                    $data['ity_name'] = $ret['data']['IndustryMaxList']['data'][$i]['ity_name'];
                    $minInfo = $this->industryMinList($data);
                    if ($minInfo['data']['totalSize'] > 0) {
                        $rs['min'][$i]['info'] = $minInfo['data']['IndustryMinList'];
                        //大行业写入
                        for ($j = 0; $j < count($rs['min'][$i]['info']); $j++) {
                            $rs['min'][$i]['info'][$j]['pname'] = $data['ity_name'];
                        }
                        $rs['min'][$i]['pid'] = $data['ity_sid'];
                        $rs['min'][$i]['pname'] = $data['ity_name'];
                    } else {
                        $rs['min'][$i]['info'] = array("ity_name" => "暂无数据");
                        $rs['min'][$i]['pid'] = $data['ity_sid'];
                    }
                }
            }
            Session::instance()->set('userIndustry', $rs);
        }
        return $rs;
    }
}
