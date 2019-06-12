$(function () {
    $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 1,
        "timePicker24Hour": true,
        timePickerSeconds: true,
        locale: {
            applyLabel: "确认",
            cancelLabel: "取消",
            resetLabel: "重置",
            format: 'YYYY/MM/DD HH:mm:ss',
            daysOfWeek: ['日', '一', '二', '三', '四', '五', '六'],
            monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
        },
        opens: 'right',
    });

    $('#datepicker').daterangepicker({
        timePicker: true,
        timePickerIncrement: 1,
        "timePicker24Hour": true,
        timePickerSeconds: true,
        singleDatePicker: true,
        locale: {
            applyLabel: "确认",
            cancelLabel: "取消",
            resetLabel: "重置",
            format: 'YYYY/MM/DD HH:mm:ss',
            daysOfWeek: ['日', '一', '二', '三', '四', '五', '六'],
            monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
        },
        opens: 'right',
    });

    // $('#datepicker').datetimepicker({
    //     format: 'yyyy/mm/dd HH:ii:ss',
    //     todatBtn: true,
    //     autoclose: true,
    // });
    $('#kvstorage-type').change(function(){
        var value=$(this).find("option:selected").val();
        $('#kv-value-'+value).removeClass("hide");
        $('#kv-value-'+value).siblings().addClass("hide");
    })

});