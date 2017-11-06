<?php
/**
 * Created by PhpStorm.
 * User: zh
 * Date: 2017/11/1
 * Time: 11:10
 */

class LicenceModel extends API
{
    public function getLicencesByCompanyFullNameID($data)
    {
        $url = API_URL . '?m=licence&a=getLicencesByCompanyFullNameID';
        $ret = $this->_curlPost($url, $data, 'getLicencesByCompanyFullNameID');
        return $ret;
    }

    public function editLicencesByUserID($data)
    {
        $url = API_URL . '?m=licence&a=editLicencesByUserID';
        $ret = $this->_curlPost($url, $data, 'editLicencesByUserID');
        return $ret;
    }

    public function removeLicencesByLicenceKey($data)
    {
        $url = API_URL . '?m=licence&a=removeLicencesByLicenceKey';
        $ret = $this->_curlPost($url, $data, 'removeLicencesByLicenceKey');
        return $ret;
    }

    public function getPointLogByLicenceKey($data)
    {
        $url = API_URL . '?m=licence&a=getPointLogByLicenceKey';
        $ret = $this->_curlPost($url, $data, 'getPointLogByLicenceKey');
        return $ret;
    }

    public function getUserList($data)
    {
        $url = API_URL . '?m=licence&a=getUserList';
        $ret = $this->_curlPost($url, $data, 'getUserList');
        return $ret;
    }
}