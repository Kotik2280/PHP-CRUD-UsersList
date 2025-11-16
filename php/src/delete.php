<?php
    if (isset($_POST["id"])) {
        $id = htmlentities($_POST["id"]);

        $conn = new PDO("mysql:host=db;dbname=testdb1;port=3306", "root", "mypassword");

        $sqlRequest = "Delete from users where id=:id";

        try {
            $result = $conn->prepare($sqlRequest);
            $result->bindValue(":id", $id, PDO::PARAM_INT);
            $result->execute();

            echo "<h3>Пользователь с id=$id успешно удалён!<h3> <br>";
        }
        catch (PDOException $e) {
            echo "Ошибка запроса: " . $e->getMessage();
        }
    }
    else{
        echo "Неверно задан id <br>";
        
    }
    echo "<a href='/index.php'>На главную </a>";
?>