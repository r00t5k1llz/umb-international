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
<html>
<head>
    <title>Account Summary</title>
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
            <div>
                <?php
                    if(isset($_SESSION['cancel_order'])){
                        echo "<div class=\"alert alert-success\">";
                        echo $_SESSION['cancel_order'];
                        echo "</div>";
                        unset($_SESSION['cancel_order']);
                    }
                ?>
            </div>
            <h3 style="border-bottom: 1px solid #68a54b;width: 540px">ACCOUNT SUMMARY</h3>
            <p>List of Account Details for <?php echo ucfirst($record['username']) . " " . date('m.D.Y');?></p>
            <div>
                <table style="width: 500px;" class="table table-bordered">
                    <tr>
                        <td style="background: #496896;color: #fff;">Account Name</td>
                        <td style="background: #496896;color: #fff;">Account #</td>
                        <td style="background: #496896;color: #fff;">Account Type</td>
                        <td style="background: #496896;color: #fff;">Balance</td>
                    </tr>
                    <tr>
                        <?php $amount = $record['balance']; $balance = number_format($amount, 2);?>
                        <td><?php echo $record['account_name']; ?></td>
                        <td><?php echo $record['account_no']; ?></td>
                        <td><?php echo $record['account_type']; ?></td>
                        <td><?php echo "\$ " . $balance; ?></td>
                    </tr>
                </table>
                <table style="width: 500px;" class="table table-bordered">
                    <tr>
                        <td style="background: #496896;color: #fff;">Balance Information</td>
                        <td style="background: #496896;color: #fff;"></td>
                    </tr>
                    <tr>
                        <td><?php echo "Real Time Balance"; ?><br />
                            <?php echo "Available Balance"; ?></td>
                        <td>
                            <?php echo "\$ " . $balance; ?><br />
                            <?php echo "\$ " . $balance; ?>
                        </td>
                    </tr>
                </table>
                <p>
                    <h3>QUICK TRANSFER</h3>
                <p>
                    <a class="btn btn-success" href="transfer.php">Transfer</a>
                </p>
                </p>
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