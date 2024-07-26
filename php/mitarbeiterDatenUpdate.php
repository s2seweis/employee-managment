<?php

include_once 'ausgelagertFunktionen.php';

$mitID = $_POST['mitID'];


$db = dbVerbindung();
$daten = abfragenDB($db, $mitID);
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

function abfragenDB($db, $mitID){
    $sql = 'SELECT * FROM mitarbeiter WHERE MitarbeiterID = "'.$mitID.'"';
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
    echo '<form action="mitarbeiterUpdate.php" method="post">';
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Name</th><th>Vorname</th><th>Mail</th><th>Abteilung</th><th>Standort</th><th>Eintritt</th></tr>';
    foreach($daten as $mitarbeiter){
        echo '<tr>';
         echo '<td><input type="text" name="mitID" readonly value="'.$mitarbeiter['MitarbeiterID'].'"></td>';
         echo '<td><input type="text" name="name" value="'.$mitarbeiter['Name'].'"></td>';
         echo '<td><input type="text" name="vorname" value="'.$mitarbeiter['Vorname']. '"></td>';
         echo '<td><input type="text" name="mail" value="'.$mitarbeiter['Mailadresse']. '"></td>';
         echo '<td><input type="text" name="abteilung" value="'.$mitarbeiter['Abteilung']. '"></td>';
         echo '<td><input type="text" name="standort" value="'.$mitarbeiter['Standort']. '"></td>';
         echo '<td><input type="text" name="eintritt" value="'.$mitarbeiter['Eintrittsdatum']. '"></td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<input type="submit" value="Mitarbeiter updaten">';
    echo '</form>';
}8



?>




