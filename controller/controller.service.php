<?php
/**
 * Copyright © 艾瑞咨询集团(http://www.iresearch.com.cn/)
 * Author DavidWei <davidwei@iresearch.com.cn>
 * Create 16-08-10 14:34
 */
class ServiceController extends Controller
{

    private $model,$userInfo, $loginStatus;

    function __construct()
    {
        $this->model =Model::instance('service');
    }
    function upUserSessionKey()
    {
        $yu = $this->request()->requestAll("guid");
        $res = Model::instance('user')->upUserSessionKey($yu);
    }

    /**
     *　auth code img
     */
    public function authImg()
    {
        $vcodes = '';
        $im = imagecreate(146, 40);
        $back = ImageColorAllocate($im, 245, 245, 245);
        imagefill($im, 0, 0, $back); //背景
        srand((double) microtime() * 1000000);
        //生成4位数字
        for ($i = 0; $i < 5; $i++) {
            $font = ImageColorAllocate($im, rand(100, 255), rand(0, 100), rand(100, 255));
            $authnum = rand(1, 9);
            $vcodes .= $authnum;
            imagestring($im, 5, 35 + $i * 20, 12, $authnum, $font);
        }
        for ($i = 0; $i < 100; $i++) //加入干扰象素
        {
            $randcolor = ImageColorallocate($im, rand(0, 255), rand(44, 255), rand(0, 255));
            imagesetpixel($im, rand(), rand(), $randcolor);
        }
        @ob_clean();
        Header("Content-type: image/PNG");
        ImagePNG($im);
        ImageDestroy($im);
        Session::instance()->set('vcodes',$vcodes);
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
            'state'  => 200,
            'message' => $crop -> getMsg(),
            'result' => $crop -> getResult()
        );

        @@ob_clean();
        echo json_encode($response);
    }

}