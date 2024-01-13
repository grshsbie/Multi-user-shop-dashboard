<?php
include_once("config_admin.php");
?>

<?php
$title = "خانه اندروید";
if (isset($_REQUEST['action'])) {
    $url = sqi($_REQUEST['action']);
    $r = getrecord("tbl_menu", "url='$url'");
    if (count($r) > 0) {
        $title .= ' | ' . $r[0]['name'];

    }
}

include_once("include/header.php");
if (isset($_REQUEST['action'])) {
    $url = sqi($_REQUEST['action']);
    $r = getrecord("tbl_menu", "url='$url'");
    if (count($r) > 0) {
        $file = 'include/' . $r[0]['url'] . '.php';
        if (file_exists($file)) {
            echo '<div id="body">';
            echo '<div class="titlebody">' . $r[0]['name'] . '</div>';
            include_once($file);
            echo '</div>';
            echo '</div>';

        } else {
            include_once("include/500.php");
        }
    } else {
        include_once("include/500.php");
    }
} else {
    include_once("include/index.php");
}
include_once("include/footer.php");
?>