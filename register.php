<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Подключение к базе данных
    $servername = "localhost";
    $dbusername = " mitchdemi@localhost"; // Замените на ваше имя пользователя
    $dbpassword = "Periwinkle1337"; // Замените на ваш пароль
    $dbname = "sqlgranate";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Проверка подключения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Вставка данных в таблицу
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>