<?php

include_once 'ausgelagertFunktionen.php';

$name = strip_tags($_POST['name']);
$vorname = strip_tags($_POST['vorname']);
$mail = strip_tags($_POST['mail']);
$abteilung = strip_tags($_POST['abteilung']);
$standort = strip_tags($_POST['standort']);
$eintritt = strip_tags($_POST['eintritt']);

// echo $name . $vorname . $mail . $abteilung . $standort . $eintritt


if(!empty($name) && !empty($vorname) && !empty($mail) && !empty($abteilung) && !empty($standort) && !empty($eintritt) ){
    // DB-Verbindung
    // Mitarbeiter anlegen
    echo 'alles ok';
    $db = dbVerbindung();
    mitarbeiterAnlegen($db, $name, $vorname, $mail, $abteilung, $standort, $eintritt);
}else{
    echo 'Formular unvollständig';
    echo '<a href="../html/mitarbeiterAnlegen.html">zurück zum Formular</a>';
}


function  mitarbeiterAnlegen($db, $name, $vorname, $mail, $abteilung, $standort, $eintritt){
    $sql = 'INSERT INTO mitarbeiter(Name, Vorname, Mailadresse, Abteilung, Standort, Eintrittsdatum)VALUES(:Name, :Vorname, :Mailadresse, :Abteilung, :Standort, :Eintrittsdatum)';

    $mitarbeiter = array(
        'Name'              => $name,
        'Vorname'           => $vorname,
        'Mailadresse'       => $mail,
        'Abteilung'         => $abteilung,
        'Standort'          => $standort,
        'Eintrittsdatum'    => $eintritt
    );

    $statement = $db->prepare($sql);
    $statement->execute($mitarbeiter);
}


/*
function dbVerbindung(){
    // to-do Exception-Handling
    $db = new PDO('mysql:host=localhost; dbname=mitarbeiterverwaltung', 'root', '');
    return $db;
}
*/


?>