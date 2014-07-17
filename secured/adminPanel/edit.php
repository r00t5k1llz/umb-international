<?php
// Include initiate file.
require ('core/init.php');

// if user is not logged in, redirect user to login page
$session->adminLoggedOut();

// Get All users
$users = $user->userdata($_SESSION['id']);

if(isset($_GET['id'])){
     $uid = $_GET['id'];
    $record = $user->userdata($uid);

}
?>
<?php
if(isset($_POST['submit']) && $_POST['submit']==="Update User"){
    $balance = $_POST['balance'];
    $suspend = $_POST['suspend'];
    $accept = $_POST['accept'];
    //$record
    if(empty($balance) || !is_numeric($balance)){
        $errors[] = 'Balance should be only numbers';
    }
    if(empty($errors) === true){
        $id = $record['id'];
        $addUser = $user->updateUser($suspend, $balance, $accept, $id);
        $success[] = 'Update successful for: ' . ucfirst($record['username']);
    }
}
?>
<!doctype>
<html lang="en">
<head>
    <meta charset="utf-8"
    <meta name="robots" content="noindex">
    <title>Update A User</title>
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
                <li><a class="active" href="users.php">Users</a></li>
                <li><a href="add_user.php">Add User</a></li>
                <li><a href="transactions.php">Transactions</a></li>
                <li><a href="generate.php">Generate Code</a></li>
                <li><a href="change_password.php">Change Password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </aside>
    <aside class="right">
        <h1>Update Account</h1>
        <p style="border-bottom: 1px solid #ddd;">
            Logged In as, <?php echo ucfirst($users['username']); ?>.
        </p>
        <p>
            <?php
            if(empty($errors) === false){
                echo "<div class=\"alert alert-danger\">";
                echo '<p>' . implode('<p></p>', $errors) . '</p>';
                echo "</div>";
            }else if(empty($success) === false){
                echo "<div class=\"alert alert-success\">";
                echo '<p>' . implode('<p></p>', $success) . '</p>';
                echo "</div>";
            }
            ?>
        </p>
        <div style="width:270px;">
            <form role="form" name="addUser" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                <p>Username</p>
                <p style="border: 1px solid #ddd; padding: 7px; border-radius: 6px;"><?php echo $record['username']; ?></p>
                </select>
                <p>Balance</label></p>
                <p><input class="form-control" type="text" name="balance" value="<?php echo $record['balance']; ?>"></p>
                </p><p>Suspend User</label></p>
                <p><select class="form-control" name="suspend" >
                    <option value="1">No</option>
                    <option value="0">Yes</option>
                </select></p>
                </p><p>Accept Order</label></p>
                <p><select class="form-control" name="accept" >
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select></p>
                <p><input class="btn btn-success" type="submit" name="submit" value="Update User"></p>
            </form>
                <h1>Change Password</h1>
            <p>You can only change the password for the account selected</p>
            <p>
                <?php
                    if(isset($_POST['password']) && isset($_POST['pass1']) && isset($_POST['pass2'])){
                        $pass1 = $_POST['pass1'];
                        $pass2 = $_POST['pass2'];
                        if(!empty($pass1) && !empty($pass2)){
                            if($pass1 === $pass2){
                                //update user password
                                $id = $record['id'];
                                //$changePassword = $user->updatePassword($pass1,$id);
                                	echo "<div class=\"alert alert-success\">";
                                    echo "Password Successfully changed";
                                    echo "</div>";
                                
                            }else{
                                echo "<div class=\"alert alert-danger\">";
                                echo "Password does not match";
                                echo "</div>";
                            }
                        } else{
                            echo "<div class=\"alert alert-danger\">";
                            echo "Both fields are required";
                            echo "</div>";
                        }
                    }
                ?>
            </p>
            <form role="form" name="changePassword" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                <p>Password</p>
                <p><input class="form-control" type="password" name="pass1"</p>
                <p>Repeat Password</p>
                <p><input class="form-control" type="password" name="pass2"</p>
                <p><input class="btn btn-primary" type="submit" name="password" value="Change Password"></p>
            </form>
        </div>
    </aside>
</div><!-- main -->
</body>
</html>