<?php

$mysqli = new mysqli('localhost', 'root', '', 'notebook');
if ($mysqli->connect_error) {
    die('Ошибка подключения к БД: ' . $mysqli->connect_error);
}

$create_table = "
CREATE TABLE IF NOT EXISTS friends (
    id INT AUTO_INCREMENT PRIMARY KEY,
    surname VARCHAR(50) NOT NULL,
    name VARCHAR(50) NOT NULL,
    lastname VARCHAR(50),
    gender ENUM('мужской', 'женский'),
    date DATE,
    phone VARCHAR(20),
    location VARCHAR(100),
    email VARCHAR(100),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$mysqli->query($create_table);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Записная книжка</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php include 'menu.php'; ?>
    </header>
    
    <main>
        <?php
       $page = isset($_GET['p']) ? $_GET['p'] : 'viewer';

        if (file_exists($page . '.php')) { include $page . '.php';
        } else {
            include 'viewer.php';
        }
        ?>
    </main>
    
    <footer>
    </footer>
</body>
</html>