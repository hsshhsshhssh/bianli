$(function () {


    $("#id_tel").keyup(function () {
        var tel = $(this).val();
        //console.log(tel.match(/^0?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/));
        if(tel.match(/^0?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/) == null) {
            $(this).parent().find('span').eq(0).css('color', 'red').html('请填入真实电话');
        }
        else {
            $(this).parent().find('span').eq(0).css('color', 'green').html('通过');
        }
    });


    // 点击确认提交按钮
    $("#confirm").click(function () {

        var name='', zone='', address='', zipcode='', tel='';

        if(!((name=chkEmpty('name')) && (zone=chkEmpty('zone')) && (address=chkEmpty('address')) && (zipcode=chkEmpty('zipcode')) && (tel=chkEmpty('tel')))) {
            return;
        }

        var pay_type = $('input[name=pay_type]').val();

        var data = {
            'name':name,
            'zone':zone,
            'address':address,
            'zipcode':zipcode,
            'tel':tel,
            'pay_type': pay_type
        };

        $.post('orderhandle.php', data, function (res) {
            //console.log(res);
            if(res.status == 0) {
                // 下订单成功
                location.href = 'pay.php?order_sn=' + res.order_sn;
            }
            else {
                // 失败
                alert('请重试');
            }
        }, 'json');

    });


    ////检查是否为空
    function chkEmpty(item) {
        var _content = $.trim($("#id_" + item).val());
        if(_content == '') {
            alert(item + ' can not empty');
            return false;
        }
        return _content;
    }

})