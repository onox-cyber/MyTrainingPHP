<?php
try {
    $db = new PDO("mysql:dbname=test;host=localhost;charset=utf8", "root", "f7HGp6y3ES-6xe");
} catch(PDOExcenption $e) {
    echo $e->getMessage();
    exit();
}
?>