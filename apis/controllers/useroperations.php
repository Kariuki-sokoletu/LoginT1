<?php

require_once("../models/user.php");
$user=new user();

if(isset($_POST['loginuser'])){
    $username=$_POST['username'];
    $pwd=$_POST['pwd'];
    echo json_encode($user->logUserIn($username,$pwd));
}