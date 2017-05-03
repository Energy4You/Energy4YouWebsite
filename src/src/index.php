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

    <script src="click_toggle.js" type="text/javascript"></script>

</head>
<body>

<body onload="clickMenu('outer','div','more')">
<div class="nav">
<ul>
    <li class="firstListItemMenuTop"><a id="pHomeColor" href="#pointHome">Home</a></li>
    <li><a href="#pointGalerie">Galerie</a></li>
    <li><a href="#pointCalender">Kalender</a></li>
    <li><a href="#pointContact">Kontakt</a></li>
    <li><a href="#pointAbout">Über mich</a></li>
    <li><a href="#pointOffer">Angebote</a></li>
    <li><a href="#pointPrice">Preise</a></li>
</ul>
</div>
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

    <div class="HomeDiv" style="text-align: justify; line-height: 140%"><?php echo $hometext ?></div>

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

    foreach ($images as $image){ //ftp Filecheck

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
        </div>


    </div>
</div>

<div id="pointContact" class="contact">
    <div class="ContactDiv" >
        <div class="map">
            <iframe width="100%" height="100%" frameborder="0" style="border:0"
                    src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJOaszxMF5dEcR58jlyfdmA-E&key=AIzaSyAqexPyxLkzqUOS9MnHI2kVpqyfrQKyoCM" allowfullscreen></iframe>

        </div>
        <div class="text">
            <div class="pretext">
                <h3 style="color: orange;">Anschrift:</h3>
                <pre><?php echo $contactanschrift ?></pre>
                <h3 style="color: orange;">E-Mail:</h3>
                <pre><?php echo $contactemail ?></pre>
                <h3 style="color: orange;">Telefon:</h3>
                <pre><?php echo $contacttelefon ?></pre>
            </div>
        </div>
    </div>
</div>

<div id="pointAbout" class="about">


        <div class="Lebenslauf" style="text-align: justify; line-height: 140%"><?php echo $aboutlebenslauf ?></div>

</div>
<div id="pointOffer" class="offer">


    <div class="OfferDiv" style="text-align: justify; line-height: 140%"><h1 style="color: orange">ANGEBOTE</h1>
        <h3 style="color:orange">CRANIO SACRAL DYNAMICS® FÜR ERWACHSENE</h3>
        Die Cranio Sacrale Arbeit ist für Menschen jeden Alters geeignet und kann als Begleitung in vielen Bereichen hilfreich sein.</br></br>
        Nicht selten kommt es vor, dass Beschwerden aus heiterem Himmel auftauchen, nicht jedoch aus der Sicht unseres Körpers, dieser musste oft lange geduldig sein und hat sich alle Erfahrungen körperlicher und psychischer Natur auf Zellebene gemerkt, dies kann auf faszialer Ebene zu Verklebungen führen und nachdem unser Körper in einen „Faszienschlauch“ (eine Faszie geht in die nächste Faszie über) gehüllt ist, hat jede Restriktion bzw. Verklebung einer Faszie Auswirkungen auf die gesamten Körperfaszien. Hier begründet sich auch das Phänomen, dass die Ursache oft weit weg vom Symptom liegt.</br></br>
        Mit Cranio Sacraler Körperarbeit berühre ich nicht symptomorientiert, sondern stelle dem Köper die Frage, was er zur Gesundung braucht und lenke mit dem Klienten den Fokus auf die gesunden Anteile des Körpers, so kann der Körper Spannung abbauen und oft lange gebundene Energie loslassen.</br></br>
        Mit sanften Berührungen ermögliche ich dem Klienten den eigenen Körper bewusst wahrzunehmen und seine Befindlichkeit zu erkennen, bei Veränderungen und in schwierigeren Situationen oder Zuständen biete ich eine begleitende Gesprächsführung als Hilfestellung an.</br></br>
        <span style="color: orange">Anwendungsbeispiele:</span></br></br>
        &nbsp; &nbsp;  ?  Wirbelsäulen- und Gelenksbeschwerden</br>
        &nbsp; &nbsp;  ?  Kopfschmerzen, Migräne</br>
        &nbsp; &nbsp;  ?  Zahnregulierungen, Kiefergelenksbeschwerden, nächtliches Zähneknirschen</br>
        &nbsp; &nbsp;  ?  Stress, Schlafprobleme, Unruhe- und Erschöpfungszustände</br>
        &nbsp; &nbsp;  ?  Störung des Hormonsystems, Menstruationsbeschwerden</br>
        &nbsp; &nbsp;  ?  Tinnitus, Gleichgewichtsprobleme</br>
        &nbsp; &nbsp;  ?  Verdauungsprobleme</br>
        &nbsp; &nbsp;  ?  Stoffwechselbeschwerden</br>
        &nbsp; &nbsp;  ?  Psychosomatische Beschwerden</br>
        &nbsp; &nbsp;  ?  Chronische Schmerzen</br>
        &nbsp; &nbsp;  ?  Narben</br>
        &nbsp; &nbsp;  ?  Nervosität, Prüfungsängste</br>
        &nbsp; &nbsp;  ?  Konzentrationsschwierigkeiten</br>
        &nbsp; &nbsp;  ?  Kreislaufprobleme</br>
        &nbsp; &nbsp;  ?  Regeneration und Genesungshilfe</br>
        &nbsp; &nbsp;  ?  Schwangerschaftsbegleitung</br>
        &nbsp; &nbsp;  ?  Geburtsnachsorge, Geburtstrauma</br></br>
        <h3 style="color:orange">CRANIO SACRAL DYNAMICS® FÜR BABYS UND KINDER</h3>
        Die Geburt ist für Eltern und Kind ein schönes und intensives Erlebnis. Manchmal verläuft sie nicht so, wie man sich das gewünscht hätte und hinterlässt sowohl körperliche als auch tiefgreifende emotionale Spuren bei Mutter, Vater und Kind. Auch bei einer gut verlaufenen Entbindung ist für das Baby nach der Geburt viel zu bewältigen. Beim Durchtritt durch den Geburtskanal kommt es zu starken Kompression der Schädelknochen und anschließend zu einer abrupten Veränderung des äußeren Milieus. Manchmal reicht die eigene Selbstregulation zur Verarbeitung der Geburtserlebnisse nicht aus und es ist Unterstützung erforderlich.</br></br>
        <span style="color: orange">Einige Beispiele wie sie erkennen können, dass ihr Kind Unterstützung benötigt:</span></br></br>
        &nbsp; &nbsp;  ?  Überdurchschnittlich lange anhaltendes Schreien</br>
        &nbsp; &nbsp;  ?  Ihr Kind will nicht am Kopf berührt werden oder sucht später wenn es sich schon bewegen kann mit seinem Kopf immer Kontakt zur Innenwand des Kinderbettes.</br>
        &nbsp; &nbsp;  ?  Immerwährendes Weinen beim Autofahren oder schon beim Lagern in den Kindersitz</br>
        &nbsp; &nbsp;  ?  Kopfdrehung nur zu einer Seite, kahle Stelle am Hinterkopf</br>
        &nbsp; &nbsp;  ?  häufiges Erbrechen, unruhiger Schlaf</br></br>
        Mit der Cranio Sacralen Methode horche ich, was mir der Körper des Kindes erzählt und begleite und fördere es in seiner individuellen Entwicklung. Unser Körper ist ein Meister des Ausgleichens und Kompensierens, so wird auch ein Kinderkörper mit aller Kraft etwaige Disharmonien mit Hilfe seiner Selbstregulationsfähigkeit versuchen auszugleichen, allerdings bleibt dabei viel unverarbeitet und der Kinderkörper geht in die Kompensation. In bestimmten Situationen, z.B. bei intensiveren Wachstumsschüben kann diese Kompensation nicht mehr gehalten werden, und es kommt zum Beispiel zu Wirbelsäulenverformungen, Lernschwierigkeiten, Auffälligkeiten im sozialen Verhalten, …</br></br>
        <span style="color: orange">Anwendungsbeispiele bei Babys und Kindern:</span></br></br>
        &nbsp; &nbsp;  ?  Asymmetrien, Schiefhals</br>
        &nbsp; &nbsp;  ?  Wirbelsäulenfehlstellungen, Beckenschiefstand, Skoliosen</br>
        &nbsp; &nbsp;  ?  Nach Unfällen und Stürzen</br>
        &nbsp; &nbsp;  ?  Verdauungsprobleme, Koliken</br>
        &nbsp; &nbsp;  ?  Schreibabys</br>
        &nbsp; &nbsp;  ?  Schwierigkeiten beim Saugen, Stillen</br>
        &nbsp; &nbsp;  ?  Kopf-, Rücken- und Wachstumsschmerzen</br>
        &nbsp; &nbsp;  ?  Entwicklungsverzögerungen</br>
        &nbsp; &nbsp;  ?  Schielen </br>
        &nbsp; &nbsp;  ?  Kopf- und Bauchschmerzen</br>
        &nbsp; &nbsp;  ?  Neurodermitis </br>
        &nbsp; &nbsp;  ?  Hyperaktivität</br>
        &nbsp; &nbsp;  ?  Schwaches Immunsystem, Asthma, Bronchitis</br>
        &nbsp; &nbsp;  ?  Chronische Mandel- und Mittelohrentzündung</br>
        &nbsp; &nbsp;  ?  bei Kiefer und Zahnregulationen, Zähneknirschen</br>
        &nbsp; &nbsp;  ?  Konzentrations- und Lernschwierigkeiten</br></br>
        <h3 style="color:orange">NEUROPHYSIOLOGISCHES (SENSOMOTORISCHES) TRAINING:</h3>
        Zentrales Thema bei diesem Trainingsprogramm stellen die frühkindlichen Reflexe dar.
        Frühkindliche Reflexe sind unbewusste Reaktionsmuster, zur Lebenserhaltung (Atmung, Herztätigkeit, ...) des Neugeborenen. Sie entstehen nach einem Reflex – Zeitplan, müssen reifen und werden durch ausreichende Stimulation und Bewegungsmuster durch die Basalganglien gehemmt und in das gesamte Bewegungsmuster integriert. Durch altersentsprechende, einfache stereotype Bewegungen hemmt das Kind diese Reflexe einem nach dem anderen und entwickelt dann neue Reflexmuster.</br></br>
        Ist das Kind nicht in der Lage diese frühkindlichen Reflexe zu hemmen, wird die motorische Entwicklung verzögert, in Folge die Reifung des Gehirns verzögert, so hat dies Auswirkung auf Beweglichkeit, Aufmerksamkeit, Konzentration und Lernen.</br></br>
        Durch gezielte Tests kann ich erkennen ob es sich um persistierende (nicht gehemmte/abgebaute) Reflexe handelt.</br>
        Mit einer Übungsabfolge auf einer speziell angefertigten Wippe und mit Übungen, die zu Hause auf der Matte gemacht werden lernt das Gehirn durch viele langsame Wiederholungen und es können persistierende frühkindliche Reflexe integriert werden.</br></br>
        <span style="color: orange">Mögliche Hinweise für persistierende frühkindliche Reflexe:</span></br></br>
        &nbsp; &nbsp;  ?  Gleichgewichtsstörungen bei Kopfdrehung</br>
        &nbsp; &nbsp;  ?  Augenbewegung ist nicht von der Kopfbewegung zu trennen</br>
        &nbsp; &nbsp;  ?  Störungen der Graphomotorik – starker Druck, „merkwürdige“ Stifthaltung, Schwierigkeiten untereinander zu schreiben</br>
        &nbsp; &nbsp;  ?  Überempfindlichkeit auf bestimmte akustische Reize</br>
        &nbsp; &nbsp;  ?  Mangelnde Ausdauer</br>
        &nbsp; &nbsp;  ?  Schlechte Anpassungsfähigkeit</br>
        &nbsp; &nbsp;  ?  „W“ Beinhaltung beim Sitzen auf dem Boden</br>
        &nbsp; &nbsp;  ?  Probleme beim Abschreiben von der Tafel</br></br>
        In meiner Praxis bringe ich die Cranio Sacrale Körperarbeit mit dem Neurophysiologischen Training in Verbindung und kann so ein optimales Gleichgewicht zwischen Bewegung und Entspannung schaffen.</br>
        <p style="text-align: center"><a id="goToPrice" href="#pointPrice">Zu den Preisen</a></p></div>

</div>
<div id="pointPrice" class="price">


    <div class="PriceDiv" style="text-align: justify; line-height: 140%"><h1 style="color: orange">Preise</h1></br>
        <table>
            <tr>
                <td><h4>Cranio Sacral Dynamics® für Erwachsene</h4></td>
                <td><h4>&nbsp; &nbsp;&nbsp; &nbsp;90 min</h4></td>
                <td><h4>&nbsp; &nbsp;&nbsp; &nbsp;Euro 70,00</h4></td>
            </tr>
            <tr>
                <td><h4>Cranio Sacral Dynamics® für Babys</h4></td>
                <td><h4>&nbsp; &nbsp;&nbsp; &nbsp;40min</h4></td>
                <td><h4>&nbsp; &nbsp;&nbsp; &nbsp;Euro 40,00</h4></td>
            </tr>
            <tr>
                <td><h4>Cranio Sacral Dynamics® für Kinder</h4></td>
                <td><h4>&nbsp; &nbsp;&nbsp; &nbsp;60 min</h4></td>
                <td><h4>&nbsp; &nbsp;&nbsp; &nbsp;Euro 50,00</h4></td>
            </tr>
        </table></br></br>
        Cranio Sacral Dynamics® ersetzt die medizinische Behandlung nicht.</br></br>
        Bei starken Beschwerden ist eine Behandlung vorgängig mit dem Arzt abzuklären.</br></br>
    </div>

</div>

</body>
</html>
