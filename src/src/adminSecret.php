<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
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
        </div>

        <div id="pointEdit">
            <div>
            <Button style="margin-left: 36%" onclick="rowcolumn('hauptseitetext')">Hauptseite</Button>
            <Button>Anschrift</Button>
            <Button>E-Mail</Button>
            <Button>Telefon</Button>
            <Button>Lebenslauf</Button>
            <Button>Ausbildung</Button>
            </div>
            <textarea style="height: 400px;width: 600px;margin-left: 32%;margin-top: 1%;">

            </textarea>
        </div>


        <div id="pictureUpload" style="margin-left: 36%">
            <h2>Bilder Upload</h2>

            <form style="margin-top: 1%" action="upload.php" method="post" enctype="multipart/form-data">
                <input type="file" name="file" id="passedFile">
                <input type="submit" name="btn[upload]">
            </form>
        </div>

    <script>
        function rowcolumn($table) {
            alert("hallo");
            $name = "editTextPHP.php";
            alert('<?php
                include ($name);
                ?>');
        }
    </script>
</body>
</html>
