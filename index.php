<?php
require_once 'config.php';

$btnlogin = ''; // set login button

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
 //It will Attempt to exchange a code for an valid authentication token.
 $token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);

 //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
 if(!isset($token['error']))
 {
  //Set the access token used for requests
  $client->setAccessToken($token['access_token']);

  //Store "access_token" value in $_SESSION variable for future use.
  $_SESSION['access_token'] = $token['access_token'];
  // session expiring time. defined when create the oauth profile on google
  $_SESSION['expires_in'] = $token['expires_in'];

  //Create Object of Google Service OAuth 2 class
  $google_service = new Google_Service_Oauth2($client);

  //Get user profile data from google
  $data = $google_service->userinfo->get();

  //Below you can find Get profile data and store into $_SESSION variable
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}

//if user not loged in with google accout, this will show the login button
if(!isset($_SESSION['access_token']))
{
 //Create a URL to obtain user authorization
 $btnlogin = '<a href="'.$client->createAuthUrl().'"><button type="button" style="width:40%; height:80px; border-width: 0px; border-radius: 15px; background-color: #82E0AA;" class="btn-blue" id="loginbtn" type="submit"><h2 style="color: white; position: relative; top: 0px;">Click Me to login with google!</button></a>';
}

?>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>PHP + OAuth Login using Google Account</title>

  
 </head>
 <body>
  <div class="container">
   <br />
   <br />
   <br />
   <br />
   <h2 align="center">PHP + OAuth Login using Google Account</h2>
   <br />
   <br />
   <br />
   <br />
   <div class="panel panel-default" style="width: 60%; position: absolute; left: 20%; ">
   <?php
   if($btnlogin == '')
   {
    echo '<div >Welcome '.$_SESSION['user_last_name'].'</div><div>';
    echo '<h3><b>Name :</b> '.$_SESSION['user_last_name'].'</h3>';
    echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
    echo '<a href="logout.php"><button type="button" style="width:20%; height:40px; border-width: 0px; border-radius: 15px; background-color: red;" class="btn-blue" id="loginbtn" type="submit">logout</button></div>';
    echo "<br><br><br><br><br>";
    echo "Access Token = ";
    echo $_SESSION['access_token'];
    echo "<br><br>";
    // echo "Expires in = ";
    // echo $_SESSION['expires_in'];
    // echo " seconds";
   }
   else
   {
    echo '<div align="center" style="width:100%;">'.$btnlogin . '</div>';
    echo "<br><br><br><br><br>";
    echo "URL = ";
    echo $client->createAuthUrl();
   }
   ?>
   </div>
  </div>
 </body>
</html>
