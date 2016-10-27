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
        $data['token'] = $userInfo['u_token'];
        $ret = $this->model->industryMaxList($data);
        print_r($ret);
    }

    public function getMinIndustryAPI()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $data['ity_sid'] = $this->request()->requestAll("ity_sid");
        $ret = $this->model->industryMinList($data);
        $this->success($ret);
    }

    public function getConfigListAPI()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $data['cfg_model'] = 7;
        $ret = $this->model->configList($data);
        print_r($ret);
    }

    public function getConfigListJsonAPI()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $data['cfg_model'] = $this->request()->requestAll("cfg_model");
        $ret = $this->model->configListJson($data);
        $this->success($ret);
    }

    public function getUserIndustry()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $ret = $this->model->getUserIndustry($data);
    }

    /**
     * 获取某个报告的用户权限列表
     */
    public function getPermissionsListAPI(){
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $data['cfg_id'] = $this->request()->requestAll("cfg_id");
        $data['u_account'] = $userInfo['u_account'];
        $data['pageSize'] = $this->request()->requestAll("length",10);
        $search = $this->request()->requestAll("search");
        $data['keyword'] = $search['value'];
        $start = $this->request()->requestAll("start",0);
        $data['pageNo'] = $start/$data['pageSize']+1;
        $ret = $this->model->getPermissionsListDataTable($data);
        echo json_encode($ret);
    }
    /**
     * 展示小行业报告
     */
    public function showIndustryReport()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $userIndustry = Model::instance('Industry')->getUserIndustry($data);
        $data['cfg_model'] = $this->request()->requestAll("cfg_model");
        $ret = Model::instance('industry')->configList($data);
        $listInfo = $ret['data']['ConfigMaxList'];
        $default = array();
        $level = 4 ;
        if (count($listInfo[0]['ConfigMinList']) > 0) {
            $default['url'] = $listInfo[0]['ConfigMinList'][0]['cfg_url'];
            $default['name'] = $listInfo[0]['ConfigMinList'][0]['cfg_name'];
            $default['pname'] = $listInfo[0]['cfg_name'];
        }
        else {
            $default['url'] = $listInfo[0]['cfg_url'];
            $default['name'] = $listInfo[0]['cfg_name'];
            $default['pname'] = $listInfo[0]['cfg_name'];
            $level = 3 ;
        }
        $data = array(
            "userIndustry" => $userIndustry,
            "listInfo" => $listInfo,
            "default" => $default,
            "pname" => $this->request()->requestAll("pname"),
            "ity_name" => $this->request()->requestAll("ity_name"),
            "level"=>$level
        );
        View::instance('service/showReport.tpl')->show($data);
    }

    /**
     * 服务列表
     */
    public function getAuditList()
    {
        $userInfo = Session::instance()->get('userInfo');
        $postData = [
            'keyword'           => $this->request()->requestAll('keyword'),
            'orderByColumn'     => $this->request()->requestAll('orderByColumn'),
            'orderByType'       => $this->request()->requestAll('orderByType'),
            'pageNo'            => $this->request()->requestAll('pageNo'),
            'pageSize'          => $this->request()->requestAll('pageSize'),
            'token'             => $userInfo['u_token'],
            'u_account'         => $userInfo['u_account']
        ];
        $this->__json();
        echo $this->model->getAuditList($postData);
    }

    /**
     * 服务审核
     */
    public function upAudit()
    {

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

}