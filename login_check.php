<?php

$dsn = 'mysql:host=localhost;dbname=blogapp;charset=utf8';
$user = "kaima";
$password = "kt7281";

try{

    $pdo = new PDO($dsn,$user,$password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    //データベースへの
}catch(PDOException $e){
     /* エラー時は、とりあえず、エラーメッセージを表示 */
      echo "接続エラー: " . $e->getMessage();
}

var_dump($_POST);

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $user_password = $_POST["password"];

    $sql = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $sql->bindParam(":email", $email);
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $hashed_password = $result["password"];

        if (password_verify($user_password, $hashed_password)) {
            echo "ログインできました。";
            session_start();
            $_SESSION["name"] = $result["name"];
            $_SESSION["user_id"] = $result["id"];
            echo "<a href='./menu.php'>menuへ</a>";
        } else {
            echo "パスワードが間違っています。";
        }
    } else {
        echo "登録されているemailはありません。";
    }
} else {
    echo "未入力の項目があります。";
}
