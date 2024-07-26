<?php

include_once 'ausgelagertFunktionen.php';

$mitID = $_POST['mitID'];
$db = dbVerbindung();
mitarbeiterLoeschen($db, $mitID);


function mitarbeiterLoeschen($db, $mitID){
    //$sql = 'DELETE FROM mitarbeiter WHERE MitarbeiterID = "'.$mitID.'"';
    $sql = 'DELETE FROM mitarbeiter WHERE MitarbeiterID = ?';
    $statement = $db->prepare($sql);
    //$statement->execute();
    $statement->execute([$mitID]);
}

/*
function dbVerbindung(){
    // to-do Exception-Handling
    $db = new PDO('mysql:host=localhost; dbname=mitarbeiterverwaltung', 'root', '');
    return $db;
}
    */


?>