<?php
ob_start();
session_start();
$theme="theme/";
include('config/common.php');
if(!$_SESSION['loginstatus'])helper::redirect('login.php');
$act=helper::get('act');
$cmd=helper::get('cmd','main');
if($ctrl->logout($act)==true) helper::redirect('login.php');
include('header.php');
include('menu.php');
include($cmd.'.php');
include('footer.php');
?>

       
      

               

           