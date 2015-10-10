/***file: login.js****/
$(function () {
    // 消除全部商品分类的影响
    $("#cate_all_div").hide(0); //会消除影响

    // 用户名框获取焦点
    $('input[name=username]').focus();


    // 检查是否为空
    function chk(temp) {
        var _temp = $('input[name=' + temp + ']').val();
        if (_temp == '') {
            alert(temp + ' 不能为空');
            return false;
        }
        else return _temp;
    }

    // 刷新验证码
    $('#verify').click(function () {
        $(this).attr('src', '../tools/verifycode.php?rand=' + Math.random());
    });


    // 确定按钮
    $('.td_button button').eq(0).click(function () {
        //alert('aa');
        var username = '', password = '', verify = '', rem='no';

        if ((username = chk('username')) && (password = chk('password')) && (verify = chk('verify'))) {
           // 验证码
            $.get('../tools/verifycodechk.php?verify=' + verify, function (res) {

                if(res != 0) {
                    // 验证码不正确
                    alert('验证码不正确');
                    $('#verify').trigger('click');
                    return false;
                }
                else {
                    // 检查是否记住密码
                    if($('#rempwd input[name=rempwd]').attr('checked')) {
                        rem = "yes";
                    }
                    else {
                        rem = 'no'
                    }

                    // 验证码正确 检验用户名和密码
                    $.post('loginhandle.php', {"username": username, 'password': hex_md5(password), "rem":rem}, function (res) {
                        //console.log(res);
                        if(res == 1) {
                            // 用户名或密码错误
                            alert('用户名或密码错误');
                            $('#verify').trigger('click');
                        }
                        else if(res == 2) {
                            // 为激活
                            alert('未激活');
                            $('#verify').trigger('click');
                        }
                        else if(res == 0) {
                            // 登录成功
                            location.href = 'index.php';
                        }
                        else {
                            alert('请重试');
                        }

                    });
                }
            });
        }
        else {
            // 信息填写不全
            return;
        }


    });
});