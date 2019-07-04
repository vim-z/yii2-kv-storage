$(function () {
    var type = $('#' + formName.toLowerCase() + '-type').find("option:selected").val();
    change(type, value);
    //切换
    $('#' + formName.toLowerCase() + '-type').change(function () {
        var type = $(this).find("option:selected").val();
        change(type);
    })

    function change(type, value = null) {
        $(".valueControl").html("");
        switch (type) {
            case "1":
                var value = (value === null) ? "" : value;
                var html = "<div class=\"form-group required\">\n" +
                    "            <label>Value</label>\n" +
                    "            <input type=\"text\" value=\" " + value + "\"  name=\"" + formName + "[value]\" id=\"kvstorageform-value\" class=\"form-control\">\n" +
                    "            <div class=\"help-block\"></div>\n" +
                    "        </div>";
                $(".valueControl").append(html);
                break;
            case "2":
                var html = "<div class=\"form-group required\">\n" +
                    "            <label>Value</label>\n" +
                    "            <select id=\"kvstorageform-value\" name=\"" + formName + "[value]\" class=\"form-control\">\n" +
                    "            </select>\n" +
                    "            <div class=\"help-block\"></div>\n" +
                    "        </div>";
                var option="";
                for(var i=0;i<wether.length;i++){
                    if(i==value){
                        option+="<option value="+i+" selected>"+wether[i]+"</option>"
                    }else{
                        option+="<option value="+i+">"+wether[i]+"</option>"
                    }
                }
                $(".valueControl").append(html);
                $("#kvstorageform-value").append(option);
                break;
            case "3":
                var value = (value === null) ? "" : value;
                var html = "<div class=\"form-group required\">\n" +
                    "            <label>Value:</label>\n" +
                    "            <div class=\"input-group date\">\n" +
                    "                <div class=\"input-group-addon\">\n" +
                    "                    <i class=\"fa fa-clock-o\"></i>\n" +
                    "                </div>\n" +
                    "                <input type=\"text\" value=\"" + value + "\" name=\"" + formName + "[value]\" class=\"form-control pull-right\"\n" +
                    "                       id=\"datepicker\">\n" +
                    "            </div>\n" +
                    "            <div class=\"help-block\"></div>\n" +
                    "        </div>";
                $(".valueControl").append(html);
                datepicker();
                break;
            case "4":
                console.log(value);
                if (value === null) {
                    var value = ["", ""];
                }
                var html = "<div class=\"form-group required\">\n" +
                    "            <label>Value:</label>\n" +
                    "            <div>\n" +
                    "                <div class=\"fl one\">\n" +
                    "                    <input type=\"text\" value = \"" + value[0] + "\" name=\"" + formName + "[value][0]\" class=\"form-control\">\n" +
                    "                </div>\n" +
                    "                <div class=\"fl ot\">:</div>\n" +
                    "                <div class=\"fl one\">\n" +
                    "                    <input type=\"text\" value = \"" + value[1] + "\" name=\"" + formName + "[value][1]\" class=\"form-control\">\n" +
                    "                </div>\n" +
                    "                <div class=\"clear\"></div>\n" +
                    "            </div>\n" +
                    "            <div class=\"help-block\"></div>\n" +
                    "        </div>";
                $(".valueControl").append(html);
                break;
            case "5":
                if (value === null) {
                    var value = ["", ""];
                }
                var html = "<div class=\"form-group required\">\n" +
                    "            <label>Value:</label>\n" +
                    "            <div>\n" +
                    "                <div class=\"fl one\">\n" +
                    "                    <input type=\"text\" value = \"" + value[0] + "\" name=\"" + formName + "[value][0]\" class=\"form-control\"\n" +
                    "                           value=\"\">\n" +
                    "                </div>\n" +
                    "                <div class=\"fl ot\">to</div>\n" +
                    "                <div class=\"fl one\">\n" +
                    "                    <input type=\"text\" value = \"" + value[1] + "\" name=\"" + formName + "[value][1]\" class=\"form-control\"\n" +
                    "                </div>\n" +
                    "                <div class=\"clear\"></div>\n" +
                    "            </div>\n" +
                    "            <div class=\"help-block\"></div>\n" +
                    "        </div>";
                $(".valueControl").append(html);
                break;
            case "6":
                var value = (value === null) ? "" : value;
                var html = "<div class=\"form-group required\">\n" +
                    "            <label>Value:</label>\n" +
                    "            <div class=\"input-group\">\n" +
                    "                <div class=\"input-group-addon\">\n" +
                    "                    <i class=\"fa fa-clock-o\"></i>\n" +
                    "                </div>\n" +
                    "                <input type=\"text\" value = \"" + value + "\" name=\"" + formName + "[value]\" class=\"form-control pull-right\" id=\"reservationtime\"> </div>" +
                    "            <div class=\"help-block\"></div>\n" +
                    "        </div>";
                $(".valueControl").append(html);
                daterange();
                break;
            default:
        }
    }

//    调用daterangepicker
    function daterange() {
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 1,
            "timePicker24Hour": true,
            timePickerSeconds: true,
            dateLimit : {
                years : 1
            },
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
    }

    function datepicker() {
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
    }

});