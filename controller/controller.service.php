<?php
/**
 * Copyright © 艾瑞咨询集团(http://www.iresearch.com.cn/)
 * Author DavidWei <davidwei@iresearch.com.cn>
 * Create 16-08-10 14:34
 */

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

class ServiceController extends Controller
{

    private $model, $userInfo, $loginStatus;

    public function __construct()
    {
        $this->model = Model::instance('service');
    }

    public function upUserSessionKey()
    {
        $yu = $this->request()->requestAll("guid");
        $res = Model::instance('user')->upUserSessionKey($yu);
    }

    /**
     * send sms
     */
    public function sendSMS()
    {
        $data = ['Mobile' => $this->request()->post('mobile')];
        jsonHead();
        echo $this->model->sendSMS($data);
    }

    /**
     * send verify code for irv  by yun pian text service
     */
    public function sendCode()
    {

        $data = [
            'Mobile' => $this->request()->post('mobile'),
            'LoginType' => $this->request()->post('login_type'),
            'Mail' => $this->request()->post('email'),
            'CountryCode' => $this->request()->post('country_code')
        ];

        $vcode = $this->request()->post('vCode');
        $getVcode = Session::instance()->get('vcodes');
        if (empty($vcode)) {
            _ERROR('000001', '验证码不能为空');
        }

        switch ($data['LoginType']) {
            case 'mobile':
                if (empty($data['Mobile'])) {
                    _ERROR('000001', '手机号不能为空');
                }
                break;
            case 'mail':
                if (empty($data['Mail'])) {
                    _ERROR('000001', '邮箱不能为空');
                }
                break;
            default:
                _ERROR('0000001', '没有获取到登入方式数据');
                break;
        }

        if ($vcode == $getVcode) {
            jsonHead();
            echo $this->model->sendCode($data);
        } else {
            _ERROR('000001', '图形验证码不正确');
        }

    }

    /**
     * ird send sms
     */
    public function irdSendSms()
    {
        $data = ['Mobile' => $this->request()->post('mobile')];
        jsonHead();
        echo $this->model->sendSMS($data);
    }

    public function sendSMSForMobile()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        jsonHead();
        echo $this->model->sendSMS(['Mobile' => $data['mobile']]);
    }

    /**
     * 跳转kol产品
     */
    public function toKol()
    {
        $user = "tableau";
        $rkey = $user . $user . date('YmdH');
        $key = strtoupper(md5($rkey, false));
        $url = "http://vfckol.iresearchdata.cn/urlRedirect.ashx?u={$user}&e={$user}&ukey={$key}";
        if ($_GET['test'] == 'yes') {
            echo "http://115.239.229.242:8010/urlRedirect.ashx?u={$user}&e={$user}&ukey={$key}";
            echo "<br />";
            echo $url;
            exit();
        }
        header("Location: " . $url);
    }

    public function vfcLogin()
    {
        $data = array();
        View::instance('service/iadtLogin.tpl')->show($data);
    }

    /**
     * 跳转至产品iadt
     */
    public function toiAdT()
    {
        //$data['mail'] = "davidwei@iresearch.com.cn";
        //$data['pwd'] = "weiwei";
        $data['mail'] = $this->request()->post('mail');
        $data['pwd'] = $this->request()->post('pwd');
        $data = json_encode($data);
        $res = json_decode(Model::instance('user')->__getIResearchDataAccount($data), true);

        if ($res['iUserID'] == '-1') {
            echo "<script>alert('登录失败!');history.go(-1)</script>";

        } else {
            $guid = $res['iRGuid'];
            $url = "http://vfc-iadt.iresearchdata.cn/ws_login.aspx?ProductSelection=ProductSelection&guid=" . $guid;
            header("Location: " . $url);
        }
    }

    public function vfcLogin2()
    {
        $data = array();
        View::instance('service/madtLogin.tpl')->show($data);
    }

    /**
     * 跳转至产品iadt
     */
    public function toiAdT2()
    {
        //$data['mail'] = "davidwei@iresearch.com.cn";
        //$data['pwd'] = "weiwei";
        $data['mail'] = $this->request()->post('mail');
        $data['pwd'] = $this->request()->post('pwd');
        $data = json_encode($data);
        $res = json_decode(Model::instance('user')->__getIResearchDataAccount($data), true);

        if ($res['iUserID'] == '-1') {
            echo "<script>alert('登录失败!');history.go(-1)</script>";

        } else {
            $guid = $res['iRGuid'];
            $url = "http://vfc-madt.iresearchdata.cn/ws_login.aspx?ProductSelection=ProductSelection&guid=" . $guid;
            header("Location: " . $url);
        }
    }

    /**
     *　auth code img
     */
    public function authImg()
    {
        $vcodes = '';
        $im = imagecreate(100, 40);
        $back = ImageColorAllocate($im, 245, 245, 245);
        imagefill($im, 0, 1, $back); //背景
        srand((double)microtime() * 1000000);
        //生成4位数字
        $co = 4;
        for ($i = 0; $i < $co; $i++) {
            $font = ImageColorAllocate($im, rand(100, 255), rand(0, 100), rand(100, 255));
            $authnum = rand(1, 9);
            $vcodes .= $authnum;
            imagestring($im, $co, 20 + $i * 20, 12, $authnum, $font);
        }
        for ($i = 0; $i < 100; $i++) //加入干扰象素
        {
            $randcolor = ImageColorallocate($im, rand(5, 255), rand(44, 255), rand(10, 255));
            imagesetpixel($im, rand(), rand(), $randcolor);
        }
        @ob_clean();
        Header("Content-type: image/PNG");
        ImagePNG($im);
        ImageDestroy($im);
        Session::instance()->set('vcodes', $vcodes);
        write_to_log('check vcodes: ' . Session::instance()->get('vcodes'), '_session');
        write_to_log('set Session vcodes: ' . $vcodes, '_session');
    }

    /**
     * crop avatar
     */
    public function cropAvatar()
    {
        $data = $this->request()->requestAll();
        $crop = new CropAvatar(
            isset($data['avatar_src']) ? $data['avatar_src'] : null,
            isset($data['avatar_data']) ? $data['avatar_data'] : null,
            isset($_FILES['avatar_file']) ? $_FILES['avatar_file'] : null
        );
        $response = array(
            'state' => 200,
            'message' => $crop->getMsg(),
            'result' => $crop->getResult()
        );

        @@ob_clean();
        echo json_encode($response);
    }

    public function charCode()
    {

        $img = $this->request()->requestAll();

        if (empty($img['weight'])) {
            $img['weight'] = 4;
        }

        if (empty($img['width'])) {
            $img['width'] = 100;
        }

        if (empty($img['height'])) {
            $img['height'] = 34;
        }
        header('Content-type: image/jpeg');
        $builder = new CaptchaBuilder((int)$img['weight']);
        Session::instance()->set('vcodes', $builder->getPhrase());
        $builder->setBackgroundColor(255, 255, 255);
        $builder->build($img['width'], $img['height']);
        $builder->output();

    }

}