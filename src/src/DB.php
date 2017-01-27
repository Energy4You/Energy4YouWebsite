<?php
login($_POST["userName"],$_POST['password']);

function login($username, $passwort)
{
    error_reporting(E_ALL);

    // Zum Aufbau der Verbindung zur Datenbank
    define ( 'MYSQL_HOST',      'localhost' );
    define ( 'MYSQL_BENUTZER',  'root' );
    define ( 'MYSQL_KENNWORT',  '' );
    define ( 'MYSQL_DATENBANK', 'u211528407_e4u' );

    $db_link = mysqli_connect (MYSQL_HOST,
            MYSQL_BENUTZER,
            MYSQL_KENNWORT,
            MYSQL_DATENBANK);

    if ( $db_link )
    {
        mysqli_set_charset($db_link, 'utf8');
        $queryLogin = mysqli_query($db_link,"SELECT `Username`, `Password` FROM `logintabelle` WHERE 1");
        $row = mysqli_fetch_array($queryLogin);

        $usernameDB = $row['Username'];
        $passwordDB = $row['Password'];


        /*$doc = new DOMDocument();
        $doc -> validateOnParse = true;
        $doc -> Load('admin.php');*/

        $usernameGiven = $username;
        $passwordGiven = $passwort;

/*      echo $usernameDB;
        echo $passwordDB;

        echo $usernameGiven;
        echo $passwordGiven;*/

        session_start();

        if(sha1($passwordGiven)===$passwordDB && $usernameDB ==$usernameGiven)
        {
            echo "LOGIN ERFOLGREICH";

        }
        else{
            echo "USERNAME ODER PASSWORT FALSCH";
        }


    }
    else
    {
        die('keine Verbindung möglich: ' . mysqli_error());
    }
}
?>