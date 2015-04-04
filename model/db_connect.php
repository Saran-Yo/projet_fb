<?php

try{
	//$dbh = new PDO('mysql:host=localhost;dbname=projet_fb','root','');
	$dbh = new PDO('pgsql:host=localhost;port=5432;dbname=projet_fb','postgres','fbpostgre2015');
	} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

?>