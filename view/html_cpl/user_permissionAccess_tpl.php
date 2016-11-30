<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <!-- IE 兼容模式 -->
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- 国产浏览器高速模式 -->
    <meta name="renderer" content="webkit">
    <!-- bootstrap核心样式 -->
    <link href="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/css/app.css" rel="stylesheet">
    <!-- 自定义 -->
    <link href="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/css/docs.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed bootsnav">
    <div class="container-fluid">
        <!-- Start Atribute Navigation -->
        <div class="attr-nav">
            <?php
if (!empty($_obj['loginStatus'])){
?>
            <ul>
                <li class="attr-btn">
                    <a href="" data-toggle="modal" data-target="#login">登录</a>
                </li>
                <li class="attr-btn">
                    <a href="?m=user&a=register">注册</a>
                </li>
            </ul>
            <?php
} else {
?>
            <ul>
                <!-- <li>
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="搜索">
                        <i class="iconfont icon-my-search"></i>
                    </a>
                </li>
                <li>
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="消息">
                        <i class="iconfont icon-my-msg"></i>
                        <span class="badge">3</span>
                    </a>
                </li> -->
                <li>
                    <a href="?m=user&a=editUserInfo" data-toggle="tooltip" data-placement="bottom" title="个人中心">
                        <i class="iconfont icon-my-user"></i>
                    </a>
                </li>
                <li>
                    <a href="?m=user&a=loginOut" data-toggle="tooltip" data-placement="bottom" title="退出登录">
                        <i class="iconfont icon-my-logout"></i>
                    </a>
                </li>
            </ul>
            <?php
}
?>
        </div>
        <!-- End Atribute Navigation -->
        <!-- Start Header Navigation -->
        <div class="navbar-header">
            <a class="navbar-brand" href="?"><img src="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/img/irv_logo.png" class="logo" alt=""></a>
        </div>
        <!-- End Header Navigation -->
        <!-- Collect the nav links, forms, and other content for toggling -->
        <ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp">
            <li class="dropdown megamenu-sw">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="left-icon">
                            <i class="iconfont icon-my-nenu"></i>
                        </span>
                    <span class="right-text">
                            <b>行业导航</b>
                            <i>Ind. Map</i>
                        </span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">公司名录</a></li>
                    <li><a href="#">产品名录</a></li>
                    <li><a href="#">网站名录</a></li>
                </ul>
            </li>
            <li class="dropdown megamenu-fw">
                <a href="ui.html" class="dropdown-toggle" data-toggle="dropdown">
                           <span class="left-icon">
                            <i class="iconfont icon-my-chart"></i>
                        </span>
                    <span class="right-text">
                            <b>行业研究</b>
                            <i>Ind. Research</i>
                        </span>
                </a>
                <ul class="dropdown-menu megamenu-content" role="menu">
                    <li>
                        <div class="row">
                            <div class="col-menu col-xs-6">
                                <div class="content">
                                    <ul class="menu-col menu-tabs">
                                        <?php
if (!empty($_obj['userIndustry']['max'])){
if (!is_array($_obj['userIndustry']['max']))
$_obj['userIndustry']['max']=array(array('max'=>$_obj['userIndustry']['max']));
$_tmp_arr_keys=array_keys($_obj['userIndustry']['max']);
if ($_tmp_arr_keys[0]!='0')
$_obj['userIndustry']['max']=array(0=>$_obj['userIndustry']['max']);
$_stack[$_stack_cnt++]=$_obj;
foreach ($_obj['userIndustry']['max'] as $rowcnt=>$max) {
$max['ROWCNT']=$rowcnt;
$max['ROWNUM']=$rowcnt+1;
$max['ALTROW']=$rowcnt%2;
$max['ROWBIT']=$rowcnt%2;
$_obj=&$max;
?>
                                        <li><a href="#tab<?php
echo $_obj['ity_id'];
?>
" data-toggle="tab" data-hover="tab"><?php
echo $_obj['ity_name'];
?>
</a>
                                        </li>
                                        <?php
}
$_obj=$_stack[--$_stack_cnt];}
?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-menu col-xs-6">
                                <div class="tab-content">
                                    <?php
if (!empty($_obj['userIndustry']['min'])){
if (!is_array($_obj['userIndustry']['min']))
$_obj['userIndustry']['min']=array(array('min'=>$_obj['userIndustry']['min']));
$_tmp_arr_keys=array_keys($_obj['userIndustry']['min']);
if ($_tmp_arr_keys[0]!='0')
$_obj['userIndustry']['min']=array(0=>$_obj['userIndustry']['min']);
$_stack[$_stack_cnt++]=$_obj;
foreach ($_obj['userIndustry']['min'] as $rowcnt=>$min) {
$min['ROWCNT']=$rowcnt;
$min['ROWNUM']=$rowcnt+1;
$min['ALTROW']=$rowcnt%2;
$min['ROWBIT']=$rowcnt%2;
$_obj=&$min;
?>
                                    <div class="tab-pane" id="tab<?php
echo $_obj['pid'];
?>
">
                                        <div class="content">
                                            <ul class="menu-col">
                                                <?php
if (!empty($_obj['info'])){
if (!is_array($_obj['info']))
$_obj['info']=array(array('info'=>$_obj['info']));
$_tmp_arr_keys=array_keys($_obj['info']);
if ($_tmp_arr_keys[0]!='0')
$_obj['info']=array(0=>$_obj['info']);
$_stack[$_stack_cnt++]=$_obj;
foreach ($_obj['info'] as $rowcnt=>$info) {
$info['ROWCNT']=$rowcnt;
$info['ROWNUM']=$rowcnt+1;
$info['ALTROW']=$rowcnt%2;
$info['ROWBIT']=$rowcnt%2;
$_obj=&$info;
?>
                                                <?php
if ($_obj['ity_name'] == "暂无数据"){
?>
                                                <li>
                                                    <a href="#"><?php
echo $_obj['ity_name'];
?>
</a>
                                                </li>
                                                <?php
} else {
?>
                                                <li>
                                                    <a href="?m=industry&a=showIndustryReport&cfg_model=<?php
echo $_obj['ity_id'];
?>
&ity_name=<?php
echo $_obj['ity_name'];
?>
&pname=<?php
echo $_obj['pname'];
?>
"><?php
echo $_obj['ity_name'];
?>
</a>
                                                </li>
                                                <?php
}
?>

                                                <?php
}
$_obj=$_stack[--$_stack_cnt];}
?>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php
}
$_obj=$_stack[--$_stack_cnt];}
?>
                                </div>

                            </div>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="dropdown megamenu-sw">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <span class="left-icon">
                            <i class="iconfont icon-my-tools"></i>
                        </span>
                    <span class="right-text">
                            <b>数据工具</b>
                            <i>Data Tools</i>
                        </span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">营销优化工具</a></li>
                    <li><a href="#">产品运营工具</a></li>
                </ul>
            </li>
            <li class="dropdown megamenu-sw">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <span class="left-icon">
                            <i class="iconfont icon-my-news"></i>
                        </span>
                    <span class="right-text">
                            <b>行业资讯</b>
                            <i>Ind. Information</i>
                        </span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">行业动态</a></li>
                    <li><a href="#">新媒体推荐</a></li>
                    <li><a href="#">案例分享</a></li>
                    <li><a href="#">招标公告</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<div class="left-menu">
    <a href="#" class="active">
        <i></i>
        <i></i>
        <i></i>
    </a>
</div>
<div class="sidebar show">
    <div class="user-info">
        <img src="<?php
echo $_obj['u_head'];
?>
" alt="" class="img-circle img-responsive">
        <p><?php
echo $_obj['u_name'];
?>
</p>
        <span class="btn btn-warning btn-xs">管理员</span>
    </div>
    <ul>
    <li id="sidebar_userInfo">
        <a href="?m=user&a=editUserInfo">个人资料</a>
    </li>

    <li id="sidebar_userManager" >
        <a href="?m=user&a=usermanger">用户管理</a>
    </li>
    <li id="sidebar_permissionAccess">
        <a href="?m=user&a=permissionAccess">权限分配管理</a>
    </li>
    <li id="sidebar_applyManager">
        <a href="?m=user&a=applyManager">申请管理<!-- <span class="badge pull-right">3</span> --></a>
    </li>
    <li id="sidebar_actionLog">
        <a href="?m=user&a=actionlog">操作日志</a>
    </li>
    <li id="sidebar_setSafe">
        <a href="?m=user&a=setsafe">安全设置</a>
    </li>
    <li id="sidebar_logout">
        <a href="?m=user&a=loginOut">退出登录</a>
    </li>
</ul>
</div>

<div class="wrap active">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="active">权限分配管理</li>
        </ol>
        <div class="row">
            <div class="col-xs-4">
                <div class="allocated_left">
                    <div class="input-group mbm">
                        <select class="form-control" data-toggle="select" id="bigIndustry">
                            <?php
if (!empty($_obj['bigIndustry'])){
if (!is_array($_obj['bigIndustry']))
$_obj['bigIndustry']=array(array('bigIndustry'=>$_obj['bigIndustry']));
$_tmp_arr_keys=array_keys($_obj['bigIndustry']);
if ($_tmp_arr_keys[0]!='0')
$_obj['bigIndustry']=array(0=>$_obj['bigIndustry']);
$_stack[$_stack_cnt++]=$_obj;
foreach ($_obj['bigIndustry'] as $rowcnt=>$bigIndustry) {
$bigIndustry['ROWCNT']=$rowcnt;
$bigIndustry['ROWNUM']=$rowcnt+1;
$bigIndustry['ALTROW']=$rowcnt%2;
$bigIndustry['ROWBIT']=$rowcnt%2;
$_obj=&$bigIndustry;
?>
                            <option value="<?php
echo $_obj['ity_id'];
?>
"><?php
echo $_obj['ity_name'];
?>
</option>
                            <?php
}
$_obj=$_stack[--$_stack_cnt];}
?>
                        </select>
                    </div>
                    <div class="input-group mbm">
                        <select class="form-control" data-toggle="select" id="smallIndustry">
                            <?php
if (!empty($_obj['smallIndustry'])){
if (!is_array($_obj['smallIndustry']))
$_obj['smallIndustry']=array(array('smallIndustry'=>$_obj['smallIndustry']));
$_tmp_arr_keys=array_keys($_obj['smallIndustry']);
if ($_tmp_arr_keys[0]!='0')
$_obj['smallIndustry']=array(0=>$_obj['smallIndustry']);
$_stack[$_stack_cnt++]=$_obj;
foreach ($_obj['smallIndustry'] as $rowcnt=>$smallIndustry) {
$smallIndustry['ROWCNT']=$rowcnt;
$smallIndustry['ROWNUM']=$rowcnt+1;
$smallIndustry['ALTROW']=$rowcnt%2;
$smallIndustry['ROWBIT']=$rowcnt%2;
$_obj=&$smallIndustry;
?>
                            <option value="<?php
echo $_obj['ity_id'];
?>
"><?php
echo $_obj['ity_name'];
?>
</option>
                            <?php
}
$_obj=$_stack[--$_stack_cnt];}
?>
                        </select>
                    </div>
                    <div id="treeview" class=""></div>
                </div>
            </div>
            <div class="col-xs-8">
                <h5 class="mtl">权限设置</h5>
                <div class="manage-menu">
                    <form class="form-inline" role="form">
                        <div class="radio">
                            <label>
                                <input type="radio" name="setAll"  value="_p_yes" data-toggle="radio">
                                全有权限
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="setAll" value="_p_no" data-toggle="radio">
                                全无权限
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="setAll" value="_p_hidden" data-toggle="radio">
                                全隐藏
                            </label>
                        </div>
                        <div class="manage-menu-span">
                            <span>预设权限数: 10个</span>
                            <span>已有权限： 5个</span>
                            <span>剩余权限：5个</span>
                        </div>
                    </form>
                </div>
                <div class="manage-menu user-list">
                    <h5>用户列表</h5>
                    <div class="pull-right">
                        <select class="form-control" data-toggle="select">
                            <option value="0" selected>二级选项</option>
                            <option value="1">高级用户</option>
                            <option value="2">普通用户</option>
                            <option value="3">已冻结用户</option>
                        </select>
                    </div>
                </div>
                <div class="user-table">
                    <table class="table table-hover" id="user-table">
                        <thead>
                        <tr>
                            <th>用户名</th>
                            <th>有权限</th>
                            <th>无权限</th>
                            <th>隐藏</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 开发环境 -->
<script src="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/js/lib/requirejs/requirejs.js"></script>
<script src="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/js/config.js"></script>
<script type="text/javascript">
    require.config({baseUrl: '<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/js'});
    require([
        'app/user/permissionAccess_tree'
    ]);
</script>
</body>
</html>