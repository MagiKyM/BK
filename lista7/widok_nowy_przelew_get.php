<?php
$nrb = "";
$kwota = "";
if (isset($_GET['nrb'])) {
    $nrb = $_GET['nrb'];
}
if (isset($_GET['kwota'])) {
    $kwota = $_GET['kwota'];
}
?>
<h1>Oczekiwanie na potwierdzenie przelewu</h1>
<form id="formularz_nowy_przelew" action="" method="POST">
    NRB odbiorcy: <b><?php echo $nrb; ?></b><br />
    <input name="nrb" value="<?php echo $nrb; ?>" type="hidden">
    Kwota przelewu: <b><?php echo $kwota; ?></b><br /><br />
    <input name="kwota" value="<?php echo $kwota; ?>" type="hidden">
    Przelew oczekuje na zatwierdzenie przez administratora
    <br /><br />
</form>