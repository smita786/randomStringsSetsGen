<?php
include_once __DIR__."/../Lib/facebook/facebook.php";
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

    /**
     * Controller name
     *
     * @var string
     */
    public $name = 'Pages';

    /**
     * Default helper
     *
     * @var array
     */
    public $helpers = array('Html', 'Session');

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array("profileName,User");

    /**
     * Displays a view
     *
     * @param mixed What page to display
     * @return void
     */
    public function index(){
        if(!$this->_isLoggedIn()){
            $this->redirect("/Pages/login");
        }
        if(isset($_GET['process'])){
            $p_names = array();
            Controller::loadModel('profileName');
            $profile_model = $this->profileName;
            $profiles = $profile_model->find("all");
            foreach ($profiles as $profile){
                $p_names[] = $profile['profileName']['name'];
            }
            $this->set('p_names',$p_names);
        }
        $user = $this->Session->read('user');
        $this->set('name',$user['User']['name']);
    }
    public function login(){
        if($this->_isLoggedIn()){
            $this->redirect("/Pages");
        }
        $this->flushSession;
        if(isset($_GET['err'])){
            $this->set("message","There is already an user associated with this email.Please login!");
        }
        if(isset($_POST['email']) && $_POST['password']){
            $email = $_POST['email'];
            $password = md5($_POST['password']);
             Controller::loadModel('User');
        $user_model = $this->User;
        $user = $user_model->find("first", array("conditions" => array("User.email = " => $email)));
        if(!$user){
            $this->set('message',"No such user exists!");
        }
        else if($user['User']['password'] != $password){
            $this->set('message',"Wrong password, Please try again!");
        } else {
            $this->Session->write("loggedIn", TRUE);
            $this->Session->write("user", $user);
            $this->redirect("/Pages");
        }
        }
    }
    function fbLogin(){
        $this->flushSession();
        $facebook = new Facebook(array(
            'appId' => 'APP_ID',
            'secret' => 'APP_SECRET',
        ));
        $scope = "email";
        $params = array('scope' => $scope);
        $user = $facebook->getUser();
        if(!$user){
        $loginUrl = $facebook->getLoginUrl($params);
        $this->redirect($loginUrl);
        } else{
            $user_profile = $facebook->api('/me');
            $name = $user_profile['name'];
            $email = $user_profile['email'];
            $password = md5(time());
            Controller::loadModel('User');
        $user_model = $this->User;
        $user1 = $user_model->find("first", array("conditions" => array("User.email = " => $email)));
         if(!$user1){
            $data = array();
            $data['User']['name'] = $name;
            $data['User']['email'] = $email;
            $data['User']['password'] = $password;
            $user_model->save($data);
            $this->Session->write("loggedIn", TRUE);
            $this->Session->write("user", $data);
        }
        else {
            $this->Session->write("loggedIn", TRUE);
            $this->Session->write("user", $user1);
        }
        $this->redirect("/Pages");
        }
    }
     function flushSession() {
        $this->Session->write("loggedIn", FALSE);
    }
    function logout(){
        $this->_logoutOperation();
        $this->redirect("/Pages/login");
    }
    public function _logoutOperation(){
        $vals = $this->Session->read();
        $this->Session->write("loggedIn", FALSE);
        $this->Session->destroy();
        unset($vals['user']);
        $this->Session->write($vals);
        unset($_SESSION['loggedIn']);
        
    }
    public function register(){
        if($this->_isLoggedIn()){
            $this->redirect("/Pages");
        }
        if(isset($_POST['name']))
            echo $name = $_POST['name'];
        if(isset($_POST['email']))
            echo $email = $_POST['email'];
        if(isset($_POST['password']))
            echo $password = md5($_POST['password']);
        Controller::loadModel('User');
        $user_model = $this->User;
        $user = $user_model->find("first", array("conditions" => array("User.email = " => $email)));
        if($user){
            $this->redirect("/Pages/login?err");
        }
        if(!$user){
            $data = array();
            $data['User']['name'] = $name;
            $data['User']['email'] = $email;
            $data['User']['password'] = $password;
            $user_model->save($data);
            $this->Session->write("loggedIn", TRUE);
            $this->Session->write("user", $user);
            $this->redirect("/pages");
        }
        
    }
    function _isLoggedIn() {
        return $this->Session->read("loggedIn");
    }
    public function validateCaptcha($code){
        session_start();
        $code_rcv = $_SESSION['6_letters_code'];
        if(!$code_rcv || strcasecmp($code_rcv, $code) != 0)
	{
            echo "false";
	}
        else
            echo "true";
        exit;
    }
    public function display() {
        $path = func_get_args();

        $count = count($path);
        if (!$count) {
            $this->redirect('/');
        }
        $page = $subpage = $title_for_layout = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        if (!empty($path[$count - 1])) {
            $title_for_layout = Inflector::humanize($path[$count - 1]);
        }
        $this->set(compact('page', 'subpage', 'title_for_layout'));
        $this->render(implode('/', $path));
    }

    function str_rand($length = 8, $seeds = 'abcdefghijklmnopqrstuvwqyz') {
        // Possible seeds
      /*  $seedings['alphabet'] = 'abcdefghijklmnopqrstuvwqyz';
        $seedings['numeric'] = '0123456789';
        $seedings['specialchars'] = '~!@#$%^&*()?><"-,.*+/;:=?]}[{|';

        // Choose seed
        $seeds = "";
        if (is_array($seedsarr)) {
            foreach ($seedsarr as $seed){
                $seeds .= $seedings[$seed];
            }
        }
        else
            $seeds = $seedings[$seedsarr];*/
        // Seed generator
        list($usec, $sec) = explode(' ', microtime());
        $seed = (float) $sec + ((float) $usec * 100000);
        mt_srand($seed);

        // Generate
        $str = '';
        $seeds_count = strlen($seeds);

        for ($i = 0; $length > $i; $i++) {
            $str .= $seeds{mt_rand(0, $seeds_count - 1)};
        }

        return $str;
    }
    function generateWordList(){
        header('Content-type: text/plain');
        if(isset($_POST['seedarr']))
            $seedsarr = $_POST['seedarr'];
        $minlen = $_POST['wlengthmin'];
        $maxlen = $_POST['wlengthmax'];
        $string = $_POST['gcharsbegin']?$_POST['gcharsbegin']:$_POST['gcharsend'];
        if(isset($_POST['suffix']))
            $suffix = $_POST['suffix'];
        if(isset($_POST['prefix']))
            $prefix = $_POST['prefix'];
        $startpos = -1;
        $endpos = -1;
        if(isset($_POST['positionbegin']))
            $startpos = $_POST['positionbegin'];
        else if(isset($_POST['positionend']))
            $endpos = $_POST['positionend'];
        if(isset($_POST['wordlist']))
            $num_words = (int)$_POST['wordlist'];
        if($num_words == 0)
            $num_words = 5000;      //php.ini : output buffering to be on
        $addedlen = strlen($string);
        $minlen = ($minlen - $addedlen) > 0 ?($minlen - $addedlen):1;
        $maxlen = $maxlen - $addedlen;
        $seedings['alphabet'] = 'abcdefghijklmnopqrstuvwqyz';
        $seedings['numeric'] = '0123456789';
        $seedings['specialchars'] = '~!@#$%^&*()?><"-,.*+/;:=?]}[{|';
        $seeds = "";
        if(isset($_POST['seedarr'])){
        foreach ($seedsarr as $seed){
                $seeds .= $seedings[$seed];
            }
        }
         if(isset($_POST['alphainput']))
             $seeds .= $_POST['alphainput'];
         if(isset($_POST['numinput']))
             $seeds .= $_POST['numinput'];
         if(isset($_POST['specialcharinput']))
             $seeds .= $_POST['specialcharinput'];
         
         if($seeds == "")
             $seeds = 'abcdefghijklmnopqrstuvwqyz0123456789~!@#$%^&*()?><"-,.*+/;:=?]}[{|';
    /*        $maxListSizePossible = 0;
            for($j=0;$j<=$maxlen;$j++){
                $maxListSizePossible += pow(strlen($seeds), $j);
                if($maxListSizePossible >=1000){
                    $maxListSizePossible = 1000;
                    break;
                }
            }
            $maxListSizePossible = pow(strlen($seeds), $maxlen);
            $maxListSizePossible = $maxListSizePossible < 1000 ? $maxListSizePossible:1000;
            $num_words = $num_words <= $maxListSizePossible ? $num_words : $maxListSizePossible;*/
           $output_str = array();
           $count = 0;
           $dcount = 0;
        while($count<5000 && $dcount < $num_words){
           $stringData = $this->str_rand(mt_rand($minlen, $maxlen),$seeds);
           if(!in_array($stringData, $output_str)){
           if($startpos != -1){
           if($startpos == 0){
               $out = $string.$stringData;
           }else if(strlen($stringData) <= $startpos){
               $out = $stringData.$string;
           }
           else{
           $chararr = str_split($stringData,$startpos);
           $out = $chararr[0].$string;
           foreach ($chararr as $key=>$char){
               if($key != 0)
                    $out .= $char;
           }
           }
           }
           else if($endpos != -1){
           if($endpos == 0){
               $out = $stringData.$string;
           }else if(strlen($stringData) <= $endpos){
               $out = $string.$stringData;
           } 
           else{
               $stringlen = strlen($stringData);
           $chararr = str_split($stringData,  ($stringlen - $endpos));
           $out = $chararr[0].$string;
           foreach ($chararr as $key=>$char){
               if($key != 0)
                    $out .= $char;
           }
           }
           }
           else $out = $stringData;
              // echo $out."\r\n";
           $output_str[] = $stringData;
           $dcount += 1;
           }
                      $count += 1;
        }
        sort($output_str);
        foreach ($output_str as $out){
            echo $out."\r\n";
        }
        date_default_timezone_set('GMT');
        $today= date("Y-md-His");
        $filename = "wordList-$today";
        if($prefix)
            $filename = "$prefix-".$filename.".txt";
        if($suffix)
            $filename = $filename."-$suffix.txt";
        header("Content-disposition: attachment; filename=$filename");
        exit;
    }
    function processWordList(){
        header('Content-type: text/plain');
        $action = $_POST['action'];
        $sel_pname = $_POST['sel_pname'];
        //$sortby = $_POST['sortby'];
        if(isset($_POST['textinput'])){
            $textinput = $_POST['textinput'];
            $lines = explode("\n", $textinput);
            foreach ($lines as $line_of_text){
                $words = preg_split('/\s+/',$line_of_text,-1,PREG_SPLIT_NO_EMPTY);
                foreach ($words as $word){
                    echo $word."\t";
                }
                foreach ($words as $word) {
                        if($action == "tonumber")
                            echo $out_num = $this->convertToNum($sel_pname, $word)."\t";
                        else
                            echo $out_char = $this->convertToString($sel_pname,$word)."\t";
                 }
                 echo "\r\n";
            }
        }
        if(isset($_FILES['file'])){
        if ($_FILES["file"]["error"] > 0)
        {
            "Error: " . $_FILES["file"]["error"] . "<br />";
        }
        else
        {
            $file_name = $_FILES["file"]["name"] . "<br />";
            $type= $_FILES["file"]["type"] . "<br />";
            $size = ($_FILES["file"]["size"] / 1024) . " Kb<br />";
            $temp_storage = $_FILES["file"]["tmp_name"];
            $myFile = "testFile.txt";
            $fh = fopen($temp_storage, 'rb');
            while (!feof($fh) ) {
                $line_of_text = fgets($fh);
                $words = preg_split('/\s+/',$line_of_text,-1,PREG_SPLIT_NO_EMPTY);
                foreach ($words as $word){
                    echo $word."\t";
                }
                foreach ($words as $word) {
                        if($action == "tonumber")
                            echo $out_num = $this->convertToNum($sel_pname, $word)."\t";
                        else
                            echo $out_char = $this->convertToString($sel_pname,$word)."\t";
                 }
                 echo "\r\n";
                 //echo "<br>";

            }

            fclose($fh);
            if (file_exists("upload/" . $_FILES["file"]["name"]))
            {
                echo $_FILES["file"]["name"] . " already exists. ";
            }
            else
            {
            move_uploaded_file($_FILES["file"]["tmp_name"],
            "/home/smita/upload/" . $_FILES["file"]["name"]);
            }
        }
        }
        date_default_timezone_set('GMT');
        $today= date("Y-md-His");
        header("Content-disposition: attachment; filename=Out-$sel_pname-$today.txt");
        exit;
    }
    function convertToNum($profile_name,$string){
        Controller::loadModel('profileName');
        $profile_model = $this->profileName;
        $profile = $profile_model->find("first", array("conditions" => array("profileName.name = " => $profile_name)));
        $def = $profile['profileName']['defination'];
        $defArr = unserialize($def);
        //xdebug_break();
        $charArr = str_split($string);
        $out_num = 0;
        foreach ($charArr as $char){
            if(!ctype_digit($char)){
            foreach ($defArr as $key=>$value){
                if(stristr($value, $char) != FALSE){
                    //echo $key." for ".$char." ";
                    $out_num += $key;
                    break;
                }
            }
            }
            else $out_num += $char;
        }
       return $out_num;

    }
    function convertToString($profile_name,$numstr){
        Controller::loadModel('profileName');
        $profile_model = $this->profileName;
        $profile = $profile_model->find("first", array("conditions" => array("profileName.name = " => $profile_name)));
        $def = $profile['profileName']['defination'];
        $defArr = unserialize($def);
        //xdebug_break();
        $numArr = str_split($numstr);
        $out_str = "";
        foreach ($numArr as $num){
            if(ctype_digit($num)){
                $cval = $defArr[$num];
                $out_str .= $cval{mt_rand(0, strlen($cval) - 1)};
            }
            else $out_str .= $num;
        }
       return $out_str;
    }
    function permute($str) {
    /* If we only have a single character, return it */
    if (strlen($str) < 2) {
        return array($str);
    }

    /* Initialize the return value */
    $permutations = array();

    /* Copy the string except for the first character */
    $tail = substr($str, 1);

    /* Loop through the permutations of the substring created above */
    foreach (permute($tail) as $permutation) {
        /* Get the length of the current permutation */
        $length = strlen($permutation);

        /* Loop through the permutation and insert the first character of the original
        string between the two parts and store it in the result array */
        for ($i = 0; $i <= $length; $i++) {
            $permutations[] = substr($permutation, 0, $i) . $str[0] . substr($permutation, $i);
        }
    }

    /* Return the result */
    return $permutations;
}
}
