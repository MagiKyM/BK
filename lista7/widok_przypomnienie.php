<h1>Przypomnienie</h1>
<?php
if (isset($_GET["hash"])) {
    ?>
    <form id="formularz_ustaw_nowe_haslo" action="index.php?akcja=przypomnienie" method="POST">
        Hasło<br />
        <input name="hash_nowe" id="hash_nowe" value="<?php echo $_GET["hash"]; ?>" type="hidden">
        <input name="haslo1" id="form_ustaw_nowe_haslo_haslo1" autocomplete="off" type="password"><br /><br />
        Potwierdź hasło<br />
        <input name="haslo2" id="form_ustaw_nowe_haslo_haslo2" autocomplete="off" type="password"><br /><br />
        <input name="ustaw" value="Ustaw nowe" autocomplete="off" type="submit" onclick="return ustawNoweHaslo()">
        <br /><br />
    </form>
    <?php
} else {
    ?>
    <form id="formularz_przypomnienie" action="index.php?akcja=przypomnienie" method="POST">
        Podaj adres e-mail w systemie<br />
        <input name="email" id="form_przypomnienie_email_id" autocomplete="off" type="text"><br /><br />
        <input name="przypomnij" value="Przypomnij" autocomplete="off" type="submit">
        <br /><br />
    </form>
    <?php
}
?>