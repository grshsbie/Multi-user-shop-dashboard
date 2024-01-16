<?php
$limit = 5;
$startpage = 0;
$page = 1;

if (isset($_REQUEST['page'])) {
    $page = (int) sqi($_REQUEST['page']);

    if ($page > 1) {
        $startpage = ($page - 1) * 5;
    }
}

$all = runsql("SELECT count(*) as c FROM tbl_product");
$count = $all[0]["c"];
$allrecord = 1;

if ($count > 5) {
    $allrecord = ceil($count / 5);
}

$r = runsql("SELECT tbl_product.*,concat(tbl_brand.name,' - ',tbl_brand.nameen) as namebrand FROM tbl_product,tbl_brand WHERE tbl_product.idbrand=tbl_brand.idbrand order by idproduct desc limit $startpage ,$limit");
?>


<table class="table" width="100%">
    <thead>
        <tr>
            <th>رديف</th>
            <th>شناسه محصول </th>
            <th>نام محصول</th>
            <th>نام انگلیسی محصول</th>
            <th>برند</th>
            <th>رنگ های موجود</th>
            <th>خلاصه محصول</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>

        <?php
        //idproduct
        //name
        //nameen
        //idbrand
        //colors
        //sumurise
        $b = 0;
        foreach ($r as $key) {
            $b++;
            $colors = str_replace("!", ",", $key["colors"]);
            if (strlen($colors) > 0) {
                $c = getrecord("tbl_color", "idcolor in ($colors)");
                $item = '';
                foreach ($c as $color) {
                    $item .= '<div class="box-color" style="background:' . $color['hexadecimal_color'] . '"></div>' . $color['name'];
                }
            }
            echo
                "
                <tr>
                    <td>$b</td>
                    <td>$key[idproduct]</td>
                    <td>$key[name]</td>
                    <td>$key[nameen]</td>
                    <td>$key[namebrand]</td>
                    <td>$item</td>
                    <td>$key[sumurise]</td>
                    <td>
                    <div class=\"btn btn-info\" onClick='showgallery($key[idproduct])'>گالری تصاویر محصول</div> 
                    <div class=\"btn btn-success\" onClick='setreview($key[idproduct])' >نقد و برسی مصحولات</div>
                    <div class=\"btn btn-primary\" onClick='showproperties($key[idproduct])' >نقد و برسی محصولات</div>
                    </td>
                </tr>
            ";
        }


        ?>
    </tbody>
</table>

<div class="number">
    <?php

    for ($i = 1; $i <= $allrecord; $i++) {
        echo " 
        <a href='index.php?action=list_product&page=$i'>
        <div class=\"item-number\">$i</div>
        </a>
        ";

    }

    ?>
</div>


<script>
    function showgallery(idproduct) {
        $.ajax({
            url: 'function/showgallery.php',
            data: 'idproduct=' + idproduct,
            success: function (data) {
                showpopup('گالری تصاویر محصول', data);
            }
        });
    }

    function setreview(idproduct) {
        $.ajax({
            url: 'function/setreview.php',
            data: 'idproduct=' + idproduct,
            success: function (data) {
                showpopup('نقد و بررسی', data);
            }
        })
    }



    function showproperties(idproduct) {
        $.ajax({
            url: 'function/showproperties.php',
            data: 'idproduct=' + idproduct,
            success: function (data) {
                showpopup('مشاهده مشخصات محصول', data);
            }
        })
    }

</script>