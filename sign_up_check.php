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

if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])){
    if($_POST["password"] == $_POST["password2"]){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $user_password = $_POST["password"];
        $hashed_password = password_hash($password,PASSWORD_DEFAULT);
        $sql = $pdo->prepare("INSERT INTO users (name,email,password) value(:name,:email,:password)");
        $sql->bindParam(":name",$name);
        $sql->bindParam(":email",$email);
        $sql->bindParam(":password",$hashed_password);
        $sql->execute();
        echo "ユーザー情報が登録されました";
        echo "<a href='./login.php'>ログイン画面へ</a>";

    }else{
        echo "パスワードが一致しません。";
    }
}else{
    echo "入力不備があります。";
}





