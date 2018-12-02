<?php
if (!isset($karol)) {
    die();
}
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
    $przelewy = $bazaDanych->listaPrzelewow();
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
</table> 