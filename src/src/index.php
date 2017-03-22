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

        <h1>hallo</h1>
        <pre><?php echo $hometext ?></pre>

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
    $vorhanden = false;
    $checkImages = scandir('..\ressources');
    foreach ($images as $image){

        if ($image !== '.' && $image !== '..'){
            $picture =$count . '.jpg';


            foreach ($checkImages as $check){
                if ($check == $picture){
                    $vorhanden = true;
                }
            }
            if ($vorhanden == false){
                $ret = ftp_get($conn,'..\ressources\\'.$picture,"$destination_file$image",FTP_BINARY);

            }
            $vorhanden = false;


        }
        $count = $count+1;
    }

    ftp_close($conn);

    $alledateien = scandir('..\ressources');

?>



<div id="pointGalerie" class="galerie">
    <div class="galeryLayout">
     <ul  class="carouselPager" id="bx-pager">
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
    <div class="googleCalender" >
        <div class="calendarRight">
            <div class="cal">
                <iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showCalendars=0&amp;showTz=0&amp;mode=WEEK&amp;height=600&amp;wkst=2&amp;hl=de&amp;bgcolor=%23ccccff&amp;src=nico.prechtl171%40gmail.com&amp;color=%23B1365F&amp;ctz=Europe%2FVienna" style="border:solid 1px #777" width="100%" height="100%" frameborder="0" scrolling="no"></iframe>
            </div>
        </div>
        <div class="calendarLeft">
            <p id="legendText">
                Termine sind über Telefon oder E-Mail zu vereinbaren!</br></br>
                <a id="goToContact" href="#pointContact"> Termin vereinbaren </a>
            </p>
            <!--Hier kommt noch die Legende rein, z.b. roter punkt und daneben ein kleiner text wo steht "Belegte Termine" oder bei grünem punkt daneben "Freie Termine"-->
        </div>


    </div>
</div>

<div id="pointContact" class="contact">
    <div class="ContactDiv" >
        <div class="map">
            <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyA1atrhnK8KcO6uKxeMBkGnJUvmU6xiG84'></script><div style='overflow:hidden;height:100%;width:100%;'><div id='gmap_canvas' style='height:100%;width:100%;'></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div> <a href='https://fliegengitter-express.de/'>Fliegengitter-express.de</a> <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=78bee7ab06d5e9b8c0dab521d02999282e0e1dba'></script><script type='text/javascript'>function init_map(){var myOptions = {zoom:12,center:new google.maps.LatLng(48.38377129803107,13.849854171441617),mapTypeId: google.maps.MapTypeId.HYBRID};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(48.38377129803107,13.849854171441617)});infowindow = new google.maps.InfoWindow({content:'<strong>Astrid Hinterhölzl</strong><br>Kolmhof 4<br>4084 St. Agatha<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
        </div>
        <div class="text">
            <div class="pretext">
                <h3>Anschrift:</h3>
                <pre><?php echo $contactanschrift ?></pre>
                <h3>E-Mail:</h3>
                <pre><?php echo $contactemail ?></pre>
                <h3>Telefon:</h3>
                <pre><?php echo $contacttelefon ?></pre>
            </div>
        </div>
    </div>
</div>

<div id="pointAbout" class="about">
    <div class="AboutDiv">
        <h3>Ausbildung:</h3>
        <pre><?php echo $aboutausbildung ?></pre>
        <h3>Lebenslauf:</h3>
        <pre><?php echo $aboutlebenslauf ?></pre>
    </div>
</div>

</body>
</html>
