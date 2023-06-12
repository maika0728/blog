<?php
session_start();
$user_id = $_SESSION["user_id"];
echo $user_id;

$dsn = 'mysql:host=localhost;dbname=blogapp;charset=utf8';
$user = "kaima";
$password = "kt7281";

var_dump($_POST);



try{

    $pdo = new PDO($dsn,$user,$password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    //データベースへの
}catch(PDOException $e){
     /* エラー時は、とりあえず、エラーメッセージを表示 */
      echo "接続エラー: " . $e->getMessage();
}


    if (isset($_POST["category"])) {
        $category = $_POST["category"];
        $sql = $pdo->prepare("INSERT INTO category (category_name) VALUES (:category_name)");
        $sql->bindParam(":category_name", $category);
        $sql->execute();
        echo "成功しました。";
    } else {
        
    }



$category_sql = $pdo->prepare("SELECT * from category");
$category_sql->execute();
$results = $category_sql->fetchAll(PDO::FETCH_ASSOC);


if(isset($_POST["child_category"])){
    if(isset($_POST["child_category"]) && isset($_POST["parent_category"])){
        echo "yaa";
    $child_category = $_POST["child_category"];
     //親のIDを探す
    $parent_category_name = $_POST["parent_category"];
    $search_parentId_sql = $pdo->prepare("SELECT * from category where category_name = :category_name");
   
    $search_parentId_sql->bindParam(":category_name",$parent_category_name);
    $search_parentId_sql->execute();
    $result = $search_parentId_sql->fetch(PDO::FETCH_ASSOC);
    $parent_id = $result["id"];
    
    $sql = $pdo->prepare("INSERT INTO category (category_name,parent_id,user_id) VALUES (:category_name,:parent_id,:user_id)");
    $sql->bindParam(":category_name",$child_category);
    $sql->bindParam(":parent_id",$parent_id);
    $sql->bindParam(":user_id",$user_id);
    $sql->execute();
    echo "登録できました";
} else{
    echo "登録できませんでした。";
}

}else{

}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カテゴリーをつくる</title>
</head>
<body>
    <form action="" method="post">
        <label for="category">カテゴリーを追加する</label>
        <input type="text" name="category">
        <input type="submit" value="追加">
    </form>
    <form action="" method="post">
        <label for="child_category">子カテゴリーを追加する</label>
        <select name="parent_category">
             <?php
                foreach($results as $result){
                    echo "<option value='".$result['category_name']."'>".$result['category_name']."</option>";
                }
            ?>
        </select>
        <input type="text" name="child_category">
        <input type="submit" value="追加する">
    </form>
</body>
</html>