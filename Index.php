<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $conn = new PDO("mysql:host=localhost;dbname=testdb1;port=3306", "root", "mypassword");

        $sqlRequest = "Select * from users";
        $result = $conn->query($sqlRequest);

        echo "<h3> Пользователи </h3>";
        echo "<table>";

        while ($user = $result->fetch()) {
            echo "<tr>";

            echo "<td> {$user['id']} </td>";
            echo "<td> {$user['name']} </td>";
            echo "<td> {$user['age']} </td>";
            echo "<td> <a href='/edit.php?id={$user["id"]}'>Редактировать</a> </td>";
            echo "<td>";

            echo "<form action='/delete.php' method='POST'>";
            echo "<input type='hidden' name='id' value='{$user["id"]}' />";
            echo "<input type='submit' value='Удалить' />";
            echo "</form>";

            echo "</td>";

            echo "</tr>";
        }

        echo "</table>";
    ?>
</body>
</html>