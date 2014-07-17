<?php
// Include initiate file.
require ('core/init.php');

// if user is not logged in, redirect user to login page
$session->adminLoggedOut();

// Get All users
$users = $user->userdata($_SESSION['id']);
$record = $transaction->getTransactions();

?>

<!doctype>
<html lang="en">
<head>
    <meta charset="utf-8"
    <meta name="robots" content="noindex">
    <title>Transactions</title>
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
                <li><a href="users.php">Users</a></li>
                <li><a href="add_user.php">Add User</a></li>
                <li><a class="active" href="transactions.php">Transactions</a></li>
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
        <h1>View Users Transactions</h1>
        <p>
            Logged In as, <?php echo ucfirst($users['username']); ?>
        </p>
        <div>
            <table class="table table-bordered form">
                <tr>
                    <td style="font-weight:bold;">ID</td>
                    <td style="font-weight:bold;">UID</td>
                    <td style="font-weight:bold;">T Code</td>
                    <td style="font-weight:bold;">Username</td>
                    <td style="font-weight:bold;">Name</td>
                    <td style="font-weight:bold;">Transfer To</td>
                    <td style="font-weight:bold;">Amount $</td>
                    <td style="font-weight:bold;">Bank</td>
                    <td style="font-weight:bold;">Account No</td>
                    <td style="font-weight:bold;">Routing No</td>
                    <td style="font-weight:bold;">Date</td>
                    <td style="font-weight:bold;">Completed</td>
                </tr>
                <?php
                    foreach($record as $row){
                        echo "<tr>";
                        //echo implode("<p></p>", $error);
                        echo "<td>";
                        echo $row['id'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['uid'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['t_code'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['username'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['name'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['transfer_to'];
                        echo "</td>";
                        echo "<td>";
                        $convert = $row['amount'];
                        echo "\$" . number_format($convert, 2);
                        echo "</td>";
                        echo "<td>";
                        echo $row['bank'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['account_no'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['routing_no'];
                        echo "</td>";
                        echo "<td>";
                        echo $time = $row['time'];
                        echo "</td>";;
                        echo "<td>";
                        $completed = $row['completed'];
                        if($completed == 2){echo "Not Completed";}else{echo "Completed";}
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
    </aside>
</div><!-- main -->
</body>
</html>