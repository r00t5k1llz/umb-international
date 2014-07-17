<?php ob_start(); ?>
<?php session_start();
$_SESSION['loggedin'] = false;
?>
<?php require ('includes/init.php'); ?>
<?php
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if(!empty($username) && !empty($password)){
        if(login($username, $password)){
            // SESSION;
            $_SESSION['loggedin'] =  true;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            // header redirect user to login
            header('location: account_summary.php');
        }else{
            $errors[] = 'Invalid login information';
        }
    }else{
        $errors[] = 'All fields are required';
    }
}
?>

        

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Welcome</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex, nofollow">
<link rel="stylesheet" type="text/css" href="../public/css/reset.css">
<link rel="stylesheet" type="text/css" href="../public/css/global.css">
<link rel="stylesheet" type="text/css" href="../public/css/branding.css">
<link rel="stylesheet" type="text/css" href="../public/css/buttons.css">
<style type="text/css">
body {
	background-color: #FFFFFF;
}
</style>
</head>
<body class="home homenav" style="background:#069">
		

<!-- END Aperture tag -->
<div style="width: 650px" id="box"><!-- end skiplinks -->

		

			<!-- Contains the header navigation logo and search -->
			<div id="masthead">
				<div id="logo_area">
				  <h1 style="font-size: xx-large; font-family: 'Lucida Console', Monaco, monospace; font-weight: bold;">FGB</h1>
				  <h1 style="font-size: medium; font-family: 'Lucida Console', Monaco, monospace; font-weight: bold; font-style: italic;"><span style="text-align: left"></span>CONSUMER[SMART NET]</h1>
		      </div>
				<div class="clear_all"></div>
			</div>

			
<div id="wrapper">
<div id="content" class="wide">
<h1 class="hidden">Welcome to Barclays Personal Banking</h1>
<div id="primarycontent">

<div class="heropodcontainer">

<div class="heropod heropod-accounts">
  <h1>Login</h1>
  <p>&nbsp;</p>
  <p>Enter your username and password to log in.</p>
  <p><?php
        if(empty($errors) === false){
            echo "<div style=\"background:#ff5b43;color:#fff;padding:10px;border-radius:6px;\">";
            echo implode('<p></p>', $errors);
            echo "</div>";
        }
        ?></p>
</div>
<form name="form1" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
  <label for="textfields"></label>
  <table width="328" border="1">
    <tr>
      <td width="43" height="28">Username</td>
      <td width="43"><label for="textfield2"></label>
        <input type="text" name="username" id="textfield2"></td>
      <td width="43">&nbsp;</td>
      </tr>
    <tr>
      <td height="33">Password</td>
      <td><label for="textfield3"></label>
        <input type="password" name="password" id="textfield3"></td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="login" id="button" value="Login"></td>
      <td>&nbsp;</td>
      </tr>
  </table>
  <br /><br /><br />
</form>
</div>
<div class="break"></div>
</div>
<div id="secondarycontent">

<div class="SSIpodcolumn SSIpodcolumn-first">
<div class="SSIpodcontainer">

<div class="salespod salespod-generic">
<div class="primarypod">
<h2 class="noicon"> </h2>
<div class="break"></div>
</div>
<div class="secondarypod">
<h3>A range of 24/7 business <br> services to suit your needs</h3>
<p>Securely manage your  accounts whenever and wherever you want.</p>
</div>
<div class="break"></div>
</div>
<div class="break"></div>




</div>
</div>
<div class="SSIpodcolumn">
<div class="SSIpodcontainer">

<div class="salespod salespod-accounts">
<div class="primarypod">
<h2 class="noicon"> </h2>
<div class="break"></div>
</div>
<div class="secondarypod">
<h3>A $5 reward each month with the Reward  Account</h3>
<p>Just pay in $750, pay out two different direct debits and stay in credit each month.</p></div>
<div class="break"></div>
</div>
<div class="break"></div>




</div>
</div>
</div>
</div>
</div>
</div><!--end footerlinks-->
<!--**************************************************************************
Javascript for popup survey
************************************************************************** -->
</body>
</html>



