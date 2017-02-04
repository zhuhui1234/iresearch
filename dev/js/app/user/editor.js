/**
 * edit user information
 */

define(["helper", "bootstrap", "jquery"], function(helper){
    // console.log('aa');
    $("#sidebar_userInfo").addClass("active");

    // helper.post('getUserInfo',null,function(data){
    //     console.log(data);
    //     $("#username").val(data.data.u_name);
    //     $("#position").val(data.data.u_position);
    //     $("#mobile").val(data.data.u_mobile);
    //     if (data.data.u_head != '' && data.data.u_head != null) {
    //         $("#avatar_icon").attr("src", helper.imgServer + data.data.u_head);
    //     }
    // });
});