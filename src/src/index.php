<!DOCTYPE html>
<html>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="../gallery/jquery.bxslider.min.js"></script>
    <link href="../gallery/jquery.bxslider.css" type="text/css" rel="stylesheet" />
    <script src="js.js"></script>
    <meta charset="UTF-8">
    <link href="style.css" type="text/css" rel="stylesheet">
    <title>Energy4You</title>
</head>
<body>

<ul class="nav">
    <li class="firstListItemMenuTop"><a id="pHomeColor" href="#pointHome">Home</a></li>
    <li><a href="#pointGalerie">Galerie</a></li>
    <li><a href="#pointCalender">Kalender</a></li>
    <li><a href="#pointContact">Kontakt</a></li>
    <li><a href="#pointAbout">Über mich</a></li>
</ul>

<?php
    define ( 'MYSQL_HOST',      'localhost' );
    define ( 'MYSQL_BENUTZER',  'root' );
    define ( 'MYSQL_KENNWORT',  '' );
    define ( 'MYSQL_DATENBANK', 'u211528407_e4u' );

    $db_link = mysqli_connect (MYSQL_HOST,
        MYSQL_BENUTZER,
        MYSQL_KENNWORT,
        MYSQL_DATENBANK);

    if ( $db_link ) {
        mysqli_set_charset($db_link, 'utf8');
        $queryHome = mysqli_query($db_link,"SELECT `Überschrift`, `Text` FROM `hauptseitetext` WHERE 1");
        $queryContact = mysqli_query($db_link,"SELECT `Anschrift`, `Email`, `Telefon` FROM `kontakttext` WHERE 1");
        $queryAbout = mysqli_query($db_link,"SELECT `Lebenslauf`, `Ausbildung` FROM `lebenslauftext` WHERE 1");
        $rowHome = mysqli_fetch_array($queryHome);
        $rowContact = mysqli_fetch_array($queryContact);
        $rowAbout = mysqli_fetch_array($queryAbout);
        $homeueberschrift= $rowHome['Überschrift'];
        $hometext = $rowHome['Text'];
        $contactanschrift = $rowContact['Anschrift'];
        $contactemail = $rowContact['Email'];
        $contacttelefon = $rowContact['Telefon'];
        $aboutlebenslauf = $rowAbout['Lebenslauf'];
        $aboutausbildung = $rowAbout['Ausbildung'];
    }
?>

<div id="pointHome" class="main">

    <div class="HomeDiv">
        <p>
            <?php echo $hometext; ?>
        </p>
    </div>
</div>


<?php

    //Bilder vom FTP DOWNLOADEN

    $ftp_server = "zerbru.bplaced.net";
    $ftp_user_name = "zerbru";
    $ftp_user_pass = "energie";
    $destination_file = "/Galerie/";

    $conn = ftp_connect($ftp_server);
    $login_result = ftp_login($conn, $ftp_user_name,$ftp_user_pass);

    // check connection
    if ((!$conn) || (!$login_result)) {
        echo "FTP connection has failed!";
        echo "Attempted to connect to $ftp_server for user $ftp_user_name";
        exit;
    }
    ftp_pasv($conn, true);

    $images = ftp_nlist($conn, $destination_file);
    $count = 0;
    foreach ($images as $image){

        if ($image !== '.' && $image !== '..'){
            $picture =$count . '.jpg';

            $ret = ftp_get($conn,'..\ressources\\'.$picture,"$destination_file$image",FTP_BINARY);
        }
        $count = $count+1;
    }

    ftp_close($conn);

    $alledateien = scandir('..\ressources');

?>



<div id="pointGalerie" class="galerie">
    <div class="galeryLayout">

     <ul class="carouselPager" id="bx-pager">
         <?php

            $linkcount = 0;
         foreach ($alledateien as $datei){

             if ($datei !== '.' && $datei !== '..') {

                 ?>
                 <a data-slide-index="<?php echo $linkcount; ?>" href=""><img class="thumber"
                                                                              src="../ressources/<?php echo $datei; ?>"/></a>
                 <?php
                 $linkcount = $linkcount + 1;
             }
         }

         ?></ul>


        <ul class="bxslider">
            <?php
                foreach ($alledateien as $data){
                    if ($data !== '.' && $data !== '..'){

                    ?>
                    <li><img src="../ressources/<?php echo $data; ?>" /></li>
                    <?php
            }
                }
            ?>

        </ul>

    </div>
</div>
<script src="gallery.js" type="text/javascript"></script>




<div id="pointCalender" class="calender">
    <div class="googleCalender">
        <iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showCalendars=0&amp;showTz=0&amp;mode=WEEK&amp;height=600&amp;wkst=2&amp;hl=de&amp;bgcolor=%23ccccff&amp;src=nico.prechtl171%40gmail.com&amp;color=%23B1365F&amp;ctz=Europe%2FVienna" style="border:solid 1px #777" width="1200" height="600" frameborder="0" scrolling="no"></iframe>
         </div>
    </div>
<div id="pointContact" class="contact">
    <div class="ContactDiv">
        <p>
            <?php echo $contactemail; ?>
        </p>
        <p>
            <?php echo $contactanschrift; ?>
        </p>
        <p>
            <?php echo $contacttelefon; ?>
        </p>
    </div>
</div>

<div id="pointAbout" class="about">
    <div class="AboutDiv">
        <p>
            <?php echo $aboutlebenslauf; ?>
        </p>
        <p>
            <?php echo $aboutausbildung; ?>
        </p>

    </div>
</div>

</body>
</html>
