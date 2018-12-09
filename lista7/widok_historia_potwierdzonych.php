<?php 
//if (!isset($karol)) {
//    die();
//}
?>
<h1>Historia potwierdzonych</h1>

<table style="width:500px;">
    <tr>
        <th>Data</th>
        <th>NRB odbiorcy</th>
        <th>Kwota</th>
    </tr>
    <?php
    require_once 'baza_danych.php';
    $bazaDanych = new BazaDanych();
    if(isset($_POST["nrb"]) && $_POST["nrb"] != "") {
        $przelewy = $bazaDanych->listaPrzelewowSzukaj($_POST["nrb"]);
    } else {
        $przelewy = $bazaDanych->listaPrzelewow();
    }
    foreach ($przelewy as $rekord) {
        echo "<tr>";
        echo "<td>";
        echo $rekord[0];
        echo "</td>";
        echo "<td>";
        echo $rekord[1];
        echo "</td>";
        echo "<td>";
        echo $rekord[2];
        echo "</td>";
        echo "</tr>";
    }
    ?>
    <form id="formularz_historia_szukaj" action="index.php" method="POST">
        NRB odbiorcy<br />
        <input name="nrb" id="form_nrb_szukaj" autocomplete="off" type="text"><br /><br />
        <input name="wyszukaj" value="Wyszukaj" autocomplete="off" type="submit">
        <br /><br />
    </form>
</table> 