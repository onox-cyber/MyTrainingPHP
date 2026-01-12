<?php
function generate_csrf_token() {
    // セッションが開始されていない場合は開始
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // 既存のトークンがあればそれを返す（二重生成を防ぐ）
    if (isset($_SESSION['csrf_token'])) {
        return $_SESSION['csrf_token'];
    }
    
    // 新しいトークンを生成（64文字のランダム文字列）
    $token = bin2hex(random_bytes(32));
    
    // セッションに保存
    $_SESSION['csrf_token'] = $token;
    
    return $token;
}

function verify_csrf_token($token) {
    // セッションが開始されていない場合は開始
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // セッションにトークンがない場合は無効
    if (!isset($_SESSION['csrf_token'])) {
        return false;
    }
    
    // タイミング攻撃を防ぐためhash_equals()を使用
    return hash_equals($_SESSION['csrf_token'], $token);
}

function check_session() {
    
}
?>