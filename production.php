<?php

session_start();
$user_id = $_SESSION["user_id"];

$dsn = 'mysql:host=localhost;dbname=blogapp;charset=utf8';
$user = "kaima";
$password = "kt7281";

try {

    $pdo = new PDO($dsn, $user, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    //データベースへの
} catch (PDOException $e) {
    /* エラー時は、とりあえず、エラーメッセージを表示 */
    echo "接続エラー: " . $e->getMessage();
}

if (isset($_POST["title"]) and  isset($_POST["category"]) and isset($_POST["post"])) {
    var_dump($_POST);
    $date = date("Y-m-d H:i:s");
    $title = $_POST["title"];
    $category = $_POST["category"];
    $post = $_POST["post"];
    $sql = $pdo->prepare("INSERT INTO article (title,date,category,post,user_id) value (:title,:date,:category,:post,:user_id)");
    $sql->bindParam(":title", $title, PDO::PARAM_STR);
    $sql->bindParam(":date", $date, PDO::PARAM_STR);
    $sql->bindParam(":category", $category, PDO::PARAM_STR);
    $sql->bindParam(":post", $post, PDO::PARAM_STR);
    $sql->bindParam(":user_id", $user_id);
    $sql->execute();
    echo "データベースに投稿されました";
} else {
    echo "未記入があります";
}

$category_sql = $pdo->prepare("SELECT * from category");
$category_sql->execute();
$results = $category_sql->fetchAll(PDO::FETCH_ASSOC);



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
    <h1>記事作成</h1>
    <label for="title">title</label>
    <input type="text" name="title">
    <label for="category">category</label>
    <select name="category">
        <?php
        foreach ($results as $result) {
            echo "<option value='" . $result['category_name'] . "'>" . $result['category_name'] . "</option>";
        }
        ?>

        <label for="text">content</label>
        <textarea name="text" id="textarea" cols="30" rows="10"></textarea>
        <button id="textButton">p</button>
        <button id="list">リスト</button>
        <input type="text" id="h2Input">
        <button id="h2Button">h2</button>
        <button id="h3">h3</button>
        <button id="a">aリンク</button>
        <div id="testspace"></div>
</body>
<script>
    const textarea = document.getElementById("textarea");
    console.log(textarea.value);

    const testspace = document.getElementById("testspace");


    const textButton = document.getElementById("textButton");
    textButton.addEventListener("click", textInput);


    function textInput() {
        const p = document.createElement("p");
        let pText = textarea.value;
        p.innerText = pText;
        testspace.appendChild(p);
    }


    const h2Button = document.getElementById("h2Button");
    h2Button.addEventListener("click", h2Input);

    function h2Input() {

        const h2 = document.createElement("h2");
        let h2Input = document.getElementById("h2Input").value;
        h2.innerText = h2Input;
        testspace.appendChild(h2);
    }
</script>

</html>