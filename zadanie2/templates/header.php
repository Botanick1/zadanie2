<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Задание2</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Авитушка</h1>
        <nav>
            <ul>
                <li><a href="index.php">Главная</a></li>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li><a href="post_ad.php">Добавить объявление</a></li>
                    <li><a href="ads.php">Объявления</a></li>
                    <li><a href="logout.php">Выйти</a></li>
                <?php else: ?>
                    <li><a href="register.php">Регистрация</a></li>
                    <li><a href="login.php">Войти</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
