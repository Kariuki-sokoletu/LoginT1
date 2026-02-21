<?php

session_start();
$sql='';

class db{
    private $servename;
    private $username;
    private $pwd;
    private $dbname;
    private $charset;
    public $userid;
    public $platform;
    public $systemadmin;


    function __construct(){
        $this->userid=isset($_SESSION['userid'])?$_SESSION['userid']:1;
    }

    function connect(){

        $this->servername="localhost";
        $this->charset="utf8mb4";
        $this->username="root";
        $this->pwd="";
        $this->dbname='schoolerp1';

        try {
            $dsn="mysql:host=".$this->servername.";dbname=".$this->dbname.";charset=".$this->charset;
            $pdo=new PDO($dsn,$this->username,$this->pwd);
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }catch(PDOException $e) {
         echo "Connection failed: ".$e->getMessage();   
        }
    }

    function getData($sql){
        return $this->connect()->query($sql);
    }

    function getJSON($sql){
        $rst=$this->getData($sql);
        return json_encode($rst->fetchAll(PDO::FETCH_ASSOC));
    }
}