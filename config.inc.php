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
//uploads
define('UPLOAD_PATH', ROOT_PATH . 'uploads' . DS);
//微信配置
define('W_APP_ID', 'wxd96928ba062cffec');
define('W_SECRET', 'e1a9095ff1f80f847be962a3f6696dd6');
define('WECHAT_API_URL', 'https://api.weixin.qq.com/sns/oauth2/access_token');
define('WECHAT_API_REFRESH_URL', 'https://api.weixin.qq.com/sns/oauth2/refresh_token');
define('WECHAT_API_USERINFO', 'https://api.weixin.qq.com/sns/userinfo');
//REDIS SERVER
define('REDIS_STATUS', TRUE);
define('REDIS_SERVER', '127.0.0.1');
define('REDIS_SRV_PORT', 6379);
define('REDIS_TIME_OUT', 1800);
define('REDIS_PREFIX', '_irv_');
define('REDIS_DB', 2);
//    define('REDIS_PWD','!QAZ@WSX');
define('REDIS_PWD', FALSE);
//站点配置
//	define('WEBSITE','http://localhost');
define('WEBSITE', $_SERVER['SERVER_ADDR']);
define('WEBSITE_URL', '');
define('IDATA_URL', 'http://irv.iresearch.com.cn/iResearchDataWeb/');
define('WEBSITE_SOURCE_URL', WEBSITE_URL . 'dev');
define('WEBSITE_TITLE', '艾瑞数据平台');
define('REGISTER_MAILADDR', 'irv@iresearch.com.cn');
define('FORGOTPWD_MAILADDR', 'irv@iresearch.com.cn');
//导出报表配
//define('API_URL', 'http://180.169.19.208/iview_deskapi/');
define('API_URL', 'http://localhost/idata_deskapi/');
//define('API_URL', 'http://42.159.231.97/idata_deskapi3/');
//define('IMG_URL', 'http://203.156.255.168/iview_deskapi/');
define('IMG_URL', 'http://localhost/idata_deskapi_new/');
define('IMG_URL_LOAD', 'http://localhost/idata_deskapi_new/');
define('API_URL_REPORT', 'http://10.10.21.163/iReport/');
define('EXPORT_PIC', 'http://180.169.19.166/graph_api/chart.php');
//define('KOL_API', 'http://kolweb.simplybrand.com/urlRedirect.ashx');
//define('KOL_API', 'http://vfckol.iresearchdata.cn/urlRedirect.ashx');
define('KOL_API', '//irv-ikol.iresearch.com.cn/urlRedirect.ashx');
//报表地址
define('YH_REPORT', '//irv.iresearch.com.cn/iReportBeta/?m=service&a=showReportIRV');
//define('YH_REPORT', '//irv.iresearch.com.cn/iReport/?m=service&a=showReportIRV');
define('YH_REPORT71', '//irv.iresearch.com.cn/iReport/?m=service&a=irv');
define('YH_REPORT37', '//irv.iresearch.com.cn/iReport/?m=service&a=irvApp');
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

define('ADT_URL', 'http://irv.iresearch.com.cn/iResearchDataWeb/?m=index&a=xadt');
define('VT_URL', 'http://irv.iresearch.com.cn/iResearchDataWeb/?m=index&a=xvt');
define('UT_URL', 'http://irv.iresearch.com.cn/iResearchDataWeb/?m=index&a=xut');

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
require_once(ROOT_PATH . COMMON . DS . COMMON . '.cropavatar.php');
require_once(ROOT_PATH . COMMON . DS . COMMON . '.cache.php');

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
if (!isLoginState()
    AND $_GET['a'] != 'login'
    AND $_GET['a'] != 'registerUserInfoAPI'
    AND $_GET['a'] != 'registerUserInfo'
    AND $_GET['a'] != 'loginAPI'
    AND $_GET['a'] != 'register'
    AND $_GET['a'] != 'authImg'
    AND $_GET['a'] != 'sendMail'
    AND $_GET['a'] != 'registerSendMail'
    AND $_GET['a'] != 'forgotPassword'
    AND $_GET['a'] != 'wxLoginAPI'
    AND $_GET['a'] != 'sendSMS'
    AND $_GET['a'] != 'BindingWeChat'
    AND $_GET['a'] != 'toKol'
    AND $_GET['a'] != 'toiAdT'
    AND $_GET['a'] != 'vfcLogin'
    AND $_GET['a'] != 'toiAdT2'
    AND $_GET['a'] != 'vfcLogin2'
    AND $_GET['a'] != 'jump'
    AND $_GET['a'] != 'showMenu'
    AND $_GET['a'] != 'mobileLoginAPI'
    AND $_GET['a'] != 'sendSMSForMobile'
    AND $_GET['a'] != 'xvtSearch'
    AND $_GET['a'] != 'xvt'
    AND $_GET['a'] != 'xut'
    AND $_GET['a'] != 'ad'
    AND $_GET['a'] != 'xvtSearchAPI'
    AND $_GET['a'] != 'classicSys'
    AND $_GET['a'] != 'checkMail'
    AND $_GET['a'] != 'ircJump'
    AND $_GET['a'] != 'test'
) {

    if ($_GET['a'] != '' && $_GET['m'] != '') {
        echo("<SCRIPT LANGUAGE=\"JavaScript\">
        alert(\"登录超时,请重新登录\");
        window.location.href=\"?m=user&a=login&expired=1\";
        </SCRIPT>");
    } else {
        echo("<SCRIPT LANGUAGE=\"JavaScript\">
        window.location.href=\"?m=user&a=login&expired=1\";
        </SCRIPT>");
    }

}

