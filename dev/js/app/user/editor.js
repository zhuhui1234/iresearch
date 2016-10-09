/**
 * edit user information
 */

define(["helper", "bootstrap", "jquery"], function(helper){
    helper.post('getUserInfo',null,function(data){
        console.log(data);
        $("#u_name").val(data.data.u_name);
        $("#u_department").val(data.data.u_department);
        $("#u_position").val(data.data.u_position);
        $("#mobile").val(data.data.u_mobile);
        if (data.data.u_head != '' && data.data.u_head != null) {
            $("#avatar_icon").attr("src", helper.imgServer + data.data.u_head);
        }
    });
});