

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content history">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    <img src="./public/img/irdpop.png" alt="">
                </h4>
            </div>
            <div class="modal-body">
                <iframe style="display: none;" src="" name="target_submit"></iframe>
                <form role="form" target="target_submit" id="bindingIRDA">
                    <p style="display: none" id="binding_irda_error"
                       class="text-center text-danger"><i class="fa fa-warning"></i> 绑定失败，请输入正确的账号密码
                    </p>
                    <div class="form-group">
                        <input id="irda_email" name="mail" type="text" class="form-control"
                               placeholder="用户名">
                    </div>
                    <div class="form-group">
                        <input id="irda_pwd" type="password" name="pwd" class="form-control"
                               placeholder="密码">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">确定</button>
                </form>
                <p>如有账号问题，请联系 400-000-000</p>
            </div>
        </div>
    </div>
</div>

<footer>
    <div class="container">

        <div class="copyright">
            <!-- <h5><span>Contact Us</span></h5>
            <i class="fa fa-phone"></i>
            <span>0086+021-51082699</span>
            <i class="fa fa-envelope-o"></i>
            <span>irv@iresearch.com.cn</span> -->
            <!-- <p class="weibo">
                <a href="#">
                    <i class="fa fa-wechat"></i>
                </a>
                <a href="#">
                    <i class="fa fa-weibo"></i>
                </a>
            </p> -->
            <p class="cpr">&copy;2017 iResearch 使用艾瑞数据前必读    艾瑞数据版权声明  沪ICP证030173号 </p>
        </div>
    </div>
</footer>