<?php
// Include initiate file.
require ('core/init.php');

// if user is not logged in, redirect user to login page
$session->adminLoggedOut();

// Get All users
$users = $user->userdata($_SESSION['id']);
$record = $codes->getCodes();
?>

<!doctype>
<html lang="en">
<head>
    <meta charset="utf-8"
    <meta name="robots" content="noindex">
    <title>Generate</title>
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
                <li><a class="active" href="generate.php">Generate Code</a></li>
                <li><a href="change_password.php">Change Password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </aside>
    <aside class="right">
        <h1>Generate Codes</h1>
        <p style="border-bottom:1px solid #ddd;">
            Logged In as, <?php echo ucfirst($users['username']); ?>.
        </p>
        <p>
        Generated codes to authenticate transactions. Codes must be provided to complete transactions. One code is used for all verifications, Each individual gets a unique token after successful verifications.</p>
        <hr />
        <div style="width:700px;margin-bottom:30px;padding-bottom:30px;border-bottom:1px dashed #999999">
            <div>
                <?php
                if(isset($_POST['submit'])){
                    $code = $_POST['code'];
                    echo '';
                    //$addCode = ;
                    if(!empty($code)){
                        $codes->addCode($code) == true;
                        echo "<div class=\"alert alert-success\">";
                        echo "Code Successfully Added. You would see added code once page has been refreshed";
                        echo "</div>";
                    }else{
                        echo "<div class=\"alert alert-danger\">";
                        echo "Please generate a code above and then click on Add Code";
                        echo "</div>";
                    }
                }
                ?>
            </div>
            <!--<h3 style="color:#f00">Add Code</h3>-->
            <form role="form" name="addCode" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                <p>Uses Codes below for transfer authentications, Use the code type to authenticate each session</p>
            </form>
        </div>
        <div style="margin-bottom:30px;padding-bottom:30px; font-size: 11px;">
            <h3>Generated Codes</h3>
            <table width="73%" class="table table-bordered" style="font-size: 12px;">
              <tr>
                <td width="11%">ID</td>
                <td width="23%">Code</td>
                <td width="32%">Code Type</td>
                <td width="34%">Date Generated</td>
              </tr>
              <?php
                    foreach($record as $data){
                        echo "<tr>";
                        echo "<td>";
                        echo $data['id'];
                        echo "</td>";
                        echo "<td>";
                        echo $data['codes'];
                        echo "</td>";
                        echo "<td>";
                        echo $data['code_type'];
                        echo "</td>";
                        echo "<td>";
                        echo $data['time'];
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