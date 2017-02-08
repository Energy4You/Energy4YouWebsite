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



        $usernameGiven = $username;
        $passwordGiven = $passwort;


        if(sha1($passwordGiven)===$passwordDB && $usernameDB ==$usernameGiven)
        {
            session_start();
            $_SESSION['login'] = $usernameDB;
            include ('adminSecret.php');
        }
        else{
            die('Ihr Passwort oder Usernam ist falsch. Bitte kehren sie zurück um sich  <a href="admin.php">einzuloggen!</a>');
            session_start();
            session_destroy();
        }
    }
    else
    {
        die('keine Verbindung möglich: ' . mysqli_error());
    }
}
?>