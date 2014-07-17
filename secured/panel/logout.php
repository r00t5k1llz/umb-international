<?php ob_start(); ?>
<?php session_start(); ?>
<?php require ('includes/init.php'); ?>
<?php
$_SESSION['loggedin'] = false;

unset($_SESSION['loggedin']);
unset($_SESSION['username']);
unset($_SESSION['password']);

session_destroy();

header('location: ../../online/');