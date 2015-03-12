<?php

try{
	$dbh = new PDO('mysql:host=localhost;dbname=projetfb','root','');
	} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

?>