<?php
class Sessions{

    public function adminAlreadyLoggedIn(){
        return(isset($_SESSION['id']))? true : false;
    }

    public function adminLoggedOut(){
        if($this->adminAlreadyLoggedIn() === false){
            echo header('location: index.php');
        }
    }
}
