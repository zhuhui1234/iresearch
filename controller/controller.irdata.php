<?php

/**
 * Created by PhpStorm.
 * User: robinwong51
 * Date: 03/01/2017
 * Time: 5:34 PM
 */
class IRDataController extends Controller
{
    private $userModel, $irdUserInfo, $userInfo;

    function __construct($classname)
    {
        $this->userModel = Model::instance('User');
        $this->userInfo = Session::instance()->get('userInfo');
        if (!empty($this->userInfo['productKey'])) {
            if (time() > Session::instance()->get('irdTimeOut') || empty(Session::instance()->get('irdTimeOut'))) {
                $this->userModel->getIResearchDataAccount($this->userInfo['productKey']);
            }

            $this->irdUserInfo = json_decode(Session::instance()->get('iResearchDataUserInfo'), true);
        }
    }

    public function classicSys()
    {

        if (!empty($this->userInfo['productKey'])) {
            $ppname = $this->request()->get('ppname');
            $stat = false;
            $data = [];
            if (DEBUG) {
//                pr($this->userInfo);
                var_dump($this->irdUserInfo);
            }

            foreach ($this->irdUserInfo['pplist'] as $p) {
                if ($p['ppname'] == $ppname) {
                    $data['ppurl'] = $p['ppurl'] . '?guid=' . $this->irdUserInfo['iRGuid'];
                    $stat = true;
                }
            }
            if ($stat) {
                View::instance('service/ird.tpl')->show($data);
            } else {
                $this->errorPage('你并没有权限访问该模块功能');
            }
        } else {
            $this->errorPage('你并没有权限访问该模块功能');
        }

    }

    public function errorPage($msg)
    {
        $data = ['message' => $msg];
        View::instance('index/error.tpl')->show($data);
    }

    private function menuDictionary()
    {

    }

}