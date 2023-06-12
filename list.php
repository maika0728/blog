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

//タイトルをもってくる。いやタイトルだけだと厳しくないか。リンクをidによって表示するブログをわける
$sql = $pdo->prepare("SELECT * from article ");
$sql->execute();
$results = $sql->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログタイトル一覧</title>
</head>
<body>
    <?php
        foreach($results as $result){
    echo "<div><date>".$result['date']." </date>";
    echo "<a href='./display.php?id=".$result['id']."'>".$result['title']."</a></div>";
}
    ?>
</body>
</html>