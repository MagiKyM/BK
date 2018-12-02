<?php
if (!isset($karol)) {
    die();
}
$hash = "";
$nrb = "";
$kwota = "";
if (isset($_POST['hash'])) {
    $hash = $_POST['hash'];
}
if (isset($_POST['nrb'])) {
    $nrb = $_POST['nrb'];
}
if (isset($_POST['kwota'])) {
    $kwota = $_POST['kwota'];
}
?>
<h1>Przelew zatwierdzony</h1>
