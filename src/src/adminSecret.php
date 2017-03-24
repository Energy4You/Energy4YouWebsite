<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Websitebearbeitung</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <link href="adminSecretCss.css" type="text/css" rel="stylesheet">
    <script src="adminJS.js"></script>
</head>
<body>

<?php
if (!isset($_SESSION['login']))
{
    die('Bevor Sie diese Seite betreten können, müssen sie sich <a href="admin.php">einloggen!</a>');
}
?>
<div class="center">
        <div  >
        <h1 id="title"> Websitebearbeitung</h1>
        </div>

        <div >
        <h2 id="instruction"> Bitte wählen sie die gewünschte Kategorie aus</h2>
        </div>

        <div id="pointEdit">
            <div>
            <Button onclick="rowcolumn('hauptseitetext','Text')">Hauptseite</Button>
            <Button onclick="rowcolumn('kontakttext','Anschrift')">Anschrift</Button>
            <Button onclick="rowcolumn('kontakttext','Email')">E-Mail</Button>
            <Button onclick="rowcolumn('kontakttext','Telefon')">Telefon</Button>
            <Button onclick="rowcolumn('lebenslauftext','Lebenslauf')">Lebenslauf</Button>
            <Button onclick="rowcolumn('lebenslauftext','Ausbildung')">Ausbildung</Button>
            </div>
            <pre id="TextFontPre">
<textarea id="textAreaEdit"> Zu bearbeitender Text</textarea>
            </pre>
            <input type="submit" value="Bestätigen" onclick="writeToDatabase()">
        </div>
    </br></br>


        <div id="pictureUpload" >
            <h2>Bilder Upload</h2>

            <form id="uploadpic" action="upload.php" method="post" enctype="multipart/form-data">
                <input id="getFile" type="file" name="file" id="passedFile">
                <input id="upload" type="submit" name="btn[upload]" value="Upload">
            </form>
        </div>
</div>
    <script>

        var table;
        var column;

        function rowcolumn($table,$column) {
            //alert('Tabelle: ' + $table + ', Spalte: ' + $column);
            table = $table;
            column = $column;

            $.ajax({
                type: "GET",
                contentType: "application/json;charset-utf-8",
                url: 'adminTextEdit.php',
                data: {table:$table,column:$column},
                success: function (text) {
                    var result = text;
                    $('#textAreaEdit').text('');
                    $('#textAreaEdit').append(result);
                }
            });
        }

        function writeToDatabase()
        {
            //alert('Upload data');

            $text = $('#textAreaEdit').val();
            alert($text);
            $.ajax({
                type: "GET",
                contentType: "application/json;charset-utf-8",
                url: 'adminUploadChanges.php',
                data: {table:table,column:column,text:$text},
                success: function (text) {
                    var result = text;
                    alert(result);
                }
            });
        }
    </script>
</body>
</html>
