
<?php

  
  session_start();

  include 'config/config.php';
  require_once('facebook-php-sdk-v4-4.0-dev/autoload.php');

  use Facebook\FacebookSession;
  use Facebook\FacebookRedirectLoginHelper;
  use Facebook\FacebookRequest;
  use Facebook\GraphUser;
  use Facebook\FacebookRequestException;
  

  FacebookSession::setDefaultApplication($appId,$appSecret);
  $helper= new FacebookRedirectLoginHelper($redirectUrl);
  try{
    $session= $helper->getSessionFromRedirect();
    $_SESSION["session"]=$session;
  }catch(FacebookRequestException $ex){
    
  }catch(\Exception $ex){

  }

  if(isset($session)){
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
    $loginUrl=$helper->getLoginUrl($permission);
    echo '<a href="'.$loginUrl.'">connectez-vous</a>';
  }
  
?>
