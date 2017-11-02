<?php
/**
 * Created by PhpStorm.
 * User: zh
 * Date: 2017/11/1
 * Time: 11:09
 */

class LicenceController extends Controller
{

    private $model, $userInfo;

    function __construct($className)
    {
        parent::__construct($className);
        $this->model = Model::instance('licence');
        $this->userInfo = Session::instance()->get('userInfo');
        if (!empty($this->userInfo)) {
            $this->userDetail = json_decode($this->model->getUserInfo([
                'token' => $this->userInfo['token'],
                'userID' => $this->userInfo['userID']
            ]),trur);
            $this->userDetail = $this->userDetail['data'];
            if($this->userDetail['permissions'] != 2){
                echo json_encode(['resCode' => '000001', 'resMsg' =>'权限不足'],JSON_UNESCAPED_UNICODE);
            }
        } else {
            echo json_encode(['resCode' => '000002', 'resMsg' =>'登陆过期'],JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * 获取公司下所有许可证
     */
    public function getLicencesByCompanyFullNameID()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);
        $data['token'] =  $this->userInfo['token'];
        $data['userID'] = $this->userInfo['userID'];
        $data['companyFullNameID'] = $this->userInfo['compamyID'];
        echo $this->model->getLicencesByCompanyFullNameID($data);
    }

    /**
     * 修改许可证
     */
    public function editLicencesByUserID()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);
        $data['token'] =  $this->userInfo['token'];
        $data['userID'] = $this->userInfo['userID'];
        echo $this->model->editLicencesByUserID($data);
    }

    /**
     * 移除许可证
     */
    public function removeLicencesByLicenceKey()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);
        $data['token'] =  $this->userInfo['token'];
        $data['userID'] = $this->userInfo['userID'];
        echo $this->model->removeLicencesByLicenceKey($data);
    }

    /**
     * 积分列表
     */
    public function getPointLogByLicenceKey()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);
        $data['token'] =  $this->userInfo['token'];
        $data['userID'] = $this->userInfo['userID'];
        echo $this->model->getPointLogByLicenceKey($data);
    }
}