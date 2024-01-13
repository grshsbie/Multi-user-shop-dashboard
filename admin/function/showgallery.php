<?php

include_once("../config_admin.php");
if (isset($_REQUEST['idproduct'])) {
    $idproduct = (int) sqi($_REQUEST['idproduct']);
} else {
    echo 'Error in parametr';
    exit();
}
?>


<style>
    .titlegalery {
        background: #f7f7f7;
        padding: 8px;
    }

    .closeg:hover {
        color: red;
        cursor: pointer;
    }

    .item.left.btn.btn-success {
        color: #fff;
        border-bottom: 0px;
        display: none;
    }

    .item.left.btn.btn-success:hover {
        border-color: green;
        background: green !important;

    }

    @media (min-width: 0px) and (max-width: 480px) {

        #dragandrophandler {
            font-size: 150%;
        }
    }

    #dragandrophandler {
        border: 2px dotted #0B85A1;
        color: #92AAB0;
        text-align: center;
        vertical-align: middle;
        margin-bottom: 10px;

        padding: 5%;
        border-radius: 30px;

        margin: 5px auto !important;
        height: 115px;
        cursor: pointer;
    }

    #dragandrophandler:active {
        background-image: none;
        outline: 0;
        -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
    }

    .progressBar {
        width: 33%;
        height: 22px;
        border: 1px solid #ddd;
        border-radius: 5px;
        overflow: hidden;
        display: inline-block;
        margin: 0px 10px 5px 5px;
        vertical-align: top;
    }

    .progressBar div {
        height: 100%;
        color: #fff;
        text-align: right;
        line-height: 22px;
        /* same as #progressBar height if we want text middle aligned */
        width: 0;
        background-color: #0ba1b5;
        border-radius: 3px;
    }

    .statusbar {
        border-top: 1px solid #A9CCD1;
        min-height: 25px;
        padding: 10px 10px 0px 10px;
        vertical-align: top;
    }

    .statusbar:nth-child(odd) {
        background: #EBEFF0;
    }

    .filename {
        display: inline-block;
        vertical-align: top;
        width: 33%;
        overflow: hidden;
        height: 20px;
    }

    .filesize {
        display: inline-block;
        vertical-align: top;
        color: #30693D;
        width: 100px;
        margin-left: 10px;
        margin-right: 5px;
    }

    .abort {
        background-color: #A8352F;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
        display: inline-block;
        color: #fff;
        font-family: arial;
        font-size: 13px;
        font-weight: normal;
        padding: 4px 15px;
        cursor: pointer;
        vertical-align: top
    }
</style>
<div id="tabs">
    <Div class="item-tab active" data-tab="uploadfile">اپلود تصاویر</Div>
    <div class="item-tab " data-tab="listimages">تصاویر</div>
</div>
<div id="bodytab">
    <div class="item-body-tab active" id="uploadfile">
        <input name="file" id="fileadd" type="file" style="display:none" multiple>
        <label for="fileadd">
            <div class="drag-and-drop" id="dragandrophandler">
                فایل را جهت آپلود بکشید و اینجا رها کنید
            </div>
        </label>
        <br><br>
        <div id="status1"></div>
    </div>

    <Div class="item-body-tab" id="listimages">
        <?php
        $r = getrecord("tbl_images", "idinfo='$idproduct' and tblname = 'tbl_product'");
        if (count($r) > 0) {
            foreach ($r as $key) {
                $active = '';
                if ($key['primary_img'] == '1') {
                    $active = 'active';
                }
                echo '<div class="item-images ' . $active . '" data-id="' . $key['idimg'] . '">';
                echo '<img src="../' . $key['url'] . '" width="120">';
                echo '</div>';
            }
        }
        ?>
    </Div>
</div>

<script>

    $('#tabs .item-tab').click(function () {
        idtab = $(this).data('tab');
        $('#tabs .item-tab').removeClass('active');
        $('#bodytab .item-body-tab').removeClass('active');
        $(this).addClass('active');
        $('#' + idtab).addClass('active');

    });

    $('.item-images').click(function () {
        idimages = $(this).data('id');
        if (confirm("آیا مطمئن هستید که این تصویر باید به عنوان تصویر اصلی جایگزین شود؟")) {
            $.ajax({
                url: 'function/setdefault.php',
                data: 'idimages=' + idimages,
                success: function (data) {
                    alert(data);
                    if (data == 'ok') {
                        $('.item-images').removeClass('active');
                        $('.item-images[data-id="' + idimages + '"]').addClass('active');
                    }
                    else {
                        alert('خطایی در جایگزینی تصویر به وجود آمده است');
                    }
                }
            });
        }
    });
    function sendFileToServer(formData, status) {

        var uploadURL = "function/upload.php?tblname=tbl_product&idinfo=<?php echo $idproduct; ?>"; //Upload URL

        var jqXHR = $.ajax({
            xhr: function () {
                var xhrobj = $.ajaxSettings.xhr();
                if (xhrobj.upload) {
                    xhrobj.upload.addEventListener('progress', function (event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                            percent = Math.ceil(position / total * 100);
                        }
                        //Set progress
                        status.setProgress(percent);
                    }, false);
                }
                return xhrobj;
            },
            url: uploadURL,
            type: "POST",
            contentType: false,
            processData: false,
            cache: false,
            data: formData,
            success: function (data) {
                alert(data);
                status.setProgress(100);

                if (data['status'] == "error") {
                    status.abort.text(data['error']);
                } else {
                    status.abort.text('اپلود شده . در کتابخانه اضاف شد');
                    status.abort.attr('style', 'background: #78cd51;');

                    address = '../' + data['imgurl'];
                    picsrc = address;


                }
            },
            error: function (error) {

                alert(error[responseText]);

            }
        });

        status.setAbort(jqXHR);

    }
    var rowCount = 0;
    function createStatusbar(obj) {
        rowCount++;
        var row = "odd";
        if (rowCount % 2 == 0) row = "even";
        this.statusbar = $("<div class='statusbar " + row + "'></div>");
        this.filename = $("<div class='filename'></div>").appendTo(this.statusbar);
        this.size = $("<div class='filesize'></div>").appendTo(this.statusbar);
        this.progressBar = $("<div class='progressBar'><div></div></div>").appendTo(this.statusbar);
        this.abort = $("<div class='abort'>لغو آپلود</div>").appendTo(this.statusbar);
        $('#status1').after(this.statusbar);

        this.setFileNameSize = function (name, size) {

            var allwoefromat = new Array('---', 'jpg', 'png', 'jpeg');
            var mystr = name;
            var myarr = mystr.split(".");
            var typefile = myarr[myarr.length - 1].toLowerCase();
            var a = allwoefromat.indexOf(typefile);
            if (allwoefromat.indexOf(typefile)) {

            } else {
                this.abort.text('فرمت غیر مجاز');
            }
            var sizeStr = "";
            var sizeKB = size / 1024;
            if (parseInt(sizeKB) > 1024) {
                var sizeMB = sizeKB / 1024;
                sizeStr = sizeMB.toFixed(2) + " MB";
            }
            else {
                sizeStr = sizeKB.toFixed(2) + " KB";
            }

            this.filename.html(name);
            this.size.html(sizeStr);
        }
        this.setProgress = function (progress) {
            var progressBarWidth = progress * this.progressBar.width() / 100;
            this.progressBar.find('div').animate({ width: progressBarWidth }, 10).html(progress + "% ");
            if (parseInt(progress) >= 100) {
                this.abort.text("در حال بررسی ...");
            }
        }
        this.setAbort = function (jqxhr) {
            var sb = this.statusbar;
            this.abort.click(function () {
                jqxhr.abort();
                sb.hide();
            });
        }
    }
    function handleFileUpload(files, obj) {

        for (var i = 0; i < files.length; i++) {

            var fd = new FormData();
            fd.append('file', files[i]);
            fd.append('target', 'file');
            var status = new createStatusbar(obj); //Using this we can set progress.
            status.setFileNameSize(files[i].name, files[i].size);
            sendFileToServer(fd, status);

        }
    }
    $(document).ready(function () {

        var obj = $("#dragandrophandler");
        $("#fileadd").change(function () {

            files = this.files;
            if (files) {
                handleFileUpload(files, obj);
            }
        });
        obj.on('dragenter', function (e) {
            e.stopPropagation();
            e.preventDefault();
            $(this).css('border', '2px solid #0B85A1');
            $(this).text('فایل را اینچا رها کنید');
        });
        obj.on('dragover', function (e) {
            e.stopPropagation();
            e.preventDefault();
        });
        obj.on('drop', function (e) {
            $(this).text('فایل را جهت آپلود بکشید و اینجا رها کنید');
            $(this).css('border', '2px dotted #0B85A1');
            e.preventDefault();
            var files = e.originalEvent.dataTransfer.files;
            handleFileUpload(files, obj);
        });
        $(document).on('dragenter', function (e) {
            e.stopPropagation();
            e.preventDefault();
        });
        $(document).on('dragover', function (e) {
            e.stopPropagation();
            e.preventDefault();
            obj.css('border', '2px dotted #0B85A1');
            obj.text('عکس ها را جهت آپلود بکشید و اینجا رها کنید');
        });
        $(document).on('drop', function (e) {
            e.stopPropagation();
            e.preventDefault();
        });

    });




</script>