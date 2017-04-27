<?php

/**
 * Created by 艾瑞咨询集团.
 * User: DavidWei
 * Date: 16-8-29
 * Time: 下午3:36
 * Email:davidwei@iresearch.com.cn
 * FileName:controller.industry.php
 * 描述:
 */
class IndustryController extends Controller
{

    private $model;

    public function __construct()
    {
        $this->model = Model::instance('Industry');
    }

    public function getMaxIndustryAPI()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['token'];
        $ret = $this->model->industryMaxList($data);
        print_r($ret);
    }

    public function getMinIndustryAPI()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['token'];
        $data['ity_sid'] = $this->request()->requestAll("ity_sid");
        $ret = $this->model->industryMinList($data);
        $this->success($ret);
    }

    public function getConfigListAPI()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['token'];
        $data['cfg_model'] = 7;
        $ret = $this->model->configList($data);
        print_r($ret);
    }

    public function getConfigListJsonAPI()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['token'];
        $data['cfg_model'] = $this->request()->requestAll("cfg_model");
        $ret = $this->model->configListJson($data);
        $this->success($ret);
    }

    public function getUserIndustry()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['token'];
        $ret = $this->model->getUserIndustry($data);
    }

    /**
     * 获取某个报告的用户权限列表
     */
    public function getPermissionsListAPI()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['token'];
        $data['cfg_id'] = $this->request()->requestAll("cfg_id");
        $data['u_account'] = $userInfo['u_account'];
        $data['pageSize'] = $this->request()->requestAll("length", 10);
        $search = $this->request()->requestAll("search");
        $data['keyword'] = $search['value'];
        $start = $this->request()->requestAll("start", 0);
        $data['pageNo'] = $start / $data['pageSize'] + 1;
        $ret = $this->model->getPermissionsListDataTable($data);
        echo json_encode($ret);
    }

    /**
     * 展示小行业报告
     */
    public function showIndustryReport()
    {
        $userModel = Model::instance('user');
        $menu = json_decode($userModel->showMenu(), true);
        $menu = $menu['data']['dataList'];
        $menu = fillMenu($menu);

        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['token'];
        $userIndustry = Model::instance('Industry')->getUserIndustry($data);
        $data['cfg_model'] = $this->request()->requestAll("cfg_model");
        $ret = Model::instance('industry')->configList($data);
        $listInfo = $ret['data']['ConfigMaxList'];
        $default = array();
        $level = 4;
        if (count($listInfo[0]['ConfigMinList']) > 0) {
            $default['url'] = $listInfo[0]['ConfigMinList'][0]['cfg_url'];
            $default['name'] = $listInfo[0]['ConfigMinList'][0]['cfg_name'];
            $default['pname'] = $listInfo[0]['cfg_name'];
        } else {
            $default['url'] = $listInfo[0]['cfg_url'];
            $default['name'] = $listInfo[0]['cfg_name'];
            $default['pname'] = $listInfo[0]['cfg_name'];
            $level = 3;
        }
        $default['url'] = '//irv.iresearch.com.cn/iReport/?m=service&a=showReport&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B616';
        $data = array(
            "userIndustry" => $userIndustry,
            "listInfo" => $listInfo,
            "default" => $default,
            "pname" => $this->request()->requestAll("pname"),
            "ity_name" => $this->request()->requestAll("ity_name"),
            "level" => $level,
            'token' => $this->userInfo['token'],
            'u_account' => $this->userInfo['u_account'],
            'role' => $userInfo['permissions'],
            'menu' => $menu,
            'titleMenu' => $menu[1]['subMenu'],
            'mainMenu' => $this->__mainMenu($menu[1]['subMenu'])
        );
        if ((int)$userInfo['permissions'] > 0) {
            View::instance('service/showReport2.tpl')->show($data);
        } else {
            echo("<SCRIPT LANGUAGE=\"JavaScript\">
            alert(\"您并未开通此功能\");
            window.location.href=\"?m=index\";
            </SCRIPT>");
        }
    }

    /**
     * 服务列表
     */
    public function getAuditList()
    {
        $userInfo = Session::instance()->get('userInfo');
        $postData = [
            'keyword' => $this->request()->requestAll('keyword'),
            'orderByColumn' => $this->request()->requestAll('orderByColumn'),
            'orderByType' => $this->request()->requestAll('orderByType'),
            'pageNo' => $this->request()->requestAll('pageNo'),
            'pageSize' => $this->request()->requestAll('pageSize'),
            'token' => $userInfo['token'],
            'u_account' => $userInfo['u_account']
        ];
        $this->__json();
        echo $this->model->getAuditList($postData);
    }

    /**
     * 服务审核
     *    0审核中,1通过(有权限),2不通过,3无权限,4隐藏
     */
    public function upAudit()
    {
        $userInfo = Session::instance()->get('userInfo');
        echo $this->model->upAudit([
            'adt_id' => $this->request()->requestAll('adt_id'),
            'adt_state' => $this->request()->requestAll('adt_state'),
            'u_account' => $userInfo['u_account'],
            'token' => $userInfo['token']
        ]);
    }

    /**
     * 服务申请
     */
    public function setAudit()
    {

    }

    /**
     * 服务详情
     */
    public function getAuditInfo()
    {

    }

    ######################################################################################
    ##################################                     ###############################
    #################################   PRIVATE METHODS   ################################
    ################################                     #################################
    ######################################################################################

    /**
     * trans to  json
     */
    private function __json()
    {
        @@ob_clean();
        header('Content-type: application/json');
    }

    /**
     * main menu
     * @param array $menuData
     * @return array
     */
    private function __mainMenu(array $menuData)
    {
        foreach ($menuData as $menuDataKey => $menuDatum) {
            $re = [];
            if (count($menuDatum['lowerTree']) > 4) {
                for ($i=0;$i<ceil(count($menuDatum['lowerTree']));$i++) {
                    $v = array_slice($menuDatum['lowerTree'],$i*4, 4);
                    if (!empty($v)) {
                        $re[$i]['list'] = $v;
                    }
                }
            }else{
                $re[0]['list']=$menuDatum['lowerTree'];
            }
            $menuData[$menuDataKey]['reTree'] = $re;
        }
//        pr($menuData);
        return $menuData;
    }

}