<?php
// Include initiate file.
require ('core/init.php');

// if user is not logged in, redirect user to login page
$session->adminLoggedOut();

// Get All users
$users = $user->userdata($_SESSION['id']);

?>
<?php
    if(isset($_POST['submit']) && $_POST['submit']==="Add User"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $account_number = $_POST['account_number'];
        $account_name = $_POST['account_name'];
        $account_type = $_POST['account_type'];
        $balance = $_POST['balance'];
        $email = $_POST['email'];
        $country = $_POST['country'];

            if(empty($username) || strlen($username) < 5){
                $errors[] = 'Username should be more than 5 characters';
            }else if($user->userExists($username)){
                $errors[] = 'Username already entered';
            }else{
                $_SESSION['username'] = $username;
            }
            if(strlen($password) < 6){
                $errors[] = 'Password must be more than 6 letters';
            }else{
                $_SESSION['password'] = $password;
            }
            if(strlen($account_number) < 13 || strlen($account_number) > 13){
                $errors[] = 'Account number should be exactly 13 digits';
            }else if(!is_numeric($account_number)){
                $errors [] = 'Account number should be only numbers';
            }else{
                $_SESSION['account_num'] = $account_number;
            }
            if(empty($account_name) || is_numeric($account_name)){
                $errors[] = 'Account name should be letters';
            }else{
                $_SESSION['account_nam'] = $account_name;
            }
            if(empty($balance) || !is_numeric($balance)){
                $errors[] = 'Balance should be only numbers';
            }else{
                $_SESSION['balance'] = $balance;
            }
            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
                $errors[] = "Enter a valid email address";
            }else if($user->emailExists($email)){
                $errors[] = "Email address already exist";
            }else{
                $_SESSION['email'] = $email;
            }
            if(empty($country) || is_numeric($country)){
                $errors[] = 'Country name must be only letters';
            }else{
                $_SESSION['country'] = $country;
            }
            if(empty($errors) === true){
              $addUser = $user->addUser($username, $password, $email, $account_name, $country, $account_type, $account_number, $balance);
               $success[] = 'User successfully Added for: ' . ucfirst($username);
            }
    }
?>
<!doctype>
<html lang="en">
<head>
    <meta charset="utf-8"
    <meta name="robots" content="noindex">
    <title>Add Users</title>
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
                <li><a class="active" href="add_user.php">Add User</a></li>
                <li><a href="transactions.php">Transactions</a></li>
                <li><a href="generate.php">Generate Code</a></li>
                <li><a href="change_password.php">Change Password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </aside>
    <aside class="right">
        <h1>Create New Account</h1>
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
                <p><input class="form-control" type="text" name="username" value="<?php if(isset($_SESSION['username'])){echo $_SESSION['username']; unset($_SESSION['username']);};?>"></p>
                <p>Password</label></p>
                <p><input class="form-control" type="text" name="password" value="<?php if(isset($_SESSION['password'])){echo $_SESSION['password'];unset($_SESSION['password']);};?>"></p>
                <p>Account Number</p>
                <p><input class="form-control" type="text" name="account_number" value="<?php if(isset($_SESSION['account_num'])){echo $_SESSION['account_num'];unset($_SESSION['account_num']);};?>"></p>
                <p>Account Name</label></p>
                <p><input class="form-control" type="text" name="account_name" value="<?php if(isset($_SESSION['account_nam'])){echo $_SESSION['account_nam'];unset($_SESSION['account_nam']);};?>"></p>
                <p>Account Type</label></p>
                <select class="form-control" name="account_type">
                    <option>Savings</option>
                    <option>Fixed</option>
                    <option>Escrow</option>
                    <option>Non Residential</option>
                </select>
                <p>Balance</label></p>
                <p><input class="form-control" type="text" name="balance" value="<?php if(isset($_SESSION['balance'])){echo $_SESSION['balance'];unset($_SESSION['balance']);};?>"></p>
                <p>Email Address</label></p>
                <p><input class="form-control" type="text" name="email" value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email'];unset($_SESSION['email']);};?>"></p>
                <p>Country</label></p>
                <p><input class="form-control" type="text" name="country" value="<?php if(isset($_SESSION['country'])){echo $_SESSION['country'];unset($_SESSION['country']);};?>"></p>
                <p><input class="btn btn-success" type="submit" name="submit" value="Add User"></p>
            </form>
        </div>
    </aside>
</div><!-- main -->
</body>
</html>