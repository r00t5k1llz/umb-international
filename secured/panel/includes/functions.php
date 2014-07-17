<?php

function input_validate($input){
    $htmlentities = htmlentities($input);
    $strip_tags = strip_tags($htmlentities);
    return $strip_tags;
}

function login($username, $password){
    $hashed_password = sha1($password);
    $sql = "SELECT `id`, `username` FROM `tbl_users` WHERE `username`= '$username' AND `password`='$hashed_password'";
    $query = mysql_query($sql);
    if(mysql_num_rows($query) > 0){
       return true;
    }else{
        return false;
    }
}
