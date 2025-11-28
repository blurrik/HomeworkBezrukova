<?php
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    
    $result = $mysqli->query("SELECT surname FROM friends WHERE id=$delete_id");
    if ($result && $row = $result->fetch_assoc()) {
        $surname = $row['surname'];
        
        if ($mysqli->query("DELETE FROM friends WHERE id=$delete_id")) {
            echo '<div class="success">Запись с фамилией ' . htmlspecialchars($surname) . ' удалена</div>';
        } else {
            echo '<div class="error">Ошибка удаления записи</div>';
        }
    }
}

$result = $mysqli->query("SELECT id, surname, name FROM friends ORDER BY surname, name");
?>

<div class="div-edit">
    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $initials = $row['surname'] . ' ' . mb_substr($row['name'], 0, 1) . '.';
            echo '<a href="?p=delete&delete_id=' . $row['id'] . '">' . $initials . '</a><br>';
        }
    } else {
        echo 'Записей пока нет';
    }
    ?>
</div>