<?php
// Include initiate file.
require ('core/init.php');

// if user is not logged in, redirect user to login page
$session->adminLoggedOut();

// Get All users
$users = $user->userdata($_SESSION['id']);
$record = $user->getAllUsers();

?>
<?php
if(isset($_POST['submit']) === true){
    $uid = $users['id'];
    $opass = $_POST['opass'];
    $npass = $_POST['npass'];
    $rpass = $_POST['rpass'];
    $password = sha1($opass);

    if(!empty($opass) && !empty($npass) && !empty($rpass)){
        //check password match password on  record
        $passed = $user->passPassword($uid);
        if($passed == $password){
           if($npass === $rpass){
                // Change new password.
               $CHANGE_PASSWORD_NOW = $user->updatePassword($npass, $uid);
               if($CHANGE_PASSWORD_NOW){
                    $success[] = 'Password Successfully Changed for ' . ucfirst($users['username']);
               }
           }else{
               $errors[] = 'New password and its confirmation doesn\'t match';
           }
        }else{
            $errors[] = 'Password does not match one on file';
        }
    }else{
        $errors[] = 'All fields are required';
    }

}
?>
<!doctype>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8"
    <meta name="robots" content="noindex">
    <title>Users</title>
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
</head>
<body>
<!-- begin page design here -->
<div class="main">
    <aside class="left">
        <nav>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="users.php">Users</a></li>
                <li><a href="add_user.php">Add User</a></li>
                <li><a href="transactions.php">Transactions</a></li>
                <li><a href="generate.php">Generate Code</a></li>
                <li><a class="active" href="change_password.php">Change Password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </aside>
    <aside class="right">
        <h1>Change Password</h1>
        <p style="border-bottom: 1px solid #ddd;">
            Logged In as, <?php echo ucfirst($users['username']); ?>.
        </p>
        <p>
            <em style="color:#a43038;font-weight:bold;">Use the form below to change your password, if you wish to.
            <br />You must enter old password before a new password can be applied
            </em>
        </p>
        <p>
            <?php
            if(empty($errors) === false){
               echo "<div class=\"alert alert-danger\">";
                echo implode('<p></p>', $errors);
               echo "</div>";
            }else if(empty($success) === false){
                echo "<div class=\"alert alert-success\">";
                echo '<p>' . implode('<p></p>', $success) . '</p>';
                echo "</div>";
            }
            ?>
        </p>
        <div style="width:330px">
            <form role="form" name="changePassword" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <p>Old Password</p>
                <p><input class="form-control" type="password" name="opass"></p>
                <p>New password</p>
                <p><input class="form-control" type="password" name="npass"></p>
                <p>Repeat Password</p>
                <p><input class="form-control" type="password" name="rpass"></p>
                <p><input class="btn btn-success" type="submit" name="submit" value="Change Password"></p>
            </form>
        </div>
    </aside>
</div><!-- main -->
</body>
</html>