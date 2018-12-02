<?php
if (!isset($karol)) {
    die();
}
?>
<h1>Zakładanie konta</h1>
<form id="formularz_zakladanie_konta" action="" method="POST">
    Użytkownik login<br />
    <input name="login" id="form_zakladanie_konta_login" autocomplete="off" type="text"><br /><br />
    E-mail<br />
    <input name="email" id="form_zakladanie_konta_email" autocomplete="off" type="text"><br /><br />
    Hasło<br />
    <input name="haslo1" id="form_zakladanie_konta_haslo1" autocomplete="off" type="password"><br /><br />
    Potwierdź hasło<br />
    <input name="haslo2" id="form_zakladanie_konta_haslo2" autocomplete="off" type="password"><br /><br />
    <input name="utworz" value="Utworz" autocomplete="off" type="submit" onclick="return zakladanieKonta()">
    <br /><br />
</form>
