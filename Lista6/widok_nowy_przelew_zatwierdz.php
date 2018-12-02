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
<h1>Zatwierdź nowy przelew</h1>
<form id="formularz_nowy_przelew" action="index.php?akcja=nowy_przelew_zatwierdzony" method="POST">
    <input name="hash" value="<?php echo $_SESSION["hash"]; ?>" type="hidden">
    NRB odbiorcy: <b><span id="nrb_do_podmiany"><?php echo $nrb; ?></b><br />
    <input name="nrb" id="input_nrb_do_podmiany" value="<?php echo $nrb; ?>" type="hidden">
    Kwota przelewu: <b><?php echo $kwota; ?></b><br /><br />
    <input name="kwota" value="<?php echo $kwota; ?>" type="hidden">
    <input name="zatwierdz" value="Zatwierdź" autocomplete="off" type="submit">
    <br /><br />
</form>
<script>
    window.addEventListener("load", podmienNRBnaPrawdziwe);
</script>