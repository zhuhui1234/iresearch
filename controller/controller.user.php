<?php
/**
 * Created by 艾瑞咨询集团.
 * User: DavidWei
 * Date: 16-8-10
 * Time: 下午4:08
 * Email:davidwei@iresearch.com.cn
 * FileName:controller.user.php
 * 描述:
 */
class UserController extends Controller
{

    private $model;

    function __construct()
    {
        $this->model =Model::instance('user');
    }

    /**
     *
     */
    function upUserSessionKey()
    {
        $yu = $this->request()->requestAll("yu");
        $res = $this->model->upUserSessionKey($yu);
        $this->success($res);
    }

}