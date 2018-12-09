<h1>Nowy przelew</h1>
<form id="formularz_nowy_przelew" action="index.php?akcja=nowy_przelew_oczekiwanie" method="POST">
    NRB odbiorcy<br />
    <input name="nrb" id="form_nrb_odbiorcy" autocomplete="off" type="text"><br /><br />
    Kwota przelewu<br />
    <input name="kwota" id="form_kwota" autocomplete="off" type="text"><br /><br />
    <input name="wyslij" value="Wyślij" autocomplete="off" type="submit" onclick="return wyslijPrzelew()">
    <br /><br />
</form>