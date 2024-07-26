<?php

include_once 'ausgelagertFunktionen.php';

$mitID = strip_tags($_POST['mitID']);
$name = strip_tags($_POST['name']);
$vorname = strip_tags($_POST['vorname']);
$mail = strip_tags($_POST['mail']);
$abteilung = strip_tags($_POST['abteilung']);
$standort = strip_tags($_POST['standort']);
$eintritt = strip_tags($_POST['eintritt']);

$db = dbVerbindung();
mitarbeiterUpdaten($db, $mitID, $name, $vorname, $mail, $abteilung, $standort, $eintritt);

/*
function dbVerbindung(){
    // to-do Exception-Handling
    $db = new PDO('mysql:host=localhost; dbname=mitarbeiterverwaltung', 'root', '');
    return $db;
}
    */

function mitarbeiterUpdaten($db, $mitID, $name, $vorname, $mail, $abteilung, $standort, $eintritt){

        $sql = 'UPDATE mitarbeiter set Name = ?, Vorname = ?, Mailadresse = ?, Abteilung = ?, Standort = ?, Eintrittsdatum = ? WHERE MitarbeiterID = ?';

        $statement = $db->prepare($sql);
        $statement->execute([$name, $vorname, $mail, $abteilung, $standort, $eintritt, $mitID]);

}

?>