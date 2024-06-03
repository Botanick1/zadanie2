<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = connectDB();
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user_id;
        header("Location: index.php");
    } else {
        echo "Неверное имя пользователя или пароль";
    }

    $stmt->close();
    $conn->close();
}
?>

<?php include 'templates/header.php'; ?>
<form action="login.php" method="post">
    <label for="username">Имя пользователя:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Войти</button>
</form>
<?php include 'templates/footer.php'; ?>
