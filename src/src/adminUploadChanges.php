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
    mysqli_set_charset($db_link, 'utf8');
    $table = $_GET['table'];
    $column = $_GET['column'];
    $text = $_GET['text'];




    $qry = "Update `" .$table."` Set `".$column."` = '".$text."' WHERE 1";
    $queryInsertData = mysqli_query($db_link,$qry);



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