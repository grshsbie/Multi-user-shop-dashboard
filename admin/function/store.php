<?php
include_once("../config_admin.php");

if (isset($_REQUEST["idproduct"])) {
    $idproduct = (int) sqi($_REQUEST["idproduct"]);
    echo $idproduct;
} else {
    echo 'خطا در ارسال اطلاعات';

}
$p = getrecord('tbl_product', "idproduct=$idproduct");
if (count($p) > 0) {
    $product = $p[0];
    $idcolors = str_replace('!', ',', $product['colors']);
}
?>

<table class="table" width="100%">
    <thead>

        <th>ردیف</th>
        <th>شناسه محصول</th>
        <th>گارانتی</th>
        <th>رنگ</th>
        <th>قیمت خرید</th>
        <th>قیمت فروش</th>
        <th>تعداد </th>
        <th>تاریخ </th>
        <th>قیمت پیشنهاد ویژه </th>
        <th>قیمت شروع پیشنهاد ویژه </th>

    </thead>
    <tbody>
        <?php
        $sotore = getrecord('tbl_store', "idproduct='$idproduct'");
        if (count($sotore) > 0) {

            $i = 1;
            foreach ($sotore as $key) {
                $color = getrecord("tbl_color", "idcolor=$key[idcolor]");
                $color = $color[0];
                echo "      
                <tr>
                  <td>$i</td>
                  <td>$key[idproduct]</td>
                  <td>$key[garanty]</td>
                  <td>
                  <div class='box-color' style='background:$color[hexadecimal_color]'></div>
                  $color[name]
                  </td>
                  <td>$key[price_buy]</td>
                  <td>$key[price_sale]</td>
                  <td>$key[tedad]</td>
                  <td>$key[datecreate]</td>
                  <td>$key[price_offer]</td>
                  <td>$key[date_offer]</td>
                </tr>
                     "
                ;
                $i++;

            }



        }


        ?>

        <tr>
            <td>
                <?php
                $c = getrecord("tbl_color", "idcolor in($idcolors)");
                foreach ($c as $color) {
                    echo
                        '<input type="checkbox" value="' . $color['idcolor'] . '" id="color-' . $color['idcolor'] . '" name="colors"/>
<label for="color-' . $color['idcolor'] . '">
<div class="box-color" style="background:' . $color['hexadecimal_color'] . '"></div>
' . $color['name'] . '</label>';
                }

                ?>
            </td>
            <td>
                <input type="text" id="garanti" placeholder="گارانتی">
            </td>
            <td>
                <input type="number" id="price_sale" placeholder="قیمت فروش">
            </td>
            <td>
                <input type="number" id="price_buy" placeholder="قیمت خرید">
            </td>
            <td>
                <input type="number" id="tedad" placeholder="تعداد">
            </td>
            <td>
                <input type="number" id="price_offer" placeholder="قیمت پیشنهاد ویژه">
            </td>
        </tr>
    </tbody>
</table>

<div class="btn btn-success btn-block" onclick="addstore()"> افزودن موجودی انبار</div>

<script>
    function addstore() {
        var idcolor = $('input[name="colors"]:checked').val();
        if(!idcolor){
            alert('لطفایک رنگ را انتخاب کنید')ک
        }
    }
</script>