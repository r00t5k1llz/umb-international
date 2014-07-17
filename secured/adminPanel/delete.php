<?php
require ('core/init.php');
if(isset($_POST['delete'])){
    $userId = $_GET['id'];
    $query = $user->deleteUser($userId);
    $_SESSION['userDeleted'] = "You have successfully deleted users account from your system";
    header('location: users.php');
}else if(isset($_POST['cancel'])){
    header('location: users.php');
}
echo "<title>" . "Confirm Delete" . "</title>";
echo "<link rel=\"stylesheet\" href=\"assets/css/bootstrap.css\">";
echo "<div style=\"width:200px;margin:400px 0 0 500px;\">";
echo "<p>" . "Are you sure you like to delete this account?" . "</p>";
echo "<form name=\"delete\" name=\"{delete.php}\" method=\"post\">";
echo "<input class=\"btn btn-danger\" type=\"submit\" name=\"delete\" value=\"Delete\"> ";
echo "<input class=\"btn btn-primary\" type=\"submit\" name=\"cancel\" value=\"Cancel\">";
echo "</form>";
echo "<div>";
?>