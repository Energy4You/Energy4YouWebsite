<?php
echo "aufruf";

define ( 'MYSQL_HOST',      'localhost' );
define ( 'MYSQL_BENUTZER',  'root' );
define ( 'MYSQL_KENNWORT',  '' );
define ( 'MYSQL_DATENBANK', 'u211528407_e4u' );

    $db_link = mysqli_connect(MYSQL_HOST,
        MYSQL_BENUTZER,
        MYSQL_KENNWORT,
        MYSQL_DATENBANK);

    if ($db_link) {

    }
    else
    {
        echo "Die Datenbank konnte keine Verbindung zu MySQL herstellen.";
    }
?>