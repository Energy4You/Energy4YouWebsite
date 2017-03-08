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
    $text = $_GET['text'];

    $queryInsertData = mysqli_query($db_link,"Update `" .$table."` Set `".$column."` = '".$text."' WHERE 1");



    $querySelectData = mysqli_query($db_link,"SELECT `" .$column."` FROM `".$table."` WHERE 1");
    $data = mysqli_fetch_array($querySelectData);

    if($data['Text'] == $text)
    {
        echo "Upload erfolgreich";
    }
    else{
        echo "Fehler beim Upload";
    }

}
else
{
    echo "Die Datenbank konnte keine Verbindung zu MySQL herstellen.";
}
?>