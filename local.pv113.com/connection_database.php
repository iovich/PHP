<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=pv113', "root", "123456");
    $dbh->exec("set names utf8");
} catch (PDOException $e) {
    echo "Проблема підключення до БД ". $e;
    exit();
}