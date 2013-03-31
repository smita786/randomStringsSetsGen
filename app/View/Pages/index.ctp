<!DOCTYPE html>
<html>
<head>


<!-- Meta Tags -->
<meta charset="utf-8">
<meta name="generator" content="Wufoo">
<meta name="robots" content="index, follow">

<!-- CSS -->
<link href="/css/structure.css" rel="stylesheet">
<link href="/css/form.css" rel="stylesheet">

<!-- JavaScript -->
<script src="/scripts/wufoo.js"></script>
<script src="/scripts/modernizr.custom.96400.js"></script>
<script src="http://api.jquery.com/scripts/events.js"></script>
  <script src="http://code.jquery.com/jquery-latest.js"></script>

<!--[if lt IE 10]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
  <script type="text/javascript">
            // Firefox, Google Chrome, Opera, Safari, Internet Explorer from version 9
        function OnInput (event) {
          //alert ("The new content: " + event.target.value);
          //alert($("#gcharsbegin").val());
           if(event.target.value != ""){
            $("#gcharsend").attr("readonly","readonly");
            $("#positionbegin").removeAttr('disabled');
           }
           else{
           $("#gcharsend").removeAttr('readonly');
           $("#positionbegin").attr("disabled","disabled");
           $("#positionbegin").val("");
           }
         
        }
         function OnInput1 (event) {
          //alert ("The new content: " + event.target.value);
          //alert($("#gcharsbegin").val());
           if(event.target.value != ""){
            $("#gcharsbegin").attr("readonly","readonly");
            $("#positionend").removeAttr('disabled');
         }
           else{
           $("#gcharsbegin").removeAttr('readonly');
           $("#positionend").attr("disabled","disabled");
           $("#positionend").val("");
           }
        }
 
        function checkListLen(){
            if(event.target.value == "lten"){
                $("#fileupload").hide();
                $("#textinput").show();
            }
            else {
                $("#textinput").hide();
                $("#fileupload").show();
            }
        }
        function OnInputAlpha(event){
            if(event.target.value != ""){
                $("#alphabet").removeAttr("checked");
                $("#alphabet").attr("disabled","disabled");
            }else $("#alphabet").removeAttr('disabled');
        }
        function OnInputNum(event){
            if(event.target.value != ""){
                $("#numeric").removeAttr("checked");
                $("#numeric").attr("disabled","disabled");
            }else $("#numeric").removeAttr('disabled');
        }
        function OnInputSchar(event){
            if(event.target.value != ""){
                $("#specialchars").removeAttr("checked");
                $("#specialchars").attr("disabled","disabled");
            }else $("#specialchars").removeAttr('disabled');
        }
        function validateForm(){
            
            return true;
        }
        function logout(){
            document.location = "/Pages/logout"
        }
        function validateProcForm(){
            if($("#file").val() == ""){
		if($("#fileinput").val() != ""){
			return true
		}
                alert("No file chosen, Please select a file to process!");
                return false
            }
            return true
            
        }
       
            </script>
</head>

<body id="public">
<div id="container" class="ltr" >


<p style="background-color: #bebebe;height:30px;margin-top: -10px;">Welcome, <?php echo $name; ?>!<font id="logout" style="margin-left: 70%;cursor: pointer;text-decoration: underline" onclick="logout()">Logout</font></p>


    <ul>
        <li id="gen"><a style="font-size: 15px" href="?generate"  class="selected">Generate Word List</a></li>  <!-- TAB1 -->
        <li id="pro"><a style="font-size: 15px" href="?process"">Process Word List</a></li>
        </ul>
    <?php if(isset($_GET['generate']) || !isset($_GET['process'])){?>
    <div id="generate">
<form id="formGen" name="formGen" class="wufoo topLabel page" autocomplete="off" enctype="multipart/form-data" method="post"
action="/Pages/generateWordList" onsubmit = "return validateForm()">
<input type="hidden" name="_method" value="POST">
<header id="header" class="info">
<h2>Word List Generator</h2>
<div></div>
</header>

<ul>

<li id="foli13" class="notranslate leftHalf" style="width: 100% !important">
<label class="desc" id="title13" for="Field13">
Select characters to be used:
</label>

<div id="Field13">
        <span>
            <font style="color: black;margin-right: 24px">Alphabets:</font> <input id="alphainput" name="alphainput" type="text" class="field text fn" value="" size="8" tabindex="4" oninput="OnInputAlpha(event)"/>&nbsp; OR
<input id="alphabet" name="seedarr[]" type="checkbox" value="alphabet" tabindex="13" checked >
Check for all Alphabets (a-z)<br>
<font style="color: black;margin-right: 30px">Numbers:</font> <input id="numinput" name="numinput" type="text" class="field text fn" value="" size="8" tabindex="4" style="margin-top: 6px" oninput="OnInputNum(event)"/>&nbsp; OR
<input id="numeric" name="seedarr[]" type="checkbox" value="numeric" tabindex="13" checked />
Check for all numbers (0-9) <br>
<font style="color: black">Special Chars</font>: <input id="specialcharinput" name="specialcharinput" type="text" class="field text fn" value="" size="8" tabindex="4" style="margin-top: 6px" oninput="OnInputSchar(event)"/>&nbsp; OR
<input id="specialchars" name="seedarr[]" type="checkbox" value="specialchars" tabindex="13" checked>
Check for all special characters
</span>
</div>
</li>
<li id="foli1" class="notranslate leftHalf">
<label class="desc" id="title1" for="Field1">
Length of each Word
<span id="req_1" class="req">*</span>

</label>
   
<div id="Field1">

Minimum length: <input id="wlengthmin" name="wlengthmin" type="number" class="field text fn" value="" size="3" tabindex="4" min="1" required />
<br><br>
Maximum length: <input id="wlengthmax" name="wlengthmax" type="number" class="field text fn" value="" size="3" tabindex="4" min="1" required />

</div>
</li>
<li id="foli2" class="notranslate leftHalf      " >
<label class="desc" id="title2" for="Field2">
Insert a group of characters in every words:
</label>
<div id="Field2">
    <input id="gcharsbegin" name="gcharsbegin" type="text" class="field text fn" value="" size="8" tabindex="4" oninput="OnInput (event)"/> at position
    <input id="positionbegin" name="positionbegin" type="number" class="field text fn" value="" size="3" tabindex="4" min="0" disabled="disabled"/> from begin<br>
    OR<br>
    <input id="gcharsend" name="gcharsend" type="text" class="field text fn" value="" size="8" tabindex="4" oninput="OnInput1 (event)"/> at position
    <input id="positionend" name="positionend" type="number" class="field text fn" value="" size="3" tabindex="4" min="0" disabled="disabled"/> from end<br>
    </div>

</li>

<li id="foli13" class="notranslate leftHalf      ">
<label class="desc" id="title13" for="Field3">
Number of words to generate:
</label>

<div id="Field3">
        <span>
<input id="wordlist" name="wordlist" type="number" class="field text fn" value="" size="7" tabindex="4" min="1" />    OR    <input id="nolimit" name="nolimit" type="checkbox" value="1" tabindex="13" >
 Check if No Upper Limit

</span>
</div>
</li>
<li id="foli2" class="notranslate leftHalf      " >
<label class="desc" id="titleps" for="Fieldps">
Add suffix/prefix string for filename:
</label>
<div id="Fieldps">
    Prefix: <input id="prefix" name="prefix" type="text" class="field text fn" value="" size="8" tabindex="4" /> <br>
    <br>
    Suffix: <input id="suffix" name="suffix" type="text" class="field text fn" value="" size="8" tabindex="4" /> <br>
    </div>

</li>
 <li class="buttons ">
<div>

                    <input id="saveGenForm" name="saveForm" class="btTxt submit" type="submit" value="Generate"/>
                    <input type="reset" value="Reset" />
</div>
</li>

</ul>
</form> 
</div> <?php } else{?>
   <div id="process">
<form id="formProcess" name="formProcess" class="wufoo topLabel page" autocomplete="off" enctype="multipart/form-data" method="post"
action="/Pages/processWordList" onsubmit="return validateProcForm()">

<header id="header" class="info">
<h2>Word List Processor</h2>
<div></div>
</header>

<ul>

<li id="foli13" class="notranslate leftHalf">
<label class="desc" id="title13" for="Field14">
Select a Profile Name:
<span id="req_14" class="req">*</span>
</label>

<div id="Field14">
<select id="" name="sel_pname" class="field select medium" tabindex="1" > 
<?php foreach ($p_names as $p_name) { ?>
    
<option value=<?php echo $p_name;?>>
<?php echo $p_name;?>
</option>
<?php }?>
</select>
</div>
</li>
<li id="foli13" class="notranslate rightHalf">
<label class="desc" id="title13" for="Field15">
Approx. number of words to process:
</label>

<div id="Field15">
<select id="" name="" class="field select medium" tabindex="1" onChange="javascript:checkListLen();"> 
<option value="" selected="selected">
</option>
<option id="lten" value="lten">
    &eqslantless;10
</option>
<option id="gten" value="gten">
    &gt;10
</option>

</select>
</div>
</li>
<li id="foli1" class="notranslate leftHalf">
<label class="desc" id="title1" for="Field1">
Choose an action:
<span id="req_1" class="req">*</span>

</label>
   
<div id="Field1">
<select id="" name="action" class="field select medium" tabindex="1" > 
<option value="tonumber" >
Convert to equivalent numbers
</option>
<option value="toletter" >
Convert to equivalent letters
</option>

</select>
</div>
</li>
<li id="fileupload" class="notranslate rightHalf      ">
<label class="desc" id="title2" for="Field2">
Upload a word list file to process:
<span id="req_2" class="req">*</span>
</label>
<div id="Field2">
    <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
    <input type="file" name="file" id="file" /> 
     </div>

</li>
<li id="textinput" class="notranslate rightHalf" style="display: none">
<label class="desc" id="title10" for="Field10">
Enter the word List in space below:
<span id="req_10" class="req">*</span>
</label>
<div id="Field10">
<TEXTAREA id="fileinput" Name="textinput" rows="4" cols="20"></TEXTAREA> 
     </div>

</li>

 <li class="buttons ">
<div>

                    <input id="saveForm2" name="saveForm2" class="btTxt submit" type="submit" value="Process"/>
                    <input type="reset" value="Reset" />
</div>
</li>

</ul>
</form> 
       </div> <?php } ?>
</div><!--container-->

</body>
</html>
