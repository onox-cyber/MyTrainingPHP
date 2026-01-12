<?php
header("Content-Type: application/json; charset=UTF-8");
require_once("config.php");
include_once("function.php");
session_start();

$json = file_get_contents("php://input");
$data = json_decode($json, true);

if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    echo "正しい形式で入力してください" . json_last_error_msg() . "\n";
    exit();
}

$ary = [
    "is_success" => false,
    "is_invalid_request" => false,
];

if (!verify_csrf_token($data["csrf_token"])) {
    $ary['is_invalid_request'] = true;
    echo json_encode($ary);
    exit();
}

if(isset($data['email']) && !empty($data['email'])
        || isset($data['passwd']) && !empty($data['passwd'])) {
    if (!preg_match("/.+@.+\..+/", $data['email'])) {
        //終了
        echo json_encode($ary);
        exit();
    }
    
    $stmt = $db->prepare('SELECT * FROM users WHERE email=:email AND password=:password');
    $stmt->bindValue(':email', $data['email'],  PDO::PARAM_STR);
    $stmt->bindValue(':password', $data['passwd'],  PDO::PARAM_STR);
    $stmt->execute();

    $record = $stmt->fetch();
    if($record) {
        $_SESSION['is_success'] = true;
        $_SESSION['id'] = $record['id'];
        $_SESSION['name'] = $record['username'];
        
        $ary['is_success'] = true;
    }            
}

echo json_encode($ary);
?>