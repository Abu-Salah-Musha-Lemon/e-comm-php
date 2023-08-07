<?php
 session_start();
 unset($_SERVER['ADNIN_LOGIN']);
  unset( $_SERVER['ADNIN_USERNAME']);
  header('location:login.php');
  die();


?>