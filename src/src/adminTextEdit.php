<?php

define ( 'MYSQL_HOST',      'localhost' );
define ( 'MYSQL_BENUTZER',  'root' );
define ( 'MYSQL_KENNWORT',  '' );
define ( 'MYSQL_DATENBANK', 'u211528407_e4u' );

$db_link = mysqli_connect(MYSQL_HOST,
    MYSQL_BENUTZER,
    MYSQL_KENNWORT,
    MYSQL_DATENBANK);

if ($db_link) {

    $table = $_GET['table'];
    $column = $_GET['column'];

    $querySelectData = mysqli_query($db_link,"SELECT `" .$column."` FROM `".$table."` WHERE 1");
    $data = mysqli_fetch_array($querySelectData);

    echo $data['Text'];
}
else
{
    echo "Die Datenbank konnte keine Verbindung zu MySQL herstellen.";
}
?>