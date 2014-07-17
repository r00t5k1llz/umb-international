<?php
require 'core/init.php';

// Admin already logged in
if($session->adminAlreadyLoggedIn() === true){
    echo header('location: dashboard.php');
}

if (empty($_POST) === false) {
    // Set variables to grab form fields from form
    $username = trim($_POST['username']);// Get username
    $password = trim($_POST['password']);// Get password

    // Validate form inputs
    if (empty($username) === true || empty($password) === true) {
        // Check if form fields are not empty and continue with form
        // Processing
        $errors[] = 'Please provide username and password.';
    } else if ($user->userExists($username) === false) {
        // Check for user exist and return an error message,
        // Username and password combination is invalid
        $errors[] = 'Invalid username/password combination';
    } else if ($user->emailConfirmed($username) === false) {
        // Check if account has been verified for spam registrations
        $errors[] = 'Please check your email to verify your account.';
    }else if($user->accountSuspended($username) === false){
        // Return a suspended account message to the user
        // If query amount to true and continue to perform a
        // A final login process
        $errors[] = 'Your account has been suspended. Please contact
                    ' . '<a class="loginErrors" href="../contact_us.php"
                    title="Contact us">customer support</a>';
    } else {
        // User successfully gone through all validation process and
        // Can be granted access.
        $login = $user->login($username, $password);
        if($login && $user->isAdmin($username)){
            // Admin logged in Set session to true
            $_SESSION['id'] =  $login;
            header('Location: dashboard.php');
            exit();
        }else{
            $errors[] = 'Invalid username/password combination';
        }
    }
}
?>
<!doctype>
<html lang="en">
<head>
    <meta charset="utf-8"
    <meta name="robots" content="noindex">
    <title>Admin cPanel</title>
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
</head>
<body>
<!-- begin page design here -->
  <div class="form" style="width:370px;margin:100px auto 0;border:1px dashed #ccc;padding:20px;">

      <?php
      if(empty($errors) == false){
          echo "<div class=\"alert alert-danger\">";
          echo implode('<br />', $errors);
          echo "</div>";
      }
      ?>

      <form role="role" class="form" name="adminLogin" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <fieldset>
            <legend>Administrative Login (Dashboard)</legend>
            <table class="form">
                <tr>
                    <td>Username</td>
                    <td><input class="form-control" type="text" name="username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input class="form-control" type="password" name="password"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input class="btn btn-success" type="submit" name="login" value="Enter"></td>
                </tr>
            </table>
        </fieldset>

    </form>
  </div>
</body>
</html>