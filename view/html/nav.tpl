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
                <!-- BEGIN menu -->
                <!-- IF isSubMenu=0  -->
                <li id="nav_top {menuIntro}" class="nav_active">
                    <!-- ELSE -->
                <li id="nav_top {menuIntro}" class="">
                    <!-- ENDIF -->
                    <a href="#" target="_blank">
                        <span>{menuName}</span>
                        <i>{menuIntro}</i>
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
                                <!-- IF ptype=1 -->
                                <!-- ELSE -->
                                <li>
                                    <a href="{curl}">
                                        <div class="proimg">
                                            <img src="./public/img/navIcon_2.png" alt=""
                                                 class="img-responsive center-block">
                                        </div>
                                        <div class="prolist">
                                            <p>{menuIntro} <span>{menuVersion}</span></p>
                                            <p>{menuName}</p>
                                        </div>
                                    </a>
                                </li>
                                <!-- ENDIF -->
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
