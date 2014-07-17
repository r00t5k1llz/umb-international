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
<?php
    if(isset($_POST['transfer']) && $_POST['transfer'] == "Transfer"){
        $from = $_POST['from'];
        $to = $_POST['to'];
        $bank = $_POST['bank'];
        $account_no = $_POST['account_no'];
        $amount = $_POST['amount'];
        $routing = $_POST['routing'];
        if(!empty($from) || !empty($to) || !empty($bank) || !empty($account_no) || !empty($account_type) || !empty($amount) || !empty($routing)){
              if(is_numeric($amount)){
				$id = $record['id'];
				$user =  $record['username'];
				$name = $record['full_name'];
				$coded = mt_rand(56540554, 90087455544);
				$_SESSION['coded'] = $coded;
				$sql = "INSERT INTO `transact`(`uid`,`t_code`,`username`,`name`,`transfer_to`,`amount`,`bank`,`account_no`,`routing_no`,`completed`) 
				VALUES('$id','$coded','$user','$name','$to','$amount','$bank','$account_no','$routing',2)";
				$query = mysql_query($sql);
				if($query){
				header('location: transfering.php');
				exit();
				}else{
					$errors[] = 'An internal error occurred, please try again';
				}
			  }else{
				$errors[] = 'Enter only numbers for the amount';
			  }
			  
        } else{
            $errors[] = 'All fields are required';
        }
    }
?>
<!doctype html>
<html>
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
            <h3 style="border-bottom: 1px solid #68a54b;width: 500px">TRANSFER FUNDS</h3>
            <p>Transfer Amounts to Any account Worldwide</p>
            <div>
            	<p style="color: #f00;"><em>You must make sure all data entered are accurate before submitting.</em></p>
                <div>
					<?php
						if(empty($errors) === false){
							echo "<div class=\"alert alert-danger\">";
							echo '<p>' . implode('<p></p>', $errors) . '</p>';
							echo "</div>";
						}
					?>
				</div>
				<form role="form" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                    <table>
                        <tr>
                            <td>From</td>
                            <td><input class="form-control" type="text" name="from" value="<?php echo $record['full_name'] . " - " .$record['account_no'];?>"></td>
                        </tr>
                            <td>To</td>
                            <td><input class="form-control" type="text" name="to"></td>
                        </tr>
                            <td>Bank</td>
                            <td><input class="form-control" type="text" name="bank"></td>
                        </tr>
                        <tr>
                            <td>Account #</td>
                            <td><input class="form-control" type="text" name="account_no"></td>
                        </tr>
                        <tr>
                            <td>Routing #</td>
                            <td><input class="form-control" type="text" name="routing"></td>
                        </tr>
                        <tr>
                            <td>Amount $</td>
                            <td><input class="form-control" type="text" name="amount"></td>
                        </tr>
                            <td></td>
                            <td><input class="btn btn-success" type="submit" name="transfer" value="Transfer"></td>
                        </tr>
                    </table>
                </form>
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