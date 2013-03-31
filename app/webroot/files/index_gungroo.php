 <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# postappfg: http://ogp.me/ns/fb/postappfg#">
  <meta property="fb:app_id"     content="403759999669551" /> 
  <meta property="og:type"       content="postappfg:update" /> 
  <meta property="og:url"       content="http://www.itsasharething.com" /> 
  <meta property="og:title"      content="Sample Update" /> 
  <meta property="og:image"      content="https://s-static.ak.fbcdn.net/images/devsite/attachment_blank.png" /> 
  <meta property="postappfg:via" content="smita" /> </head>
<?php 
include_once "facebook/facebook.php";

        $facebook = new Facebook(array(
            'appId' => '403759999669551',
            'secret' => '721f08072ac5b2682ff1eebda186d9fe',
        ));
$scope = "email,publish_stream";
        $params = array('scope' => $scope);
        $user = $facebook->getUser();
echo "user id is ".$user."<br>";
if(!$user){
        $loginUrl = $facebook->getLoginUrl($params);
        header("Location:$loginUrl");
        }
      $facebook->getAccessToken();
      
        if(isset($_POST['message'])){
            $message = $_POST['message'];
            echo "meessage is ".$message;
                $facebook->setFileUploadSupport(true);
                
                $name = "alex alliee";
		$image_url = "http://sharp-water-7515.herokuapp.com/scene.jpg";
                $url_content = file_get_contents($image_url);
                var_dump($url_content);
		$fname = explode(" ",$name);
		$fname = $fname[0];
           try {
		//$post_id = $facebook->api("me/postappfg:post_via","POST",array('profile'=>"$id",'message'=>':)','description'=>"$message"));
		$post_id = $facebook->api("me/postappfg:post","POST",array('update'=>"http://sharp-water-7515.herokuapp.com/update.php?name=$fname",'message'=>"Via : $name",'description'=>"$message",'via'=>'alex','image[0][url]'=>"$image_url"));
		echo "meessage succesfully posted! message is: ".$message;
		echo $post_id = $post_id['id'];
		}
		catch (Exception $e){
			echo "error ".var_dump($e);		
		}
      //echo '<a href='."http://www.facebook.com/profile.php?id=$user".'>smita</a>';
 /*     $post_id = $facebook->api("$user/feed","POST",array('message' => "Tagging @[1286874262:smita] in a status update from my app",
    'name' => "name",
    'link' => "itsasharething.com",
    'description' => "description")); //post a message, facebook does not allow duplicate message to post so change the message each time script is being run otherwise error will be thrown.
      var_dump($post_id);
	echo $post_id["id"]."<br>";
	$post_id1 = explode("_",$post_id["id"]);
	$id = trim($post_id1[1]);
//to retrieve the post
	$post = $facebook->api("$id");
	echo "post deatails is: ";
	var_dump($post);
	echo "<br>";
//to delete the post
      $post_id = $post_id["id"];*/
        }
     // $delete_status = $facebook->api("/$post_id","DELETE");
      ?>
          <table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form id="form1" name="form1" method="post" action="index.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3" bgcolor="#E6E6E6"><strong>Post a message</strong> </td>
</tr>
<tr>
<td valign="top"><strong>Message</strong></td>
<td valign="top">:</td>
<td><textarea name="message" cols="30" rows="4" id="message"></textarea></td>
</tr>
<tr>
<td valign="top"><strong>name</strong></td>
<td valign="top">:</td>
<td><input type="text" name="id" cols="30" id="id"/></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Submit" /> <input type="reset" name="Submit2" value="Reset" /></td>
</tr>
</table>
</td>
</form>
</tr>
</table>


