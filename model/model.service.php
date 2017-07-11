<?php
/**
 * Created by 艾瑞咨询集团.
 * User: DavidWei
 * Date: 16-8-10
 * Time: 下午3:00
 * Email:davidwei@iresearch.com.cn
 * FileName:model.service.php
 * 描述:
 */
class ServiceModel extends API {

    /**
     * 生成随即字符串
     * @param $length
     * @return string
     */
    function getRandChar($length){
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol)-1;

        for($i=0;$i<$length;$i++){
            $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }
        return $str;
    }

    /**
     * send mail
     *
     * @param $mailContent
     * @param $mailTitle
     * @param $mailType
     * @param $MailTo
     * @param $mailFrom
     * @return mixed
     */
    public function sendMail($mailContent, $mailTitle, $mailType, $MailTo, $mailFrom )
    {
        $url = API_URL . '?m=user&a=mailService';
        $ret = $this->_curlPost($url, array(
            'mailcontent'   => $mailContent,
            'mailtitle'     => $mailTitle,
            'mailtype'      => $mailType,
            'smtpemailto'    => $MailTo,
            'smtpusermail'  => $mailFrom
        ), 'mailService');

        return $ret;
    }

    /**
     * send sms
     */
    public function sendSMS($data)
    {
        $url = API_URL . '?m=User&a=setMobileKey';
        $ret = $this->_curlPost($url, $data, 'setMobileKey');
        return $ret;
    }

    /**
     * 上传图片
     *
     * @param $base64
     * @param string $type
     * @return mixed
     */
    public function uploadImage($token,$base64,$type='png')
    {
        $url = API_URL . '?m=upfile&a=imgs';
        $img = array(
            'token' => $token,
            'filebase64' => $base64,
            'filetype' => $type
        );
//        pr($img);
        $ret = $this->_curlPost($url,$img,'imgs');
        return $ret;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function recordLogs($data)
    {
        $url = API_URL . '?m=logs&a=pushLog';
        $ret = $this->_curlPost($url, $data,'pushLog');
        return $ret;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function xvtSearch($data)
    {
        $url = 'http://localhost/xmpapi/public/api/xvt/search';
        $ret = $this->_curlPost($url, json_decode($data,true), 'search');
        return $ret;
    }
}