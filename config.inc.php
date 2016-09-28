<?php
date_default_timezone_set("PRC");
session_set_cookie_params(0);
//基础路径配置
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', dirname(__FILE__) . DS);
define('MODEL', 'model');
define('CONTROLLER', 'controller');
define('VIEW', 'view');
define('LIB', 'lib');
define('COMMON', 'common');
define('PUBLIC', 'public');
define('WIDGET', 'widget');
define('API', 'api');
define('LIB_PATH', ROOT_PATH . LIB . DS);
define('MODEL_PATH', ROOT_PATH . MODEL . DS);
define('CONTROLLER_PATH', ROOT_PATH . CONTROLLER . DS);
define('VIEW_PATH', ROOT_PATH . VIEW . DS);
//微信配置
define('W_APP_ID', 'wxd96928ba062cffec');
define('W_SECRET', 'abbf51a741f7608394727debe1e51b43');
define('WECHAT_API_URL', 'https://api.weixin.qq.com/sns/oauth2/access_token');
define('WECHAT_API_REFRESH_URL', 'https://api.weixin.qq.com/sns/oauth2/refresh_token');
define('WECHAT_API_USERINFO', 'https://api.weixin.qq.com/sns/userinfo');
//站点配置
//	define('WEBSITE','http://localhost');
define('WEBSITE', $_SERVER['SERVER_ADDR']);
define('WEBSITE_URL', '');
define('WEBSITE_SOURCE_URL', WEBSITE_URL . 'dev');
define('WEBSITE_TITLE', '艾瑞数据平台');
define('REGISTER_MAILADDR', 'wanghaiyan@iresearch.com.cn');
define('FORGOTPWD_MAILADDR', 'wanghaiyan@iresearch.com.cn');
//导出报表配置
define('API_URL', 'http://203.156.255.168/iview_deskapi/');
define('API_URL_REPORT', 'http://10.10.21.163/iReport/');
define('EXPORT_PIC', 'http://180.169.19.166/graph_api/chart.php');
//永洪单点登陆地址
define('YH_LOGIN', 'http://203.156.255.149/bi/Viewer?isSSO=true');
define("__PAGENUM__", 10);
//session 前缀
define('SITE_PREFIX', 'idex');
//session 失效时间
define('SESSION_TIME_OUT', false);
//cookie 失效时间
define('COOKIE_TIME_OUT', 7 * 24 * 3600);
//下拉框
define('KEY', '534b44a19bf18d20b71ecc4eb77c572f');
//cookie 域名
define('COOKIE_DOMAIN', '');
//是否开启缓存
define('CACHE_ON', false);
//是否开启调试
define('DEBUG', false || isset($_GET['debug']));
//是否开启测试日志
define('DEBUG_LOG', TRUE);
//define('DEBUG', true);
define('START_TIME', microtime(true));
define('NOW', date('Y-m-d H:i:s'));
if (DEBUG) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL ^ E_NOTICE);

} else {
    error_reporting(0);
}

//是否开启Rewrite
define('REWRITE_ON', false);

define('CHARSET', 'utf-8');

header("Content-type: text/html; charset=" . CHARSET);

//引用类文件
require_once(ROOT_PATH . COMMON . DS . COMMON . '.fun.php');
require_once(ROOT_PATH . COMMON . DS . COMMON . '.request.php');
require_once(ROOT_PATH . COMMON . DS . COMMON . '.session.php');
require_once(ROOT_PATH . COMMON . DS . COMMON . '.response.php');
require_once(ROOT_PATH . COMMON . DS . COMMON . '.cookie.php');
require_once(ROOT_PATH . COMMON . DS . COMMON . '.page.php');
require_once(ROOT_PATH . COMMON . DS . COMMON . '.ajaxpage.php');

require_once(ROOT_PATH . API . DS . API . '.api.php');
require_once(ROOT_PATH . API . DS . API . '.soap.php');

require_once(ROOT_PATH . LIB . DS . LIB . '.model.php');
require_once(ROOT_PATH . LIB . DS . LIB . '.agentmodel.php');
require_once(ROOT_PATH . LIB . DS . LIB . '.controller.php');
require_once(ROOT_PATH . LIB . DS . LIB . '.view.php');

$_request = Request::instance();

$v = $_request->get('v');
if (!empty($v) && in_array($v, array('beta', 'test', 'final'))) {
    define('VERSION', $v); //beta,test,final
} else {
    define('VERSION', 'test');
}
//登录处理
gUid();
//    Session::instance()->set('uid', 1);//游客使用
//$soap = new Soap();
//if (!$soap->isLogin()) {
//    $guid = Session::instance()->get('guid');
//}

//var_dump(isLoginState());
//exit();
if (!isLoginState()
    AND $_GET['a'] != 'login'
    AND $_GET['a'] != 'registerUserInfoAPI'
    AND $_GET['a'] != 'loginAPI'
    AND $_GET['a'] != 'register'
    AND $_GET['a'] != 'authImg'
    AND $_GET['a'] != 'sendMail'
    AND $_GET['a'] != 'registerSendMail'
    AND $_GET['a'] != 'forgotPassword'
) {
        header('Location:?m=user&a=login');
}

