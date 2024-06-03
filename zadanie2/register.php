<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $conn = connectDB();
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        echo "Ошибка: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<?php include 'templates/header.php'; ?>
<form action="register.php" method="post">
    <label for="username">Имя пользователя:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Зарегистрироваться</button>
</form>
<?php include 'templates/footer.php'; ?>
