<?php

try{
	//$dbh = new PDO('mysql:host=localhost;dbname=projet_fb','root','');
	$dbh = new PDO('pgsql:host=ec2-23-23-244-144.compute-1.amazonaws.com;port=5432;dbname=d8m18mshdsi4tc','jciikssslvvqoe','GAr2n22HMrN7qta9Ie3sK9vdOU');
	} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

?>