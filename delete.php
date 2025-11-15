<?php
    if (isset($_POST["id"])) {
        $id = $_POST["id"];

        $conn = new PDO("mysql:host=localhost;dbname=testdb1;port=3306", "root", "mypassword");

        $sqlRequest = "Delete from users where id=:id";
        $result = $conn->prepare($sqlRequest);

        $result->bindValue(":id", $id);

        try {
            $result->execute();
        }
        catch (PDOException $e) {
            echo "Ошибка sql запроса: " . $e->getMessage();
        }

        echo "<h3>Пользователь с id=$id успешно удалён!<h3> <br>";
        echo "<a href='/index.php'>На главную </a>";
    }
    else{
        echo "Неверно задан id <br>";
        echo "<a href='/index.php'>На главную </a>";
    }
?>