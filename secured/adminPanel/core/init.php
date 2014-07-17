<?php ob_start();
session_start();
require_once ('connect/database.php');
require_once ('classes/user.class.php');
require_once ('classes/session.class.php');
require_once ('classes/transaction.class.php');
require_once ('classes/codes.class.php');

$user = new Users($db);
$session = new Sessions();
$transaction = new Transaction($db);
$codes = new Codes($db);

$errors = array();
$success = array();