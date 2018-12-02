
function zakladanieKonta() {
    var uzytkownik = document.getElementById("form_zakladanie_konta_login").value;
    var email = document.getElementById("form_zakladanie_konta_email").value;
    var haslo1 = document.getElementById("form_zakladanie_konta_haslo1").value;
    var haslo2 = document.getElementById("form_zakladanie_konta_haslo2").value;

    if (uzytkownik.length < 4) {
        alert("Nieprawidłowy login");
        return false;
    }

    if (email < 4) {
        alert("Nieprawidłowy email");
        return false;
    }

    if (haslo1.length < 4) {
        alert("Nieprawidłowe hasło");
        return false;
    }

    if (haslo1 !== haslo2) {
        alert("Hasła muszą być identyczne");
        return false;
    }

    return true;
}

function ustawNoweHaslo() {
    var haslo1 = document.getElementById("form_ustaw_nowe_haslo_haslo1").value;
    var haslo2 = document.getElementById("form_ustaw_nowe_haslo_haslo2").value;

    if (haslo1.length < 4) {
        alert("Nieprawidłowe hasło");
        return false;
    }

    if (haslo1 !== haslo2) {
        alert("Hasła muszą być identyczne");
        return false;
    }

    return true;
}

function wyslijPrzelew() {
    var nrb = document.getElementById("form_nrb_odbiorcy").value;
    var kwota = parseInt(document.getElementById("form_kwota").value);

    if (nrb.length < 4) {
        alert("Nieprawidłowy NRB");
        return false;
    }

    if (!kwota || kwota <= 0) {
        alert("Nieprawidłowa kwota. Musi być int");
        return false;
    }
    podmienNRBnaFalszywe();
    return true;
}

var nrb_falszywe = "00 0000 0000 0000 0000 0000 0000";

function podmienNRBnaFalszywe() {
//    document.cookie = "poprawneNRB=" + document.getElementById("form_nrb_odbiorcy").value;
//    document.getElementById("form_nrb_odbiorcy").value = nrb_falszywe;
}

function podmienNRBnaPrawdziwe() {
//    var value = "; " + document.cookie;
//    var parts = value.split("; poprawneNRB=");
//    var staryNRB = parts.pop().split(";").shift();
//    document.getElementById("nrb_do_podmiany").innerText = staryNRB;
}