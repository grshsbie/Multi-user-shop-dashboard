<div class="form">

    <div class="row">
        <div class="name">
            <label for="idcat">انتخاب دسته بندی محصول</label>
        </div>
        <div class="input">
            <select name="" id="idcat">
                <option value="0" selected disabled>لطفا یک مورد را نتخاب کنید</option>
                <?php
                $r = getrecord("tbl_cat", "subid=0");
                foreach ($r as $key) {
                    echo "  <option value='$key[idcat]' >- $key[name]</option>";
                    $s = getrecord("tbl_cat", "subid='$key[idcat]'");
                    if (count($s) > 0) {
                        foreach ($s as $sub) {
                            echo "<option value='$sub[idcat]' >-- $sub[name]</option>";
                            $s2 = getrecord("tbl_cat", "subid='$sub[idcat]'");
                            if (count($s2) > 0) {
                                foreach ($s2 as $sub2) {
                                    echo "<option value='$sub2[idcat]' >-- $sub2[name]</option>";
                                }
                            }
                        }
                    }
                }
                ?>
            </select>
        </div>
    </div>


    <div class="row">
        <div class="name">
            <label for="name">نام مصحول</label>
        </div>
        <div class="input"><input type="text" id="name" placeholder="نام محصول را وارد کنید"></div>
    </div>

    <div class="row">
        <div class="name">
            <label for="nameen">نام انگیلیسی محصول را وارد کنید</label>
        </div>
        <div class="input"><input type="text" id="nameen" placeholder="نام انگیلیس محصول را وارد کنید"></div>
    </div>

    <div class="row">
        <div class="name">
            <label for="description">توضیحات محصول</label>
        </div>
        <div class="input"><textarea id="description" placeholder="توضیحات محصول را وارد کیند"></textarea></div>
    </div>

    <div class="row">
        <div class="name">
            <label for="sumurise">خلاصه توضحیات محصول</label>
        </div>
        <div class="input"><textarea id="sumurise" placeholder="خلاصه توضحیات محصول را وارد کنید"></textarea></div>
    </div>

    <div class="row">
        <div class="name">
            <label for="idbrand">برند محصول</label>
        </div>
        <select name="" id="idbrand">
            <option value="0" selected disabled>لطفا یک مورد را اضافه بکنید</option>
            <?php
            $brand = getrecord("tbl_brand");
            foreach ($brand as $key) {
                echo " <option value='$key[idbrand]'>$key[name] - $key[nameen]</option>";
            }
            ?>
        </select>
    </div>


    <div class="row">
        <div class="name">رنگ ها</div>
        <div class="input">
            <?php
            $c = getrecord("tbl_color");
            foreach ($c as $color) {
                echo
                    '<input type="checkbox" value="' . $color['idcolor'] . '" id="color-' . $color['idcolor'] . '" name="colors"/>
<label for="color-' . $color['idcolor'] . '">
<div class="box-color" style="background:' . $color['hexadecimal_color'] . '"></div>
' . $color['name'] . '</label>';
            }
            ?>
        </div>
    </div>


    <div class="row">
        <div class="name">
            <label for="status">وضعیت</label>
            <div class="input">
                <select name="" id="status">
                    <option value="publish">عرضه شده</option>
                    <option value="coming soon">به زودی</option>
                    <option value="old">توقف تولید</option>
                    <option value="test">آزمایشی</option>
                </select>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="btn btn-success " onclick="addproduct()">
            ثبت محصول
        </div>
    </div>

</div>

<script>
    function addproduct() {
        var idcat = $('#idcat option:selected').val();
        var name = $('#name').val();
        var nameen = $('#nameen').val();
        var description = $('#description').val();
        var sumurise = $('#sumurise').val();
        var idbrand = $('#idbrand option:selected').val();
        var colors = $('input[name="colors"]:checked').map(function (index, element) {
            return this.value;
        }).get().join('!');
        var status = $('#status option:selected').val();

        if (idcat != '0' && name.length >= 3 && nameen.length >= 3) {
            $.ajax({
                url: 'function/addproduct.php',
                data: 'name='+name+ '&nameen=' + nameen + '&idcat=' + idcat + '&description=' + description + '&sumurise=' + sumurise + '&idbrand=' + idbrand + '&colors=' + colors + '&status=' + status,
                success: function (data) {
                    alert(data);
                }
            });

    }else {
        alert('مقادیر وردی را بررسی بکنید');
    }




    }
</script>