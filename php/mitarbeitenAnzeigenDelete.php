<?php

include_once 'ausgelagertFunktionen.php';

$db = dbVerbindung();
$daten = abfragenDB($db);
datenAnzeigen($daten);

// --------------------------------------------
//               FUNKTIONEN
// --------------------------------------------

/*
function dbVerbindung(){
    // to-do Exception-Handling
    $db = new PDO('mysql:host=localhost; dbname=mitarbeiterverwaltung', 'root', '');
    return $db;
}
    */

function abfragenDB($db){
    $sql = 'SELECT * FROM mitarbeiter';
    // to-do: prepare Statement --> sicherer

    // Anfrage an DB
    $statement = $db->query($sql);
    // Abgreifen von Antwort
    $daten = $statement->fetchAll();
    return $daten; 
}

function datenAnzeigen($daten){

    // echo $daten[1]['Name'];
    //var_dump($daten);
    echo '<form action="mitarbeiterDelete.php" method="post">';
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Name</th><th>Vorname</th><th>Mail</th><th>Abteilung</th><th>Standort</th><th>Eintritt</th></tr>';
    foreach($daten as $mitarbeiter){
        echo '<tr>';
         echo '<td><input type="radio" name="mitID" value="'.$mitarbeiter['MitarbeiterID'].'"></td>';
         echo '<td>' .$mitarbeiter['Name']. '</td>';
         echo '<td>' .$mitarbeiter['Vorname']. '</td>';
         echo '<td>' .$mitarbeiter['Mailadresse']. '</td>';
         echo '<td>' .$mitarbeiter['Abteilung']. '</td>';
         echo '<td>' .$mitarbeiter['Standort']. '</td>';
         echo '<td>' .$mitarbeiter['Eintrittsdatum']. '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<input type="submit" value="Mitarbeiter auswählen">';
    echo '</form>';
}



?>