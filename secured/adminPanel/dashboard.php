<?php
// Include initiate file.
require ('core/init.php');

// if user is not logged in, redirect user to login page
$session->adminLoggedOut();

// Get All users
$users = $user->userdata($_SESSION['id']);

?>

<!doctype>
<html lang="en">
<head>
    <meta charset="utf-8"
    <meta name="robots" content="noindex">
    <title>Dashboard</title>
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
</head>
<body>
<!-- begin page design here -->
    <div class="main">
        <aside class="left">
            <nav>
                <ul>
                    <li><a class="active" href="dashboard.php">Home</a></li>
                    <li><a href="users.php">Users</a></li>
                    <li><a href="add_user.php">Add User</a></li>
                    <li><a href="transactions.php">Transactions</a></li>
                    <li><a href="generate.php">Generate Code</a></li>
                    <li><a href="change_password.php">Change Password</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </aside>
        <aside class="right">
            <h1>Dashboard</h1>
            <p style="border-bottom:1px solid #ddd;">
                Logged In as, <?php echo ucfirst($users['username']); ?>.
            </p>
            <p>
                You are Logged in, manage users(Views Users, Add Users, Deleted and Update Users) as well as view users transactions
            </p>
                <ul style="list-style: none;">
                    <li><a href="users.php">List Users Available</a></li>
                    <li><a href="add_user.php">Add A News User</a></li>
                    <li><a href="transactions.php">Transactions By users</a></li>
                    <li><a href="change_password.php">Change Password</a></li>
                </ul>
        </aside>
    </div><!-- main -->
</body>
</html>