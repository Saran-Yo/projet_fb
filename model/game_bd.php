<?php

	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphUser;
	use Facebook\FacebookRequestException;


	function saveUserScoreBd($user,$score){
		require("./model/db_connect.php");
		$userId=$user->id;
		$stmt = $dbh->prepare("INSERT INTO game_historic (score,date_pub,user_id) VALUES (:pScore,now(),:pUserId)");
		$stmt->bindParam(':pScore',$score);
		$stmt->bindParam(':pUserId',$userId);
		$result=$stmt->execute();
	}

	function getAllBestScores(){
		require("./model/db_connect.php");
		//$stmt = $dbh->prepare("select u.id,u.fb_id,u.first_name,u.last_name from utilisateur u,game_historic g where u.id=g.user_id group by u.fb_id");
		$stmt = $dbh->prepare("SELECT u.fb_id,u.first_name,u.last_name,max(g.score) as score FROM utilisateur u,game_historic g WHERE u.id = g.user_id GROUP BY u.fb_id,u.first_name,u.last_name ORDER BY score desc");
		$result=$stmt->execute();
		if($result){
			$topScoreList=array();
			while($row=$stmt->fetch()){
				//print_r($row);
				$topScoreList[]=$row;
			}
			return $topScoreList;
		}
		return null;
	}

?>