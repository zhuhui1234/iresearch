<?php
/**
 * Created by PhpStorm.
 * manager API
 * User: robinwong51
 * Date: 01/11/2017
 * Time: 10:59 AM
 */

class ManagerController extends Controller
{
    private $userInfo, $model, $loginStatus;

    public function __construct($classname)
    {
        parent::__construct($classname);

        $this->userInfo = Session::instance()->get('userInfo');

        $this->loginStatus = !empty($this->userInfo);

        if ((int)$this->userInfo['permissions'] !== 2 or !$this->loginStatus) {
            _ERROR('000001', '无权限访问接口');
        }
        $this->model = Model::instance('manager');
    }

    public function addMyEmployee()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $data['cpy_id'] = $this->userInfo['companyID'];
        $data['token'] = $this->userInfo['token'];
        $data['userID'] = $this->userInfo['userID'];
        if (empty($data['mobile'])) {
            _ERROR('000001', '没有手机号');
        }

//        if (empty($data['mobile_key'])) {
//            _ERROR('000001', '缺少验证码');
//        }

        $this->__json();
        echo $this->model->addMyEmployee($data);

    }

    public function removeEmployee()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $data['userID'] = $this->userInfo['userID'];
        $data['token'] = $this->userInfo['token'];
        $this->__json();
        $data['lic_author_uid'] = $this->userInfo['userID'];
        echo $this->model->removeEmployee($data);

    }

    public function employeeList()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $data['userID'] = $this->userInfo['userID'];
        $data['token'] = $this->userInfo['token'];
        $this->__json();
        echo $this->model->employeeList($data);
    }

    public function updateMyEmployee()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        //@todo:check data
        $data['toUserID'] = $data['userID'];
        $data['userID'] = $this->userInfo['userID'];
        $data['token'] = $this->userInfo['token'];
        $this->__json();
        echo $this->model->updateMyEmployee($data);
    }

    public function sendKey()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $data['token'] = $this->userInfo['token'];
        $data['userID'] = $this->userInfo['userID'];
        $this->__json();
        echo $this->model->sendKey($data);
    }

    public function test()
    {
        $this->__json();
        echo json_encode($this->userInfo);
    }

    public function getProductList()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $data['cpy_id'] = $this->userInfo['companyID'];
        $data['token'] = $this->userInfo['token'];
        $data['userID'] = $this->userInfo['userID'];
        $this->__json();
        echo $this->model->getProductList($data);
    }

    /**
     * allot point
     */
    public function allotPointToUser()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data)) {
            _ERROR('000001', '数据不能为空');
        }

        if (empty($data['userID']) or empty($data['point_value'])) {
            _ERROR('000001', '缺少参数');
        }
        $data['cpy_id'] = $this->userInfo['companyID'];
        $data['token'] = $this->userInfo['token'];
        $data['author'] = $this->userInfo['userID'];
        echo $this->model->allotUser($data);
    }

    /**
     * put back point
     */
    public function putBackPointToCompany()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data)) {
            _ERROR('000001', '数据不能为空');
        }

        if (empty($data['userID']) or empty($data['point_value'])) {
            _ERROR('000001', '缺少参数');
        }

        $data['cpy_id'] = $this->userInfo['companyID'];
        $data['token'] = $this->userInfo['token'];
        $data['author'] = $this->userInfo['userID'];
        echo $this->model->putBackPointToCompany($data);
    }

    /**
     * point history list for company
     */
    public function pointListCompany()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $data['cpy_id'] = $this->userInfo['companyID'];
        $data['token'] = $this->userInfo['token'];
        $data['author'] = $this->userInfo['userID'];

        echo $this->model->pointListCompany($data);

    }

    public function computePointForCompany()
    {
        if (empty($this->userInfo['companyID'])) {
            _ERROR('000001','缺少参数');
        }
        $data['cpy_id'] = $this->userInfo['companyID'];
        $data['TOKEN'] = $this->userInfo['token'];
        echo $this->model->computePointForCompany($data);
    }

    ######################################################################################
    ##################################                     ###############################
    #################################   PRIVATE METHODS   ################################
    ################################                     #################################
    ######################################################################################

    /**
     * send mail
     *
     * @param $mailContent
     * @param $mailTitle
     * @param $mailType
     * @param $MailTo
     * @param $mailFrom
     *
     * @return mixed
     */
    private function __sendMail($mailContent, $mailTitle, $mailType, $MailTo, $mailFrom)
    {
        $service = Model::instance('Service');
        return $service->sendmail($mailContent, $mailTitle, $mailType, $MailTo, $mailFrom);
    }

    /**
     * trans to  json
     */
    private function __json()
    {
        if (!DEBUG) {
            @@ob_clean();
            header('Content-type: application/json;charset=utf-8');
            header('Content-Encoding: utf-8');
        }
    }

}