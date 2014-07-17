<?php
// Start session
session_start();

//unset customs session
unset($_SESSION['loggedInAdmin']);

// Not sure of any all sessions destroyed, end the world
session_destroy();

// All sessions destroyed redirect user to login
if(!isset($_SESSION['loggedInAdmin'])){
    header('Location: http://barc-cp.meximas.com/adminPanel/');
}