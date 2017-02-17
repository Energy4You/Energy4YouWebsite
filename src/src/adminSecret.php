<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SAdmin</title>

    <link href="adminCss.css" type="text/css" rel="stylesheet">
    <script src="adminJS.js"></script>
</head>
<body>

<?php
if (!isset($_SESSION['login']))
{
    die('Bevor Sie diese Seite betreten können, müssen sie sich <a href="admin.php">einloggen!</a>');
}
?>

        <div style="margin-left: 40%;color: #0098D4;font-family: "Calibri Light">
        <h1> Websitebearbeitung</h1>
        </div>

        <div style="margin-left:40%;margin-top:5%;font-family: "Calibri Light";>
        <h2 style="margin-left: -8%"> Bitte wählen sie die gewünschte Kategorie aus</h2>

        <select id="tableSelect" style="width: 10%;">
        <option value="hauptseitetext" selected="selected">Hauptseite</option>
        <option value="lebenslauftext">Lebenslauf</option>
        <option value="kontakttext">Kontakt</option>
        </select>

        <button onclick="getData()"> Auswahl bestätigen</button>

        </div>
        <div id="divtextArea" >
            <textarea id="textArea" style="margin-top: 1%;margin-left: 23%;width: 1000px;height: 500px;">

            </textarea>
        </div>



<?php

function rowcolumn($actionBTN)
{
    $db_link = mysqli_connect(MYSQL_HOST,
        MYSQL_BENUTZER,
        MYSQL_KENNWORT,
        MYSQL_DATENBANK);

    $selectedItem = $actionBTN;

    if ($db_link) {

    }
    else
    {
        echo "Die Datenbank konnte keine Verbindung zu MySQL herstellen.";
    }
}
?>

</body>
</html>
