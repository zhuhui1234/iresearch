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
            $this->userDetail = json_decode(Model::instance('user')->getUserInfo([
                'token' => $this->userInfo['token'],
                'userID' => $this->userInfo['userID']
            ]),trur);
            $this->userDetail = $this->userDetail['data'];
            if($this->userDetail['permissions'] != 2){
                _ERROR('000001','权限不足');
            }
        } else {
            _ERROR('000002','登录过期');
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
        $data['companyFullNameID'] = $this->userInfo['companyID'];
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
        $data['cpy_id'] = $this->userInfo['companyID'];
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

    public function getUserList()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);
        $data['token'] =  $this->userInfo['token'];
        $data['userID'] = $this->userInfo['userID'];
        echo $this->model->getUserList($data);
    }
}