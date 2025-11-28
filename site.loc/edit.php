<?php
if (isset($_POST['button']) && $_POST['button'] == 'Изменить запись') {
    $id = intval($_POST['id']);
    $surname = $mysqli->real_escape_string($_POST['surname']);
    $name = $mysqli->real_escape_string($_POST['name']);
    $lastname = $mysqli->real_escape_string($_POST['lastname']);
    $gender = $mysqli->real_escape_string($_POST['gender']);
    $date = $mysqli->real_escape_string($_POST['date']);
    $phone = $mysqli->real_escape_string($_POST['phone']);
    $location = $mysqli->real_escape_string($_POST['location']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $comment = $mysqli->real_escape_string($_POST['comment']);
    
    $sql = "UPDATE friends SET surname='$surname', name='$name', lastname='$lastname', 
            gender='$gender', date='$date', phone='$phone', location='$location', 
            email='$email', comment='$comment' WHERE id=$id";
    
    if ($mysqli->query($sql)) {
        echo '<div class="success">Данные изменены</div>';
        $_GET['id'] = $id; 
    } else {
        echo '<div class="error">Ошибка изменения данных</div>';
    }
}

$currentROW = [];
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $mysqli->query("SELECT * FROM friends WHERE id=$id");
    $currentROW = $result->fetch_assoc();
}

if (!$currentROW) {
    $result = $mysqli->query("SELECT * FROM friends ORDER BY surname, name LIMIT 1");
    $currentROW = $result->fetch_assoc();
    if ($currentROW) {
        $_GET['id'] = $currentROW['id'];
    }
}

$result = $mysqli->query("SELECT id, surname, name FROM friends ORDER BY surname, name");
?>

<div class="add">
    <div class="div-edit">
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $isCurrent = isset($currentROW['id']) && $currentROW['id'] == $row['id'];
                $class = $isCurrent ? 'currentRow' : '';
                
                if ($isCurrent) {
                    echo '<div class="' . $class . '">' . $row['surname'] . ' ' . $row['name'] . '</div>';
                } else {
                    echo '<a href="?p=edit&id=' . $row['id'] . '">' . $row['surname'] . ' ' . $row['name'] . '</a><br>';
                }
            }
        } else {
            echo 'Записей пока нет';
        }
        ?>
    </div>
    
    <div class="column">
        <?php if ($currentROW): ?>
        <form name="form_edit" method="post">
            <input type="hidden" name="id" value="<?= $currentROW['id'] ?>">
            
            <div class="add">
                <label>Фамилия</label> 
                <input type="text" name="surname" value="<?= htmlspecialchars($currentROW['surname']) ?>" required>
            </div>
            <div class="add">
                <label>Имя</label> 
                <input type="text" name="name" value="<?= htmlspecialchars($currentROW['name']) ?>" required>
            </div>
            <div class="add">
                <label>Отчество</label> 
                <input type="text" name="lastname" value="<?= htmlspecialchars($currentROW['lastname']) ?>">
            </div>
            <div class="add">
                <label>Пол</label> 
                <select name="gender">
                    <option value="мужской" <?= $currentROW['gender'] == 'мужской' ? 'selected' : '' ?>>мужской</option>
                    <option value="женский" <?= $currentROW['gender'] == 'женский' ? 'selected' : '' ?>>женский</option>
                </select>
            </div>
            <div class="add">
                <label>Дата рождения</label> 
                <input type="date" name="date" value="<?= $currentROW['date'] ?>">
            </div>
            <div class="add">
                <label>Телефон</label> 
                <input type="text" name="phone" value="<?= htmlspecialchars($currentROW['phone']) ?>">
            </div>
            <div class="add">
                <label>Адрес</label> 
                <input type="text" name="location" value="<?= htmlspecialchars($currentROW['location']) ?>">
            </div>
            <div class="add">
                <label>Email</label> 
                <input type="email" name="email" value="<?= htmlspecialchars($currentROW['email']) ?>">
            </div>
            <div class="add">
                <label>Комментарий</label> 
                <textarea name="comment"><?= htmlspecialchars($currentROW['comment']) ?></textarea>
            </div>
            
            <button type="submit" name="button" value="Изменить запись" class="form-btn">Изменить запись</button>
        </form>
        <?php endif; ?>
    </div>
</div>