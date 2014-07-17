<?php ob_start(); ?>
<?php session_start(); ?>
<?php require ('includes/init.php'); ?>

<?php

if(!$_SESSION['loggedin']){
    header('location: index.php');
}

?>
<?php

if(isset($_SESSION['coded'])){
    $transaction_code = $_SESSION['coded'];

}

if(isset($_SESSION['username']) && isset($_SESSION['password'])){
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $password_ = sha1($password);
    $sql = "SELECT * FROM `tbl_users` WHERE `username`='$username' AND `password`='$password_'";
    $query = mysql_query($sql);
    $count = mysql_num_rows($query) > 0;
    $record = mysql_fetch_array($query);
}
?>
<?php
    $uid = $record['id'];
    $sql2 = "UPDATE `transact` SET `t_code` = '$transaction_code' WHERE `uid`='$uid'";
    $query2 = mysql_query($sql2);
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Transfer</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>

<body>
<!-- begin page design-->
<div class="topDesign"></div>
<div class="mainContainer">
    <div class="heading">
        <div class="welcome">Welcome, <img src="assets/img/user.png"> <?php echo ucfirst($record['username']);?></div>
        <div class="logout"><img src="assets/img/off.png"> <a href="logout.php">Logout</a></div>
    </div><!-- heading -->
    <div class="contentContainer">
        <div class="left">
            <div><a href="account_summary.php">Account Summary</a> <img src="assets/img/summary.png" width=16 height=16></div>
            <div><a href="transfer.php">Transfer</a> <img src="assets/img/transfer.png" width=16 height=16></div>
            <div><a href="emails.php">Emails</a> <img src="assets/img/email.png" width=16 height=16></div>
            <div><a href="settings.php">User Settings</a> <img src="assets/img/settings.png" width=16 height=16></div>
            <div><a href="logout.php">Logout</a> <img src="assets/img/logout.png" width=16 height=16></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="right">
            <h3 style="border-bottom: 1px solid #68a54b;width: 500px">AUTHENTICATE TRANSFER</h3>
            <p><em>Transfer Amounts to Any account Worldwide</p>
            <div  class="btn btn-success" >
            	<?php
            		echo "Your transfer has been successfully submitted and been processed by out 
            		<br />transfer department. Please be Patience as a transfer manager would get <br />
            		back to you to complete your transfer. Your transaction code is: " . $transaction_code;
            	?>
            </div>
            
        </div>
    </div><!-- content -->
    <div style="clear:both;"></div>
    <div style="font-size:12px;margin-top: 30px;border-top: 1px solid #4f4f4f;padding-top:10px;background:#FF7A12;color:#fff;padding-left:20px;padding-bottom:30px;">
        Copyright &copy; 2013 <?php require('includes/name.php'); ?>. All rights reserved.
    </div>
    <?php unset($_SESSION['coded']); ?>
</div>
</body>
</html>