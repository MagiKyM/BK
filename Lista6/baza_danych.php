<?php

if (!isset($karol)) {
    echo ':(';
    die();
}

class BazaDanych {

    public function utworzUzytkownika($login, $email, $haslo) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "select login, email from uzytkownik where login = '" . mysqli_real_escape_string($conn, $login) . "' or email = '" . mysqli_real_escape_string($conn, $email) . "'";

        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            $_SESSION["komunikat"] = "NIE UTWORZONO KONTA. Podany login lub email już istnieje";
            $conn->close();
            return;
        }

        $sql = "insert into uzytkownik(login, email, haslo) values('" . mysqli_real_escape_string($conn, $login) . "', "
                . "'" . mysqli_real_escape_string($conn, $email) . "', md5('" . mysqli_real_escape_string($conn, $haslo) . "'))";
        $conn->query($sql) or die(mysqli_error($conn));
        $conn->close();

        $_SESSION["komunikat"] = "zapisano do bazy";
    }

    public function logowanie($login, $haslo) {
        $_SESSION['hash'] = md5(time() . rand(0, 100));
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "select login, id from uzytkownik where login = '" . mysqli_real_escape_string($conn, $login) . "' and haslo = md5('" . mysqli_real_escape_string($conn, $haslo) . "')";

        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($line = mysqli_fetch_array($result)) {
            $_SESSION["uzytkownik_id"] = $line["id"];
            $_SESSION["uzytkownik_login"] = $line["login"];
            $_SESSION["komunikat"] = "zalogowany";
        } else {
            $_SESSION["komunikat"] = "błędny login i/lub hasło";
        }

        $conn->close();
    }

    public function przypomnienie($email) {
        $hash = md5(time() . rand(0, 100));
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "select id from uzytkownik where email = '" . mysqli_real_escape_string($conn, $email) . "'";

        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($line = mysqli_fetch_array($result)) {
            $sql = "insert into przypomnienie(hash, uzytkownik_id, etap) values('" . $hash . "', " . $line["id"] . ", 0)";
            mysqli_query($conn, $sql);
            $_SESSION["komunikat"] = "na wskazany email zostanie wysłany link: "
                    . "<a href=\"index.php?akcja=przypomnienie&hash=" . $hash . "\">index.php?akcja=przypomnienie&hash=" . $hash . "</a>";
        } else {
            $_SESSION["komunikat"] = "brak podanego adresu e-mail w naszej bazie";
        }

        $conn->close();
    }

    public function ustawNoweHaslo($haslo, $hash) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "select uzytkownik_id from przypomnienie where hash = '" . mysqli_real_escape_string($conn, $hash) . "' and etap = 0";

        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($line = mysqli_fetch_array($result)) {
            $uzytkownik_id = $line["uzytkownik_id"];
            $sql = "update uzytkownik set haslo = md5('" . mysqli_real_escape_string($conn, $haslo) . "') where id = " . $uzytkownik_id;
            mysqli_query($conn, $sql);
            $sql = "update przypomnienie set etap = 1 where uzytkownik_id = " . $uzytkownik_id;
            mysqli_query($conn, $sql);
            $_SESSION["komunikat"] = "hasło zostało zmienione";
        } else {
            $_SESSION["komunikat"] = "błąd zmiany hasła";
        }

        $conn->close();
    }

    public function listaPrzelewow() {
        $wynik = array();
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "select data, nrb_odbiorcy, kwota from przelew where uzytkownik_id = " . $_SESSION["uzytkownik_id"] . " "
                . "and status > 0";

        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($line = mysqli_fetch_array($result)) {
            $rekord = array();
            $rekord[0] = $line["data"];
            $rekord[1] = $line["nrb_odbiorcy"];
            $rekord[2] = $line["kwota"];
            $wynik[] = $rekord;
        }

        $conn->close();
        return $wynik;
    }

    public function dodajPrzelew($nrb, $kwota) {
        $_SESSION['hash'] = md5(time() . rand(0, 100));
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "insert into przelew(uzytkownik_id, nrb_odbiorcy, kwota, hash, status, data) "
                . "values(" . $_SESSION["uzytkownik_id"] . ", '" . mysqli_real_escape_string($conn, $nrb) . "', "
                . $kwota . ", '" . $_SESSION["hash"] . "', 0, NOW())";
        $conn->query($sql) or die(mysqli_error($conn));
        $conn->close();
        $_SESSION["komunikat"] = "dodano przelew";
    }

    public function zatwierdzPrzelew($nrb, $kwota, $hash) {
        $_SESSION['hash'] = md5(time() . rand(0, 100));
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "update przelew set status = 1 where "
                . "hash = '" . mysqli_real_escape_string($conn, $hash) . "' "
                . "and nrb_odbiorcy = '" . mysqli_real_escape_string($conn, $nrb) . "' "
                . "and kwota = " . $kwota;
        $conn->query($sql) or die(mysqli_error($conn));
        $conn->close();
        $_SESSION["komunikat"] = "zatwierdzono przelew";
    }

}
