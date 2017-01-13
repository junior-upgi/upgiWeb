$(document).ready(function () { 
    $('#todayFile').fileinput({
        language: 'zh-TW',
        browseClass: "btn btn-success",
        browseLabel: "選擇檔案",
        browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
        removeClass: "btn btn-danger",
        removeLabel: "移除",
        removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
        allowedFileExtensions: ["xls", "xlsx"],
        fileActionSettings: {
            showZoom: false,
            zoomIcon: "",
            zoomClass: "",
            zoomTitle: "",
        }
    });
});

var importToday = new Vue({
    el: '#importToday',
    data: {
        image: null,
        glasses: {},
    },

    mounted: function () {
        this.searchGlassInfo();
    },

    methods: {
        submit: function(event) {
            if ($("#todayFile").val() == '') {
                return false;
            }
            $("#up").ajaxForm({
                url: window.baseurl + "/production/uploadToday",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                beforeSubmit: function () {
                    $('#BtnUpload').button('loading');
                },
                success: function (res) {
                    if (res['success']) {
                        alert('上傳資料成功!');
                    } else {
                        alert('上傳資料失敗!')
                    }
                    $('#BtnUpload').button('reset');
                    $('#todayFile').fileinput('clear');
                },
                error: function (res) {
                    console.log(res);
                    console.log('no');
                    $('#BtnUpload').button('reset');
                }
            });
            $("#up").submit();
        },

        removeImage: function (e) {
            this.image = '';
        },
        
        searchGlassInfo: function () {
            $.get( window.baseurl + "/production/getTodayImportGlassInfo", function( results ) {
                console.log(results);
                importToday.glasses = results;
            }).fail(function(e){
                console.log( e );
            });
        },
    }
});   

