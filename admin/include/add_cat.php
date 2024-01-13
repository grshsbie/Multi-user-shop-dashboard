<div class="form">
    <div class="row">
        <div class="name">
            <label for="name">نام دسته بندی</label>
        </div>
        <div class="input"><input type="text" id="name" placeholder="نام دسته بندی را وارد کنید"></div>
    </div>

    <div class="row">
        <div class="name">
            <label for="nameen">نام انگیلیسی دسته بندی</label>
        </div>
        <div class="input"><input type="text" id="nameen" placeholder="نام انگیلیسی را وارد کنید"></div>
    </div>

    <div class="row">
        <div class="name">
            <label for="nameen">انتخاب دسته ولد</label>
        </div>
        <div class="input">
            <select name="" id="subid">
                <option value="0" selected>دسته والد</option>
                <?php
                $r = getrecord("tbl_cat", "subid=0");
                foreach ($r as $key) {
                    echo "  <option value='$key[idcat]' >- $key[name]</option>";
                    $s = getrecord("tbl_cat", "subid='$key[idcat]'");
                    if (count($s) > 0) {
                        foreach ($s as $sub) {
                            echo "<option value='$sub[idcat]' >-- $sub[name]</option>";
                        }
                    }
                }
                ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="btn btn-success" onclick="addcat()">دسته بندی جدید</div>
    </div>

</div>


<script>
    function addcat() {
        var name = $('#name').val();
        var nameen = $('#nameen').val();
        var subid = $('#subid option:selected').val();
        if (name.length >= 3 && nameen.length >= 3 && subid) {
            $.ajax({
                url: 'function/addcat.php',
                type: 'POST',
                data: 'name=' + name + '&nameen=' + nameen + '&subid=' + subid,
                success: function (data) {
                    alert(data);
                }
            });
        } else {
            alert('مقادیر فیلد را وارد کنید');
        }
    }
</script>