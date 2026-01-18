<?php
try {
    $db = new PDO("mysql:dbname=test;host=localhost;charset=utf8", "root", "root");
} catch(PDOExcenption $e) {
    echo $e->getMessage();
    exit();
}
?>
