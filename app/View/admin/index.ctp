<html>
<head>

<title>
Word List generator/Processor
</title>

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
</head>

<body id="public">
<div id="container" class="ltr">

<h1 id="logo">
<a href="http://wufoo.com" title="Powered by Wufoo">qseeker</a>
</h1>

    <ul>
        <li id="gen"><a style="font-size: 15px" href="/Pages?generate"  class="selected" onclick="showGen()">Generate Word List</a></li>  <!-- TAB1 -->
        <li id="pro"><a style="font-size: 15px" href="/Pages?process" onclick="showPro()">Process Word List</a></li>
        </ul>

    <div id="generate">
<form id="form67" name="form67" class="wufoo topLabel page" autocomplete="off" enctype="multipart/form-data" method="post" novalidate
action="/admin/addProfileNames">
<input type="hidden" name="_method" value="POST">
<header id="header" class="info">
<h2>Add Profile Names</h2>
<div></div>
</header>

<ul>
<li id="foli13" class="notranslate leftHalf">
<label class="desc" id="title13" for="Field13">
Profile Name:
<span id="req_13" class="req">*</span>
</label>

<div id="Field13">
        <span>
<input id="pname" name="pname" type="text" class="field text fn" value="" size="16" tabindex="4" required />
</span>
</div>
</li>
<li id="foli13" class="notranslate leftHalf">
<label class="desc" id="title13" for="Field13">
Enter characters against each numeric values:
<span id="req_13" class="req">*</span>
(don't separate characters with space or comma)
</label>

<div id="Field13">
        <span>
            1. <input id="one" name="nameVal[1]" type="text" class="field text fn" value="" size="16" tabindex="4" style="margin-bottom: 10px" /><br>
            2. <input id="two" name="nameVal[2]" type="text" class="field text fn" value="" size="16" tabindex="4" style="margin-bottom: 10px" /><br>
            3. <input id="three" name="nameVal[3]" type="text" class="field text fn" value="" size="16" tabindex="4" style="margin-bottom: 10px"/><br>
            4. <input id="four" name="nameVal[4]" type="text" class="field text fn" value="" size="16" tabindex="4" style="margin-bottom: 10px" /><br>
            5. <input id="five" name="nameVal[5]" type="text" class="field text fn" value="" size="16" tabindex="4" style="margin-bottom: 10px" /><br>
            6. <input id="six" name="nameVal[6]" type="text" class="field text fn" value="" size="16" tabindex="4" style="margin-bottom: 10px" /><br>
            7. <input id="seven" name="nameVal[7]" type="text" class="field text fn" value="" size="16" tabindex="4" style="margin-bottom: 10px" /><br>
            8. <input id="eight" name="nameVal[8]" type="text" class="field text fn" value="" size="16" tabindex="4" style="margin-bottom: 10px" /><br>
            9. <input id="nine" name="nameVal[9]" type="text" class="field text fn" value="" size="16" tabindex="4" style="margin-bottom: 10px" /><br>
            0. <input id="zero" name="nameVal[0]" type="text" class="field text fn" value="" size="16" tabindex="4" style="margin-bottom: 10px" /><br>

</span>
</div>
</li>
<li class="buttons ">
<div>

                    <input id="saveForm" name="saveForm" class="btTxt submit" type="submit" value="Add"/>
                    <input type="reset" value="Reset" />
</div>
</li>
</ul>
</form> 
        <header id="header" class="info">
<h2>Delete Profile Names</h2>
<div></div>
</header>
        <form id="formProcess" name="formProcess" class="wufoo topLabel page" autocomplete="off" enctype="multipart/form-data" method="post"
              action="/admin/deleteProfileNames">
            <ul>

<li id="foli13" class="notranslate leftHalf">
<label class="desc" id="title13" for="Field14">
Select a Profile Name to delete:
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
<li class="buttons ">
<div>

                    <input id="saveForm" name="saveForm" class="btTxt submit" type="submit" value="Delete"/>
                    <input type="reset" value="Reset" />
</div>
</li>
            </ul>
        </form>
</div><!--container-->

</body>
</html>