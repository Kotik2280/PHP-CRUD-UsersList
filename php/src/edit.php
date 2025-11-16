<?php
    if (isset($_GET["id"])) {
        $id = htmlentities($_GET["id"]);
        $conn = new PDO("mysql:host=db;dbname=testdb1;port=3306", "root", "mypassword");
        
        $sqlRequest = "Select * from users where id=:id";

        $result = null;

        try {
            $result = $conn->prepare($sqlRequest);
            $result->bindValue(":id", $id, PDO::PARAM_INT);
            $result->execute();
        }
        catch (PDOException $e) {
            echo "Ошибка запроса: " . $e->getMessage();
        }

        if ($result == null) {
            echo "<h3>Запрос завершился с ошибкой!</h3>";
        }
        else if ($result->rowCount() == 0) {
            echo "<h3>Пользователь с id=$id не найден!";
        }
        else {
            $user = $result->fetch();
            
            echo "<form action='/edit.php' method='POST'/>";

            echo "<h3>Изменение данных пользователя</h3>";

            echo "<input type='hidden' name='id' value='$id'>";
            echo "<p> Имя:  <input type='text' name='name' value='{$user['name']}' /></p>";
            echo "<p> Возраст:  <input type='number' name='age' value='{$user['age']}' /></p>";
            
            echo "<input type='submit' value='Изменить' />";

            echo "</form>";
        }
    }
    else if (isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["age"]) && $_POST["name"] != '' && $_POST["age"] != 0) {
        $id = htmlentities($_POST["id"]);
        $newName = htmlentities($_POST["name"]);
        $newAge = htmlentities($_POST["age"]);

        $conn = new PDO("mysql:host=db;dbname=testdb1;port=3306", "root", "mypassword");

        $sqlRequest = "Select * from users where id=:id";

        $result = null;

        try {
            $result = $conn->prepare($sqlRequest);
            $result->bindValue(":id", $id, PDO::PARAM_INT);
            $result->execute();
        }
        catch (PDOException $e) {
            echo "Ошибка запроса: " . $e->getMessage();
        }

        if ($result == null) {
            echo "<h3>Запрос завершился с ошибкой!</h3>";
        }
        else if ($result->rowCount() == 0) {
            echo "<h3>Пользователь с id=$id не найден!";
        }
        else {
            $user = $result->fetch();
            
            $sqlRequest = "Update users Set name=:newName, age=:newAge where id=:id";

            try {
                $result = $conn->prepare($sqlRequest);
                $result->bindValue(":newName", $newName, PDO::PARAM_STR);
                $result->bindValue(":newAge", $newAge, PDO::PARAM_INT);
                $result->bindValue(":id", $id, PDO::PARAM_INT);
                $result->execute();

                echo "<h3>Данные пользователя успешно обновлены!</h3>";
                echo "{$user['name']} {$user['age']} -> $newName $newAge <br>";
            }
            catch (PDOException $e) {
                echo "Ошибка обновления данных: " . $e->getMessage();
            }
        }
    }
    else {
        echo "Переданы некорректные данные <br>";
    }
    echo "<a href='/index.php'>На главную </a>";
?>