<?php
// Include initiate file.
require ('core/init.php');

// if user is not logged in, redirect user to login page
$session->adminLoggedOut();

// Get All users
$users = $user->userdata($_SESSION['id']);
$record = $user->getAllUsers();

?>

<!doctype>
<html lang="en">
<head>
    <meta charset="utf-8"
    <meta name="robots" content="noindex">
    <title>Users</title>
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript">
        function confirmDelete(){
                //var x;
                var r=confirm("Do you still want to delete this user account");
                if (r==true){
                    return true;
                }else{
                    return false
                }

        }
    </script>
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
        <p>
            <?php
            if(isset($_SESSION['userDeleted'])){
                $d_message = $_SESSION['userDeleted'];
                echo "<div class=\"alert alert-success\">";
                echo $d_message;
                echo "</div>";
                unset($_SESSION['userDeleted']);
            }
            ?>
        </p>
        <h1>View Users</h1>
        <p>
            Logged In as, <?php echo ucfirst($users['username']); ?>.
        </p>
        <div>
            <table class="table table-bordered form">
                <tr>
                    <td style="font-weight:bold;">ID</td>
                    <td style="font-weight:bold;">Username</td>
                    <td style="font-weight:bold;">Role</td>
                    <td style="font-weight:bold;">Name</td>
                    <td style="font-weight:bold;">Account Type</td>
                    <td style="font-weight:bold;">Account No.</td>
                    <td style="font-weight:bold;">Balance</td>
                    <td style="font-weight:bold;">Created</td>
                    <td style="font-weight:bold;">Action</td>
                </tr>
            <?php
                foreach($record as $row){
                    echo "<tr>";
                    echo "<td>";
                    echo $row['id'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['username'];
                    echo "</td>";
                    echo "<td>";
                    $level = $row['user_level'];
                    echo $role = ($level == 5)?  "<span class=\"label label-success\">" . "Admin" . "</span>":   "<span class=\"label label-warning\">" . "User" . "</span>";
                    echo "</td>";
                    echo "<td>";
                    echo $row['account_name'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['account_type'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['account_no'];
                    echo "</td>";
                    echo "<td>";
                    $amount = $row['balance'];
                    echo "\$" . number_format($amount, 2);
                    echo "</td>";
                    echo "<td>";
                    $time = $row['time'];
                    echo date('m, D Y', $time);
                    echo "</td>";
                    echo "<td>";
                    $id = $row['id'];
                    echo "<a href=\"edit.php?id=$id\"><img src=\"assets/img/edit.png\" width=20 height=20></a>
                    <a href=\"delete.php?id=$id\"><img src=\"assets/img/delete.png\" width=20 height=20></a>";
                    echo "</tr>";
                }
            ?>
            </table>
        </div>
    </aside>
</div><!-- main -->
</body>
</html>