<?php

require_once('db.php');

class User extends db{

function logUserIn($username,$pwd){
$sql="CALL sp_getuserdetails ('{$username}')";
$rst=$this->connect()->query($sql);
if($rst->rowCount()){
    $row = $rst->fetch();
    if($row['pwd'] === hash('SHA256',$pwd.$row['salt'])){
        if($row['status']=='active'){
            $_SESSION['userid']=$row['userid'];
            $_SESSION['username']=$row['username'];
            $_SESSION['firstname']=$row['firstname'];
            $_SESSION['middlename']=$row['middlename'];
            $_SESSION['lastname']=$row['lastname'];
            $_SESSION['systemadmin']=$row['systemadmin'];
            if($row['changepasswordonlogon']==true){
                return ["status"=>"change password","message"=>"change password","userid"=>$row['userid']];
            }else{
                return ["status"=>"success","message"=>"login successful","userid"=>$row['userid']];
            }

        }else{
            return ["status"=>"inactive","message"=>"account inactive","userid"=>$row['userid']];
        }
    }else{
        return ["status"=>"invalid","message"=>"invalid credentials"];
    }
}
}
    
}