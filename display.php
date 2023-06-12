<?php

$dsn = 'mysql:host=localhost;dbname=blogapp;charset=utf8';
$user = "kaima";
$password = "kt7281";

$id = $_GET['id'];
var_dump($id);

try{

    $pdo = new PDO($dsn,$user,$password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    //データベースへの
}catch(PDOException $e){
     /* エラー時は、とりあえず、エラーメッセージを表示 */
      echo "接続エラー: " . $e->getMessage();
}


$sql =$pdo->prepare("SELECT title,date,category,post FROM article where id = :id");
$sql->bindParam(":id",$id,PDO::PARAM_INT);
$sql->execute();
$result = $sql->fetch();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
            echo "<h1>".$result['title']."</h1>";
            echo "<p>".$result['date']."</p>";
            echo "<p>".$result['category']."</p>";
            echo "<br>";
            echo "<p>".$result['post']."</p>";

?>
</body>
</html>