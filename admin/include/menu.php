<div id="menu">

    <?php
    $r = getrecord("tbl_menu", "subitem=0");
    //var_dump($r)
    foreach ($r as $key) {
        $icon = $key['icon'];
        $itemname = $key['name'];

        $sub = getrecord("tbl_menu", "subitem=$key[idmenu]");
        if (count($sub) > 0) {
            $subitem = true;

        } else {
            $subitem = false;

        }

        if ($key['url'] == '') {
            $link = 'index.php';
        } else {
            $link = 'index.php?action=' . $key['url'];

        }

        if ($subitem == false) {
            echo '
            <a href="' . URL . $link . '">
                <div class="item-menu">
                    <i class="' . $icon . '"></i>
                    <div class="name-menu">
                    ' . $key['name'] . '
                    </div>
                </div>
            </a>';

        } else {
            echo '       
                <div class="item-menu">
                    <i class="' . $icon . '"></i>
                    <div class="name-menu">
                    ' . $key['name'] . '
                    </div> 
                    <div class="showsubitem"><i class="icon-chevron-sign-down"></i></div>
                    <div class="sub-menu">'; //end of echo 
    
            foreach ($sub as $keysub) {
                $link = 'index.php?action=' . $keysub['url'];
                $icon = $keysub['icon'];
                $itemname = $keysub['name'];
                echo '
                <a href="' . URL . $link . '">
                    <div class="item-menu">
                        <i class="' . $icon . '"></i>
                        <div class="name-menu">
                        ' . $itemname . '
                        </div>
                    </div>
                </a>';
            }

            echo '</div></div>';


        }

    }

    ?>


</div>




















<!-- <div class="item-menu">
                <i class="">دسته بندی ها</i>
                <Div class="name-menu"></Div>
                <div class="showsubitem">
                <i class="icon-chevron-sign-down"></i>
        </div> -->

<!-- <div class="sub-menu">
            <a href="">
                <div class="item-menu">
                    <i class=""></i>
                <Div class="name-menu"></Div>
                </div>
            </a>
        </div> -->