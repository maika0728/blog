<?php
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    
    // メールのヘッダー情報を設定
    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();
    
    // メールの本文を作成
    $mailContent = "Name: $name\n\n";
    $mailContent .= "Email: $email\n\n";
    $mailContent .= "Subject: $subject\n\n";
    $mailContent .= "Message: $message\n\n";
    
    // メールを送信
    $to = "your-email@example.com"; // 宛先のメールアドレスを設定
    $subject = "お問い合わせ"; // メールの件名を設定
    
    if (mail($to, $subject, $mailContent, $headers)) {
        echo "お問い合わせメールが送信されました。";
    } else {
        echo "メールの送信に失敗しました。";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>お問い合わせフォーム</title>
</head>
<body>
    <h1>お問い合わせフォーム</h1>
    <form method="post" action="">
        <label for="name">名前:</label>
        <input type="text" name="name" id="name" required>
        
        <label for="email">メールアドレス:</label>
        <input type="email" name="email" id="email" required>
        
        <label for="subject">件名:</label>
        <input type="text" name="subject" id="subject" required>
        
        <label for="message">メッセージ:</label>
        <textarea name="message" id="message" rows="5" required></textarea>
        
        <input type="submit" name="submit" value="送信">
    </form>
</body>
</html>

