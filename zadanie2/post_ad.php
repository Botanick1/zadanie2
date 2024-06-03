<?php
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    $conn = connectDB();
    $stmt = $conn->prepare("INSERT INTO ads (user_id, title, description) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $title, $description);

    if ($stmt->execute()) {
        header("Location: ads.php");
    } else {
        echo "Ошибка: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<?php include 'templates/header.php'; ?>
<form action="post_ad.php" method="post">
    <label for="title">Заголовок:</label>
    <input type="text" id="title" name="title" required>
    <label for="description">Описание:</label>
    <textarea id="description" name="description" required></textarea>
    <button type="submit">Опубликовать объявление</button>
</form>
<?php include 'templates/footer.php'; ?>
