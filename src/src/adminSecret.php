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
        die('Bevor Sie diese Seite betreten können, müssen sie sich <a href="admin.php">einloggen</a>');
    }
    else
    {

        echo '<div style="margin-left: 40%;color: #0098D4;font-family: "Calibri Light">';
        echo '<h1> Website- Edit</h1>';
        echo '</div>';
    }
?>
</body>
</html>
