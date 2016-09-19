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
        print_r($ret);
    }

    function getConfigListAPI()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $data['cfg_model'] = 7;
        $ret = $this->model->configList($data);
        print_r($ret);
    }

    function getUserIndustry()
    {
        $userInfo = Session::instance()->get('userInfo');
        $data['token'] = $userInfo['u_token'];
        $ret = $this->model->getUserIndustry($data);
    }
}