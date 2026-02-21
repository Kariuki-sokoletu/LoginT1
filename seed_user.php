<?php
require_once('../LoginT1/apis/models/db.php');

$pdo =connect();


$username = "karis";
$pwd = "k@r1s";
$hash = password_hash($pwd,PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO users(username,pwd) VALUES(?,?)");
$stmt->execute([$username,$hash,"ADMIN"]);

echo "seeded user:$username / $pwd";
