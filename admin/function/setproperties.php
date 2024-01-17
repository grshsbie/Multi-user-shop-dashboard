<?php
include_once("../config_admin.php");
if (isset($_REQUEST['idproducts'])) {
    $idproduct = (int) sqi($_REQUEST['idproducts']);
    foreach ($_REQUEST as $key => $value) {
        // i need id forn variables 
        $p = explode('-', $key);
        if (count($p) == 2 and @$p[0] == 'idproperties') {
            $idproperties = $p[1];
            delet_record("tblper_product", "idproperties='$idproperties' and idproducts='$idproduct'");
            if ($value !== "") {
                $add = addrecord
                (
                    "tblper_product",
                    array(
                        "value" => $value,
                        "idproperties" => $idproperties,
                        "idproducts" => $idproduct
                    )
                );

            }

        }
    }
    echo 'ok';
} else {
    echo 'Error';
}

?>