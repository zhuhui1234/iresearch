/*! iResearchView-1.0.0-2016-09-21 */
define(["jquery","domReady","validator"],function(a,b,c){b(function(){a(function(){a("#loginForm").bootstrapValidator({message:"This value is not valid",feedbackIcons:{valid:"fa fa-check",invalid:"fa fa-remove",validating:"fa fa-refresh"},fields:{username:{message:"用户名无效",validators:{notEmpty:{message:"用户名不能为空"}}},password:{validators:{notEmpty:{message:"密码不能为空"},stringLength:{min:6,max:30,message:"密码长度6位到30位"}}},verification:{validators:{notEmpty:{message:"请输入验证码"}}},nowpsw:{validators:{notEmpty:{message:"请输入当前密码"},stringLength:{min:6,max:30,message:"密码长度6位到30位"}}},psw:{validators:{notEmpty:{message:"新密码不能为空"},stringLength:{min:6,max:30,message:"密码长度6位到30位"},identical:{field:"confirmPassword",message:"两次密码不一致"}}},confirmpsw:{validators:{notEmpty:{message:"新密码不能为空"},identical:{field:"password",message:"两次密码不一致"}}}}}),a("#index-login").bootstrapValidator({message:"This value is not valid",feedbackIcons:{valid:"fa fa-check",invalid:"fa fa-remove",validating:"fa fa-refresh"},fields:{email:{validators:{notEmpty:{message:"邮箱不能为空"},emailAddress:{message:"请输入正确的邮箱格式"}}},password:{validators:{notEmpty:{message:"密码不能为空"}}},yzm:{validators:{notEmpty:{message:"请输入验证码"}}}}}).on("success.form.bv",function(b){b.preventDefault();var c=a(b.target);c.data("bootstrapValidator"),a.post(c.attr("action"),c.serialize(),function(a){},"json")})})})});