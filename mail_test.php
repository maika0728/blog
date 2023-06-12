<?php
// ini_set("SMTP", "smtp.gmail.com");
// ini_set("smtp_port", "587");

mb_language("Japanese");
mb_internal_encoding("UTF-8");

$to = "k.takizawa28@gmail.com"; // 送信先のアドレス
$subject = "テスト送信"; // 件名
$message = "ただいまメールのテスト中です。"; // 本文
$additional_headers = "From: k.takizawa28@gmail.com\r\n"; // ヘッダーオプション

if (mb_send_mail($to, $subject, $message, $additional_headers)) {
    print "メールを送信しました。";
} else {
    print "メール送信に失敗しました。";
}
