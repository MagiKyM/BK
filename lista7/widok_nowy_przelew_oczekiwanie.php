<?php
$nrb = "";
$kwota = "";
if (isset($_POST['nrb'])) {
    $nrb = $_POST['nrb'];
}
if (isset($_POST['kwota'])) {
    $kwota = $_POST['kwota'];
}
?>
<h1>Oczekiwanie na zatwierdzenie przelewu</h1>
<form id="formularz_nowy_przelew" action="" method="POST">
    NRB odbiorcy: <b><span id="nrb_do_podmiany"><?php echo $nrb; ?></b><br />
    <input name="nrb" id="input_nrb_do_podmiany" value="<?php echo $nrb; ?>" type="hidden">
    Kwota przelewu: <b><?php echo $kwota; ?></b><br /><br />
    <input name="kwota" value="<?php echo $kwota; ?>" type="hidden">
    Przelew oczekuje na zatwierdzenie przez administratora
    <br /><br />
</form>
<script>
    window.addEventListener("load", podmienNRBnaPrawdziwe);
</script>