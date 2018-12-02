<?php

if (!isset($karol)) {
    echo ':(';
    die();
}
require_once 'baza_danych.php';
$bazaDanych = new BazaDanych();

if (isset($_GET['akcja']) && $_GET['akcja'] == "wyloguj") {
    $_SESSION["uzytkownik_id"] = "0";
    $_SESSION["uzytkownik_login"] = "";
    $_SESSION["komunikat"] = "wylogowany";
}

if (isset($_GET["akcja"]) && $_GET["akcja"] == "zakladanie_konta") {
    if (isset($_POST["email"]) && isset($_POST["haslo1"]) && isset($_POST["haslo2"]) && isset($_POST["login"])) {
        $bazaDanych->utworzUzytkownika($_POST["login"], $_POST["email"], $_POST["haslo1"]);
    }
}

if (isset($_POST["loguj"]) && isset($_POST["login"]) && isset($_POST["haslo"]) &&
        isset($_POST["hash"]) && $_POST["hash"] == $_SESSION["hash"]) {
    $bazaDanych->logowanie($_POST["login"], $_POST["haslo"]);
}

if (isset($_GET["akcja"]) && $_GET["akcja"] == "przypomnienie") {
    if (isset($_POST["email"])) {
        $bazaDanych->przypomnienie($_POST["email"]);
    } else if (isset($_POST["haslo1"]) && isset($_POST["haslo2"]) && isset($_POST["hash_nowe"])) {
        $bazaDanych->ustawNoweHaslo($_POST["haslo1"], $_POST["hash_nowe"]);
    }
}

if (isset($_GET["akcja"]) && $_GET["akcja"] == "nowy_przelew_zatwierdz" &&
        isset($_POST["nrb"]) && isset($_POST["kwota"]) &&
        isset($_POST["hash"]) && $_POST["hash"] == $_SESSION["hash"] && isset($_POST["wyslij"])) {
    $bazaDanych->dodajPrzelew($_POST["nrb"], (int) $_POST["kwota"]);
}

if (isset($_GET["akcja"]) && $_GET["akcja"] == "nowy_przelew_zatwierdzony" &&
        isset($_POST["nrb"]) && isset($_POST["kwota"]) &&
        isset($_POST["hash"]) && $_POST["hash"] == $_SESSION["hash"] && isset($_POST["zatwierdz"])) {
    $bazaDanych->zatwierdzPrzelew($_POST["nrb"], (int) $_POST["kwota"], $_POST["hash"]);
}

