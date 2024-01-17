<?php
include_once("../config_admin.php");
if (isset($_REQUEST['idproduct'])) {
    $idproduct = (int) sqi($_REQUEST['idproduct']);
    $pro = getrecord("tbl_properties", "subid=0");
    echo '<form class="form" method="POST" id="frmproperties">';
    echo '<input type="hidden" name="idproducts" value="' . $idproduct . '"></>';
    if (count($pro) > 0) {
        foreach ($pro as $key) {
            echo '<div class="item-per">
            <div class="arrow"><i class="icon-chevron-sign-down"></i></div>
            <div class="subject">' . $key['name'] . '</div>
            <div class="body">';
            $sub = getrecord(" tbl_properties", "subid=$key[idproperties]");
            foreach ($sub as $subproperties) {
                $subprovalue = getrecord("tblper_product", "idproperties='$subproperties[idproperties]' and idproducts='$idproduct'");
                $value = '';
                if (count($subprovalue) > 0) {
                    $value = $subprovalue[0]['value'];
                }
                echo '<div class="row">
                <div class="name">' . $subproperties['name'] . '</div>
                <div class="input">
                <input type="text" placeholder="' . $subproperties['name'] . '" name="idproperties-' . $subproperties['idproperties'] . '" value="' . $value . '"></>
                </div>
                </div>';
            }
            echo '</div></div>';
        }
        echo '<button type="submit" class="btn btn-success btn-block">ثبت مشخصات</button>';
        echo '</form>';
    } else {
        echo 'مشخصاتی تعریف نشده است';
    }

} else {
    echo 'Error paremetr send';
}
?>
<style>
    .item-per {
        margin: 5px;
        background: #eee;
        border-radius: 5px;
        overflow: hidden
    }

    .item-per .arrow {
        float: left;
        color: #fff;
        font-size: 20px;
        transition: all 0.3s;
        width: 28px;
        text-align: center;
        height: 28px;
        margin: 3px 0px
    }

    .item-per .subject {
        padding: 5px;
        background: #607D8B;
        color: #fff;
        cursor: pointer
    }

    .item-per .body {
        padding: 5px;
        display: none
    }

    .item-per.active .body {
        display: block;
    }

    .item-per.active .arrow {
        transform: rotate(180deg);
    }
</style>

<script>
    $('.item-per .subject').click(function () {
        self = $(this).parent();
        if (self.hasClass('active')) {
            self.removeClass('active');
        }
        else {
            self.addClass('active');
        }
    });

    $('#frmproperties').submit(function () {
        $.ajax({
            url: 'function/setproperties.php',
            data: $('#frmproperties').serialize(),
            type: "POST",
            success: function (data) {
                if (data == 'ok'){
                    hideall();
                }else {
                    alert(data);
                }

            }
        });
        return false;
    });
</script>