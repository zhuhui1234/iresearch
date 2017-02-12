<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <img src="./public/img/irs-data-white.png" alt="">
            </a>
        </div>
        <div class="nav_con">
            <ul class="nav navbar-nav">
                <li id="nav_home">
                    <a href="?m=index&a=index">
                        <span>首页</span>
                        <i>Home</i>
                    </a>
                </li>
                <!-- 前置菜单 -->
                <!-- BEGIN menu -->
                <!-- IF isSubMenu=0  -->
                <li id="{menuEName}" class="nav_active">
                    <!-- ELSE -->
                <li id="{menuEName}" class="">
                    <!-- ENDIF -->
                    <!-- IF versionType="4" -->
                    <a href="{curl}" target="_blank">
                    <!-- ELSE -->
                        <a href="{curl}">
                        <!-- ENDIF -->
                        <span>{menuName}</span>
                        <i>{menuEName}</i>
                    </a>
                </li>
                <!-- END BEGIN -->
            </ul>
            <div class="line"></div>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <!-- <li>
                <a href="#">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge">4</span>
                </a>
            </li> -->
            <li>
                <a href="?m=user&a=editUserInfo">
                    <i class="fa fa-user"></i>
                </a>
            </li>
            <li>
                <a href="?m=user&a=logOut" data-toggle="tooltip" title="注销" data-placement="bottom">
                    <i class="fa fa-sign-out"></i>
                </a>
            </li>
        </ul>
    </div>
    <!-- 后帘菜单 -->
    <div class="nav-bg">
        <div class="container">
            <ul class="dropdown-list">
                <li></li>
                <!-- BEGIN menu -->
                <!-- IF isSubMenu=0  -->
                <li>
                    <div class="row">
                        <!-- BEGIN subMenu -->
                        <div class="col-xs-2">
                            <h5>{menuName}</h5>
                            <ul>
                                <!-- BEGIN lowerTree -->

                                <li>
                                    <!-- IF ptype!="1" -->
                                    <!-- IF menuIntro="建设中..." -->
                                    <a href="{curl}" class="building" data-toggle="tooltip" data-placement="top" title="建设中">
                                    <!-- ELSE -->
                                    <a href="{curl}" data-toggle="tooltip" data-placement="top" title="申请试用">
                                        <!-- ENDIF -->
                                        <!-- ELSE -->
                                        <!-- IF menuIntro="建设中..." -->
                                        <a href="#" class="building" data-toggle="tooltip" data-placement="top" title="建设中">
                                        <!-- ELSE -->
                                        <a href="{curl}">
                                            <!-- ENDIF -->
                                        <!-- ENDIF -->
                                        <div class="proimg">
                                            <!-- IF series="1" -->
                                            <img src="./public/img/navIcon_1.png" alt="" class="img-responsive center-block">
                                            <!-- ELSEIF series="2" -->
                                             <img src="./public/img/navIcon_4.png" alt="" class="img-responsive center-block">
                                            <!-- ELSEIF series="3" -->
                                             <img src="./public/img/navIcon_2.png" alt="" class="img-responsive center-block">
                                            <!-- ELSEIF series="4" -->
                                            <img src="./public/img/navIcon_3.png" alt="" class="img-responsive center-block">
                                            <!-- ENDIF -->
                                        </div>
                                        <div class="prolist">
                                            <p>{menuName} </p>
                                            <p>{menuEName}</p>
                                        </div>
                                    </a>
                                </li>

                                <!-- END BEGIN -->
                            </ul>
                        </div>

                        <!-- END BEGIN -->
                    </div>
                </li>
                <!-- ELSE -->
                <li></li>
                <!-- ENDIF -->
                <!-- END BEGIN -->

            </ul>
        </div>
    </div>

</nav>
