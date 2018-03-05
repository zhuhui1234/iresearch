<?php
/**
 * Created by PhpStorm.
 * User: robinwong51
 * Date: 01/11/2017
 * Time: 1:48 PM
 */

class ManagerModel extends API
{

    public function __construct()
    {
    }

    public function employeeList($data)
    {
        $url = API_URL . '?m=user&a=userList';
        $ret = $this->_curlPost($url, $data, 'userList');
        return $ret;
    }

    public function addMyEmployee($data)
    {
        $url = API_URL . '?m=user&a=addMyEmployee';
        $ret = $this->_curlPost($url, $data, 'addMyEmployee');
        return $ret;
    }

    public function removeEmployee($data)
    {
        $url = API_URL . '?m=user&a=removeUser';
        $ret = $this->_curlPost($url, $data, 'removeUser');
        return $ret;
    }

    public function updateMyEmployee($data)
    {
        $url = API_URL . '?m=user&a=editUserInfo';
        $ret = $this->_curlPost($url, $data, 'editUserInfo');
        return $ret;
    }

    public function sendKey($data)
    {
        $url = API_URL . '?m=user&a=sendKey';
        $ret = $this->_curlPost($url, $data, 'sendKey');
        return $ret;
    }

    public function getProductList($data)
    {
        $url = API_URL . '?m=user&a=getProductList';
        $ret = $this->_curlPost($url, $data, 'getProductList');
        return $ret;
    }

    public function allotUser($data)
    {
        $url = API_URL . '?m=points&a=allotUser';
        $ret = $this->_curlPost($url, $data, 'allotUser');
        return $ret;
    }

    public function putBackPointToCompany($data)
    {
        $url = API_URL . '?m=points&a=putBackPointToCompany';
        $ret = $this->_curlPost($url, $data, 'allotUser');
        return $ret;
    }

    public function pointListCompany($data)
    {
        $url = API_URL . '?m=points&a=getPointListCompany';
        $ret = $this->_curlPost($url, $data, 'getPointListCompany');
        return $ret;
    }

    public function computePointForCompany($data)
    {
        $url = API_URL . '?m=points&a=getCompanyPoint';
        $ret = $this->_curlPost($url, $data, 'getCompanyPoint');
        return $ret;
    }
}