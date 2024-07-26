<?php

    include_once 'ausgelagertFunktionen.php';


    // to-do isset/ empty
    $auswahl = $_POST['auswahl'];
    //echo $auswahl;
    $sql = '';

    switch($auswahl){
        case 'standort':
            $standort = $_POST['standort'];
            echo '<h1> Ergebnisse nach Standort ' . $standort . ' selektiert: </h1>';
            $sql = nachStandortSelektieren($standort);
            break; 
        case 'abteilung': 
            $abteilung = $_POST['abteilung'];
            echo '<h1> Ergebnisse nach Abteilung ' . $abteilung . ' selektiert: </h1>';
            $sql = nachAbteilungSelektieren($abteilung);
            break; 
        case 'eintritt':
            $von = $_POST['von'];
            $bis = $_POST['bis'];
            echo '<h1> Ergebnisse nach Datum: ' . $von . ' - ' .$bis.  ' selektiert: </h1>';
            $sql = nachEintrittSelektieren($von, $bis);
            break;
        case 'kombination':  
            $standort = $_POST['standort'];
            $abteilung = $_POST['abteilung'];
            $von = $_POST['von'];
            $bis = $_POST['bis'];
            echo '<h1> Ergebnisse nach Abteilung verschiedenen Kriterien selektiert: </h1>';
            $sql = nachKombiSelektieren($standort, $abteilung, $von, $bis);
            break; 
        default:
            echo 'falls was anderes gewählt wurde ;-)';           
    }

    $db = dbVerbindung();
    $daten = abfragenDB($db, $sql);
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

    function abfragenDB($db, $sql){

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
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Name</th><th>Vorname</th><th>Mail</th><th>Abteilung</th><th>Standort</th><th>Eintritt</th></tr>';
        foreach($daten as $mitarbeiter){
            echo '<tr>';
             echo '<td>' .$mitarbeiter['MitarbeiterID']. '</td>';
             echo '<td>' .$mitarbeiter['Name']. '</td>';
             echo '<td>' .$mitarbeiter['Vorname']. '</td>';
             echo '<td>' .$mitarbeiter['Mailadresse']. '</td>';
             echo '<td>' .$mitarbeiter['Abteilung']. '</td>';
             echo '<td>' .$mitarbeiter['Standort']. '</td>';
             echo '<td>' .$mitarbeiter['Eintrittsdatum']. '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    function nachStandortSelektieren($standort){
        //$sql = 'SELECT * FROM mitarbeiter WHERE Standort = "Heidelberg";';
        $sql = 'SELECT * FROM mitarbeiter WHERE Standort = "' . $standort .  '";';
        return $sql;
    }
    
    function nachAbteilungSelektieren($abteilung){
        // #######
        $sql = 'SELECT * FROM mitarbeiter WHERE Abteilung = "' . $abteilung .  '";';
        return $sql;
    }

    function nachEintrittSelektieren($von, $bis){
        $sql = 'SELECT * FROM mitarbeiter WHERE Eintrittsdatum BETWEEN "'. $von.'" and "'.$bis.'";';
        return $sql;
    }

    function nachKombiSelektieren($standort, $abteilung, $von, $bis){
        $sql = 'SELECT * FROM mitarbeiter WHERE Standort ="'.$standort.'" and Abteilung ="'.$abteilung.'" and Eintrittsdatum BETWEEN "'. $von.'" and "'.$bis.'";';
        return $sql;
    }

    ?>