
<?php

  
 

include 'config/config.php';
require_once('facebook-php-sdk-v4-4.0-dev/autoload.php');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

require('./service/gameService.php');
  
session_start();
FacebookSession::setDefaultApplication($appId,$appSecret);
if(!isset($_SESSION["session"])){
  $helper= new FacebookRedirectLoginHelper($redirectUrl);
  try{
    //if(!isset($_SESSION["session"])){
      $session= $helper->getSessionFromRedirect();
      $_SESSION["session"]=$session;
    //}
  }catch(FacebookRequestException $ex){
      echo "Exception occured, code: " . $ex->getCode();
      echo " with message: " . $ex->getMessage();
  }catch(\Exception $ex){
    echo "exception 2";
  }

}

  if(isset($_SESSION["session"])){
    if (isset($_GET['ctrl']) && isset($_GET['action'])){
      $ctrl = htmlspecialchars($_GET['ctrl']);
      $action = htmlspecialchars($_GET['action']);
    } else {
      $ctrl = 'HomeController';
      $action = 'home';
    } 
    require("./controller/".$ctrl.".php");
    $action();

  }else{
    $helper= new FacebookRedirectLoginHelper($redirectUrl);
    $loginUrl=$helper->getLoginUrl($permission);
    echo '<a href="'.$loginUrl.'">connectez-vous</a>';
  }
  
?>
