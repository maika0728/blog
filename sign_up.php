<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="./sign_up_check.php" method="post">
        <label for="name">name</label>
        <input type="text" name="name">
        <label for="email">email</label>
        <input type="email" name="email">
        <label for="password">password</label>
        <input type="password" name="password">
        <label for="password2">password(確認)</label>
        <input type="password" name="password2">
        <input type="submit" value="登録する">
    </form>
</body>
</html>