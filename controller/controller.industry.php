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

    function __construct()
    {
        $this->model = Model::instance('Industry');
    }

    function getMaxIndustryAPI()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $ret = $this->model->industryMaxList($data);
        print_r($ret);
    }

    function getMinIndustryAPI()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $data['ity_sid'] = $this->request()->requestAll("ity_sid");
        $ret = $this->model->industryMinList($data);
        $this->success($ret);
    }

    function getConfigListAPI()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $data['cfg_model'] = 7;
        $ret = $this->model->configList($data);
        print_r($ret);
    }

    function getConfigListJsonAPI()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $data['cfg_model'] = $this->request()->requestAll("cfg_id");
        $ret = $this->model->configListJson($data);
        $this->success($ret);
    }

    function getUserIndustry()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $ret = $this->model->getUserIndustry($data);
    }
    function getPermissionsListAPI(){
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $data['cfg_id'] = 4;
        $data['u_account'] = $userInfo['u_account'];
        $ret = $this->model->getPermissionsList($data);
    }
    /**
     * 展示小行业报告
     */
    function showIndustryReport()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $userIndustry = Model::instance('Industry')->getUserIndustry($data);
        $data['cfg_model'] = $this->request()->requestAll("cfg_model");
        $ret = Model::instance('industry')->configList($data);
        $listInfo = $ret['data']['ConfigMaxList'];
        $default = array();
        if (count($listInfo) > 0) {
            $default['url'] = $listInfo[0]['ConfigMinList'][0]['cfg_url'];
            $default['name'] = $listInfo[0]['ConfigMinList'][0]['cfg_name'];
            $default['pname'] = $listInfo[0]['cfg_name'];
        }
        $data = array(
            "userIndustry" => $userIndustry,
            "listInfo" => $listInfo,
            "default" => $default,
            "pname" => $this->request()->requestAll("pname"),
            "ity_name" => $this->request()->requestAll("ity_name")
        );
        View::instance('service/showReport.tpl')->show($data);
    }
}