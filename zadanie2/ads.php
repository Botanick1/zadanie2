<?php
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = connectDB();
$result = $conn->query("SELECT title, description FROM ads");

$ads = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ads[] = $row;
    }
}

$conn->close();
?>

<?php include 'templates/header.php'; ?>
<h2>Объявления</h2>
<?php foreach ($ads as $ad): ?>
    <div class="ad">
        <h3><?php echo htmlspecialchars($ad['title']); ?></h3>
        <p><?php echo htmlspecialchars($ad['description']); ?></p>
    </div>
<?php endforeach; ?>
<?php include 'templates/footer.php'; ?>
