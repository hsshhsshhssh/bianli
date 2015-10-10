/****file: register.js***/
$(function () {
    // 消除全部商品分类的影响
    $("#cate_all_div").hide(0); //会消除影响

    // 用户名框获取焦点
    $('input[name=username]').focus();
    // 禁止提交按钮
    $('.td_button button').eq(0).attr('disabled', true);

    var chkname = 0, chkpwd = 0, chkconfpwd  = 0, chkemail = 0;
    var username = '', password = '', email = '';

    // 使能提交按钮
    function chk_button() {
        if(chkconfpwd && chkemail && chkname && chkpwd) {
            $('.td_button button').eq(0).attr('disabled', false);
        }
        else {
            $('.td_button button').eq(0).attr('disabled', true);
        }
    }

    // 验证用户名
    $('input[name=username]').keyup(function () {
        username = $.trim($(this).val());
        if(username == '') {
            $(this).parent().find('span').eq(0).css('color', 'red').html('用户名不能为空');
            chkname = 0;
        }
        else {
            $(this).parent().find('span').eq(0).html(' ');
            chkname = 1;
            chk_button();
        }
    });
    // 验证用户名是否重复
    $('input[name=username]').blur(function (){
        // 发送异步请求
        $('input[name=username]').parent().find('span').eq(0).css('color', 'blue').html('正在验证...');
        $.post('registerhandle.php', {"type":"chkuname", "username": username}, function (res) {
            //console.log(res);
            if(res != 0) {
                // 重复
                $('input[name=username]').parent().find('span').eq(0).css('color', 'red').html('该用户名已经被注册');
                chkname = 0;
            }
            else {
                // 可以使用
                $('input[name=username]').parent().find('span').eq(0).css('color', 'green').html('通过');
                chkname = 1;
                chk_button();
            }
        })
    });


    // 验证密码
    $('input[name=password]').keyup(function () {
        // 空格也算
        password = $(this).val();
        // 不能少于6位
        if(password.length < 6) {
            $(this).parent().find('span').eq(0).css('color', 'red').html('密码长度不能少于6位');
            chkpwd = 0;
        }
        //console.log(password.match(/^\d+$/));
        // 纯数字
        else if(password.match(/^\d+$/)!= null){
            $(this).parent().find('span').eq(0).css('color', 'green').html('密码强度: 弱');
            chkpwd = 1;
            chk_button();
        }
        // 不为纯数字 长度为6-12
        else if(password.length < 12) {
            $(this).parent().find('span').eq(0).css('color', 'green').html('密码强度: 中');
            chkpwd = 1;
            chk_button();
        }
        // 不为纯数字 长度大于12
        else {
            $(this).parent().find('span').eq(0).css('color', 'green').html('密码强度: 强');
            chkpwd = 1;
            chk_button();
        }
    });

    // 确认密码
    $('input[name=confirmpwd]').keyup(function () {
        var confirmpwd = $(this).val();
        if(confirmpwd != password) {
            $(this).parent().find('span').eq(0).css('color', 'red').html('两次密码不一样');
            chkconfpwd = 0;
        }
        else {
            $(this).parent().find('span').eq(0).css('color', 'green').html('通过');
            chkconfpwd = 1;
            chk_button();
        }
    });

    // 邮箱
    $('input[name=email]').keyup(function () {
        email = $.trim($(this).val());
        if(email.match(/^\w+([-.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/) == null){
            // 邮箱验证不通过
            $(this).parent().find('span').eq(0).css('color', 'red').html('邮箱格式不对');
            chkemail= 0;
        }
        else {
            // 通过
            $(this).parent().find('span').eq(0).css('color', 'green').html('通过');
            chkemail = 1;
            chk_button();
        }
    });


    // 刷新验证码
    $('#verify').click(function () {
        $(this).attr('src', '../tools/verifycode.php?rand=' + Math.random());
    })

    // 提交
    $('.td_button button').click(function () {
        // 检查验证码
        var verify = $('input[name=verify]').val();
        if(verify == '') {
            alert('验证码不能为空');
            return false;
        }
        $.get('../tools/verifycodechk.php?verify=' + verify, function (res) {
            if(res != 0) {
                // 验证码不正确
                alert('验证码不正确');
                $('#verify').trigger('click');
                return false;
            }
            else {
                // 验证码正确 发送注册请求
                var postData = {
                    "username": username,
                    "password": hex_md5(password),
                    "email": email,
                    "type": "register"
                };
                // 发送异步请求
                $.post('registerhandle.php', postData, function (res) {
                    //console.log(res);return;
                    if(res != 0) {
                        // 注册失败
                        alert('注册失败 请重试');
                        $('#verify').trigger('click');
                        return;
                    }
                    else {
                        // 注册成功
                        alert('注册成功 请到你的邮箱激活');
                        return ;
                    }
                });

            }
        })

    })


});