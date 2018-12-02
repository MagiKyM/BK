<?php
if (!isset($karol)) {
    die();
}
?>
<h1>Logowanie</h1>
<form id="formularz_logowania" action="" method="POST">
    <input name="hash" value="<?php echo $_SESSION['hash'] ?>" type="hidden">
    Użytkownik<br />
    <input name="login" id="form_login_text" autocomplete="off" type="text"><br /><br />
    Hasło<br />
    <input name="haslo" autocomplete="off" type="password"><br /><br />
    <input name="loguj" value="Loguj" autocomplete="off" type="submit">
    <br /><br />
</form>