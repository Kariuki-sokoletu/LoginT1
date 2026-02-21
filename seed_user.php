<?php
require_once('../LoginT1/apis/models/db.php');


$username = "karis";
$pwd = "k@r1s";
$hash = password_hash($pwd,PASSWORD_DEFAULT);

//$stmt = $pdo->prepare("INSERT INTO users(username,pwd,isActive) VALUES(?,?,1)");
//$stmt->execute([$username,$hash]);

echo "seeded user:$username / $pwd";
