<?php
$r = getrecord("tbl_cat", "subid = 0");
?>

<table class='table' width="100%">
    <thead>
        <tr>
            <th>ردیف</th>
            <th>شناسه</th>
            <th>نام دسته</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //اونهایی رو به من بده که subid برابر صفر باشه
        $r = getrecord("tbl_cat", "subid=0");
        $i = 1;
        foreach ($r as $key) { ?>
            <tr>
                <td>
                    <?= $i++ ?>
                </td>
                <td>
                    <?= $key['idcat'] ?>
                </td>
                <td>
                    <?= $key['name'] ?>
                </td>
                <td>
                    <a href="<?= URL ?>index.php?action=list_cat&idcat=<?= $key['idcat'] ?>">
                        <i class="icon-plus"></i>
                    </a>
                </td>
            </tr>

            <?php
        }
        ?>

    </tbody>
</table>


<?php
if (isset($_GET['action']) and isset($_GET['idcat'])) {
    $action = sqi($_GET['action']);
    $idcat = (int) sqi($_GET['idcat']);
    if($action == "list_cat" AND $idcat !== ''){
        $s= getrecord("tbl_cat", "subid =$idcat");
        if(count($s) > 0 ){
         echo ' 
         <table class=\'table\' width="100%">
            <thead>
             <tr>
                <th>ردیف</th>
                <th>شناسه</th>
                <th>نام دسته</th>
                <th>عملیات</th>
            </tr>
            </thead>
         <tbody> 
         ';

 
         //اونهایی رو به من بده که subid برابر صفر باشه
         $i = 1;
         foreach ($s as $sub) { ?>
             <tr>
                 <td>
                     <?= $i++ ?>
                 </td>
                 <td>
                     <?= $sub['idcat'] ?>
                 </td>
                 <td>
                     <?= $sub['name'] ?>
                 </td>
                 <td>
                     <a href="<?= URL ?>index.php?action=list_cat&idcat=<?= $sub['idcat'] ?>">
                         <i class="icon-plus"></i>
                     </a>
                 </td>
             </tr>
 
             <?php
         }
     





         echo'
         </tbody>
         </table>
         ';
        }
    }
}else {
    echo "choose somthing";
}
?>