<?php
include_once "facebook/facebook.php";

        $facebook = new Facebook(array(
            'appId' => '403759999669551',
            'secret' => '721f08072ac5b2682ff1eebda186d9fe',
        ));
$scope = "email,user_photos";
        $params = array('scope' => $scope);
        $user = $facebook->getUser();
echo "user id is ".$user."<br>";
if(!$user){
        $loginUrl = $facebook->getLoginUrl($params);
        header("Location:$loginUrl");
        }
      $access_token = $facebook->getAccessToken();
      $albums = $facebook->api("$user/albums");
      
      
      ?>