<?php
session_start();
if (!isset($_SESSION['deriv_token'])) {
    header("Location: login.php");
    exit();
}
define('DERIV_APP_ID','YOUR_APP_ID');
$token=$_SESSION['deriv_token'];
$user_name=$_SESSION['user_name']??'Trader';
$account_id=$_SESSION['loginid']??'';
$currency=$_SESSION['currency']??'USD';
