<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<link href="/css/login-box.css" rel="stylesheet" type="text/css" />
<script src="/scripts/modernizr.custom.96400.js"></script>
<script src="http://api.jquery.com/scripts/events.js"></script>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script type="text/javascript">
     function loginFb(){
         //alert("fb login");
         document.location = "/Pages/fbLogin"
     }
     function showRegTab(){
         $("#login-box").hide();
         $("#register-box").show();
     }
     function showLoginTab(){
         $("#register-box").hide();
         $("#login-box").show();
     }
     function refreshCaptcha()
     {
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
    }

    function validateLogin(){
        var value = $.trim($("#email").val())
        var re = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
        if (!value.match(re) || value.length > 60) {
            alert("Please provide a valid email address");
            return false;
        }
        else if($.trim($("#password").val()) == "") {
            alert("You must supply a password.");
            return false;
        }
        document.loginForm.submit();
    }
 
  /*       function checkCaptcha(code)
        {
            
       var out;
        $.ajax({
            url: "/Pages/validateCaptcha/" + code ,
            context: $(this),
            success: function(resp){
                out = resp;
                alert(out);
                return out;
            }
        });
        
    }*/
    function validateRegister(){
        //alert("register");
       
        var code = $.trim($("#6_letters_code").val());
        //alert(checkCaptcha(code));
        var value = $.trim($("#regemail").val())
        var re = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
        if($.trim($("#regname").val()) == ""){
            alert('Please Insert you name!');
            return false;
        }
        if (!value.match(re) || value.length > 60) {
            alert("Please provide a valid email address");
            return false;
        }
        else if($.trim($("#regpassword").val()) == "") {
            alert("You must supply a password.");
            return false;
        }
        else if($.trim($("#regpassword").val()) != $.trim($("#confirmPassword").val())){
            alert("Your Passwords don't match.");
            $("#regpassword").attr("value","");
            $("#confirmPassword").attr("value","");
            return false;
        }else if(code == ""){
            alert("Please enter the captcha code in space provided!");
            return false;
        }
        $.ajax({
            url: "/Pages/validateCaptcha/" + code ,
            context: document.body,
            success: function(resp){
               if(resp == "false"){
                   alert("The captcha code does not match.try again!");
                   return false;
               }
               else 
                  document.registerForm.submit();
            }
        });
    }
  </script>
</head>

<body>


<div style="padding: 100px 0 0 250px;">


<div id="login-box">

<h2>Login</h2>
<span class="login-box-options" style="padding-left:0px"><a id="register" href="#" style="font-size: 18px;color:#E57B85" onclick="showRegTab()">Sign up here</a></span>
<br />
<span class="login-box-options" style="padding-left:0px;color: #E57B85;"><b><?php if(isset($message)) echo $message;?></b></span>
<br />
<form id="loginForm" name="loginForm" enctype="multipart/form-data" method="post"
action="/Pages/login">
<div id="login-box-name" style="margin-top:20px;">Email:</div><div id="login-box-field" style="margin-top:20px;"><input id="email" name="email" class="form-login" title="Username" value="" size="30" maxlength="2048" /></div>
<div id="login-box-name">Password:</div><div id="login-box-field"><input id="password" name="password" type="password" class="form-login" title="Password" value="" size="30" maxlength="2048" /></div>
<br />
<span class="login-box-options"><input type="checkbox" name="1" value="1"/> Remember Me <a href="#" style="margin-left:30px;">Forgot password?</a></span>
<br />
<br /> </form>
<img src="/img/fb-connect.png" style="width:180px;height: 38px;cursor: pointer; margin-right: 25px;"alt="" id="fbLogin" onclick="loginFb()"/>
<a href="#"><img id="login" src="/images/login-btn.png" width="103" height="42" onclick="validateLogin();" /></a> 

 <div id="" class="social-login">
                               

                                <!-- HIDDEN FORM TO HANDLE FACEBOOK LOGIN  -->
                                <form id="fbLoginForm" method="post" action="/users/fbLogin" accept-charset="utf-8">
                                    <input type="hidden" name="_method" value="POST" />
                                    <input id = "fb_id" name="data[User][fb_val]" type = "hidden" />
                                    <input id = "fb_access_token" name="data[User][fb_access_token]" type = "hidden" />
                                </form>
                            </div>
</div>
<div id="register-box" style="display: none">

<h2>Register</h2>
<span class="login-box-options" style="padding-left:0px">Already an user? <a id="register" href="#" style="font-size: 14px" onclick="showLoginTab()">click here</a> to Login</span>
<br />
<br />
<form id="registerForm" name="registerForm" enctype="multipart/form-data" method="post"
action="/Pages/register">
    <div id="login-box-name1" style="margin-top:20px;">Name:</div><div id="login-box-field1" style="margin-top:20px;"><input id="regname" name="name" class="form-login" title="name" value="" size="30" maxlength="2048" /></div>
<div id="login-box-name1">Email:</div><div id="login-box-field1"><input id="regemail" name="email" class="form-login" title="Username" value="" size="30" maxlength="2048" /></div>
<div id="login-box-name1">Password:</div><div id="login-box-field1"><input id="regpassword" name="password" type="password" class="form-login" title="Password" value="" size="30" maxlength="2048" /></div>
<div id="login-box-name1">Confirm Password:</div><div id="login-box-field1"><input id="confirmPassword" name="confirmPassword" type="password" class="form-login" title="ConfirmPassword" value="" size="30" maxlength="2048" /></div>
		<img src="/files/captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' style="margin-left: 130px"/>

<div id="login-box-name1" style="margin-top: -20px">Enter the code above here :</div><div id="login-box-field1"><input id="6_letters_code" name="6_letters_code" type="text"/></div><br>
<small style="margin-left: 90px">Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</small>
<br />
<br />
<br /></form>
<img src="/img/fb-connect.png" style="width:180px;height: 38px;cursor: pointer; margin-right: 25px;"alt="" id="fbLogin1" onclick="loginFb()"/>
<a href="#"><img src="/images/register_button.png" width="103" height="42" onclick="validateRegister();"/></a> 
 
 <div id="" class="social-login">
                               

                                <!-- HIDDEN FORM TO HANDLE FACEBOOK LOGIN  -->
                                <form id="fbLoginForm" method="post" action="/users/fbLogin" accept-charset="utf-8">
                                    <input type="hidden" name="_method" value="POST" />
                                    <input id = "fb_id" name="data[User][fb_val]" type = "hidden" />
                                    <input id = "fb_access_token" name="data[User][fb_access_token]" type = "hidden" />
                                </form>
                            </div>
</div>
</div>













</body>
</html>
