<?php
$wiadomosc = "";
if (isset($_POST['wiadomosc'])) {
    $wiadomosc = $_POST['wiadomosc'];
}
?>
<h1>Wiadomość</h1>
<form id="formularz_wiadomosc" action="" method="POST">
    <?php echo $wiadomosc; ?>
</form>