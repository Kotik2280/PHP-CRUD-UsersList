<?php
    if (isset($_POST["name"]) && isset($_POST["age"]) && $_POST["name"] != '' && $_POST["age"] > 0) {
        $name = htmlentities($_POST["name"]);
        $age = htmlentities($_POST["age"]);

        $conn = new PDO("mysql:host=db;dbname=testdb1;port=3306", "root", "mypassword");

        $sqlRequest = "Insert into users (name, age) values (:name, :age)";
        
        try {
            $result = $conn->prepare($sqlRequest);
            $result->bindValue(":name", $name, PDO::PARAM_STR);
            $result->bindValue(":age", $age, PDO::PARAM_INT);
            $result->execute();

            echo "<h3>Пользователь $name успешно добавлен!</h3>";
        }
        catch (PDOException $e) {
            echo "Ошибка запроса: " . $e->getMessage();
        }
    }
    else {
        echo "Переданы некорректные данные <br>";
    }
    echo "<a href='/index.php'>На главную </a>";
?>