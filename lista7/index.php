<?php
$karol = "test"; // zmienna potrzena aby się nie dostać bezpośrednio do plików, które są tutaj zaincludowane
date_default_timezone_set('Europe/Warsaw');
session_start();
if (!isset($_SESSION['hash'])) {
    $_SESSION['hash'] = md5(time() . rand(0, 100));
}
require_once 'konfiguracja.php';
require_once 'logika_strony.php';
;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bank KAROL</title>
        <link rel="stylesheet" type="text/css" href="css.css">
        <script src="js.js"></script> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="header">Bank KAROL</div>
        <div style="font-weight: bold;">Komunikat: <?php
            if (isset($_SESSION["komunikat"])) {
                echo $_SESSION["komunikat"];
                $_SESSION["komunikat"] = "";
            }
            ?></div>
        <div class="body">
            <?php
            if (isset($_GET['akcja']) && $_GET['akcja'] == "zakladanie_konta") {
                require_once 'widok_zakladanie_konta.php';
            } else if (isset($_GET['akcja']) && $_GET['akcja'] == "przypomnienie") {
                require_once 'widok_przypomnienie.php';
            } else if (isset($_GET['akcja']) && $_GET['akcja'] == "nowy_przelew") {
                require_once 'widok_nowy_przelew.php';
            } else if (isset($_GET['akcja']) && $_GET['akcja'] == "nowy_przelew_oczekiwanie") {
                require_once 'widok_nowy_przelew_oczekiwanie.php';
            } else if (isset($_GET['akcja']) && $_GET['akcja'] == "nowy_przelew_zatwierdzony") {
                require_once 'widok_nowy_przelew_zatwierdzony.php';
            } else if (isset($_GET['akcja']) && $_GET['akcja'] == "przelew_zatwierdzony_admin") {
                require_once 'widok_niepotwierdzone.php';
            } else if (isset($_GET['akcja']) && $_GET['akcja'] == "wiadomosci") {
                require_once 'widok_wiadomosci.php';
            } else if (isset($_GET['akcja']) && $_GET['akcja'] == "nowa_wiadomosc") {
                require_once 'widok_wiadomosci_wyswietl.php';
            } else if (isset($_GET['akcja']) && $_GET['akcja'] == "nowy_przelew_get") {
                require_once 'widok_nowy_przelew_get.php';
            } else {
                if (isset($_SESSION["uzytkownik_id"]) && $_SESSION["uzytkownik_id"] != "0") {
                   if (isset($_SESSION["uzytkownik_login"]) && $_SESSION["uzytkownik_login"] == "admin") {
                        require_once 'widok_niepotwierdzone.php';
                   } else {
                        require_once 'widok_historia_potwierdzonych.php';
                   }
                } else {
                    require_once 'widok_logowanie.php';
                }
            }
            ?>
        </div>
        <?php
        if (isset($_SESSION["uzytkownik_id"]) && $_SESSION["uzytkownik_id"] != "0") {
            if (isset($_SESSION["uzytkownik_login"]) && $_SESSION["uzytkownik_login"] == "admin") {
                echo "Zalogowany: " . $_SESSION["uzytkownik_login"] . "<br />";
                ?>
                <a href="index.php?akcja=wyloguj">Wyloguj</a> |
                <a href="index.php">Niepotwierdzone przelewy</a>
                <?php
            } else {
                echo "Zalogowany: " . $_SESSION["uzytkownik_login"] . "<br />";
                ?>
                <a href="index.php?akcja=wyloguj">Wyloguj</a> |
                <a href="index.php">Historia</a> |
                <a href="?akcja=nowy_przelew">Nowy przelew</a> |
                <a href="?akcja=wiadomosci">Wiadomości</a><br /><br />
                <?php
            }
        } else {
            ?>
            <a href="index.php">Strona logowanie</a> |
            <a href="?akcja=zakladanie_konta">Zakładanie konta</a> |
            <a href="?akcja=przypomnienie">Nie pamiętasz login i/lub hasło?</a><br /><br />
            <?php
        }
        ?>
        <div class="footer">Bezpieczeństwo komputerowe<br />Laboratorium - lista nr 7, 9 XII 2018</div>
    </body>
</html>

<?php
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
?>