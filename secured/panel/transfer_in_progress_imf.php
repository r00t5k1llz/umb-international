<?php ob_start(); ?>
<?php session_start(); ?>
<?php require ('includes/init.php'); ?>

<?php

if(!$_SESSION['loggedin']){
    header('location: index.php');
}

?>
<?php
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
            <h3 style="border-bottom: 1px solid #68a54b;width: 500px">Enter IMF Code to continue with transfer...</h3>
            <p>Please provide a IMF Code given to you by the Bank to continue with your transfer. Please contact your bank if you do not have it.</p>
            <?php
				if(isset($_POST['cot_code'])){
				$cot_code = $_POST['cot_code'];
				if(!empty($cot_code)){
				$query = mysql_query("SELECT `codes` FROM `codes` WHERE `codes` = '$cot_code' AND `code_type` ='IMF Code'");
				$checkRow = mysql_num_rows($query);
				if($checkRow > 0){
					echo "<div class=\"alert alert-success\">" . 'IMF Code Successfully verified.' . ' Your transfer would coninue' . "</div>";
					echo '<br />';
					echo '<p>'.'You are been redirected to continue with your transfer in 5 seconds '.'</p>';
					header('refresh: 5, url=transfering_in_progress_i.php');
				}else{
				echo "<div class=\"alert alert-danger\">";
				echo 'Invalid IMF CODE, Please try again';
				echo "</div>";
				}
				}else{
				echo "<div class=\"alert alert-danger\">";
				echo 'Please enter a IMF Code';
				echo "</div>";	
				}
				}
				
				
			?>
            
            
            <div class="example">
        <form name="form1" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
          <label for="textfield"></label>
          <p><input class="form-control" type="text" name="cot_code" id="textfield" style="width: 400px;"></p>
          <p><input class="btn btn-primary" type="submit" name="button" id="button" value="Submit"></p>
        </form>
        <h3>&nbsp;</h3>

        <div id="progress1">
          <div class="percent"></div>
            <div class="pbar"></div>
            <!--<div class="elapsed"></div>-->
        </div>
    </div>
    </div><!-- content -->
    <div style="clear:both;"></div>
    <div style="font-size:12px;margin-top: 30px;border-top: 1px solid #4f4f4f;padding-top:10px;background:#FF7A12;color:#fff;padding-left:20px;padding-bottom:30px;">
        Copyright &copy; 2013 <?php require('includes/name.php'); ?>. All rights reserved.
    </div>
</div>
</body>
</html>