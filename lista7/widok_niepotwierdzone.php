<h1>Niepotwierdzone przelewy</h1>

<table style="width:500px;">
    <tr>
        <th>ID</th>
        <th>Data</th>
        <th>ID nadawcy</th>
        <th>NRB odbiorcy</th>
        <th>Kwota</th>
    </tr>
    <?php
    require_once 'baza_danych.php';
    $bazaDanych = new BazaDanych();
    $przelewy = $bazaDanych->listaNiepotwierdzonych();
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
        echo "<td>";
        echo $rekord[3];
        echo "</td>";
        echo "<td>";
        echo $rekord[4];
        echo "</td>";
        echo "</tr>";
    }
    ?>
    <form id="formularz_zatwierdzania" action="" method="GET">
        ID<br />
        <input name="akcja" autocomplete="off" type="hidden" value = "przelew_zatwierdzony_admin">
        <input name="id" id="form_id_text" autocomplete="off" type="text"><br /><br />
        <input value="Zatwierdź" autocomplete="off" type="submit">
        <br /><br />
    </form>
</table> 