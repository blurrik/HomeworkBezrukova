<?php
if (isset($_POST['button']) && $_POST['button'] == 'Добавить запись') {
    $surname = $mysqli->real_escape_string($_POST['surname']);
    $name = $mysqli->real_escape_string($_POST['name']);
    $lastname = $mysqli->real_escape_string($_POST['lastname']);
    $gender = $mysqli->real_escape_string($_POST['gender']);
    $date = $mysqli->real_escape_string($_POST['date']);
    $phone = $mysqli->real_escape_string($_POST['phone']);
    $location = $mysqli->real_escape_string($_POST['location']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $comment = $mysqli->real_escape_string($_POST['comment']);
    
    $sql = "INSERT INTO friends (surname, name, lastname, gender, date, phone, location, email, comment) 
            VALUES ('$surname', '$name', '$lastname', '$gender', '$date', '$phone', '$location', '$email', '$comment')";
    
    if ($mysqli->query($sql)) { echo '<div class="success">Запись добавлена</div>';
    } else {
        echo '<div class="error">Ошибка: запись не добавлена</div>';
    }
}
?>

<form name="form_add" method="post">
    <div class="column">
        <div class="add">
            <label>Фамилия</label> 
            <input type="text" name="surname" placeholder="Фамилия" required>
        </div>
        <div class="add">
            <label>Имя</label> 
            <input type="text" name="name" placeholder="Имя" required>
        </div>
        <div class="add">
            <label>Отчество</label> 
            <input type="text" name="lastname" placeholder="Отчество">
        </div>
        <div class="add">
            <label>Пол</label> 
            <select name="gender">
                <option value="мужской">мужской</option>
                <option value="женский">женский</option>
            </select>
        </div>
        <div class="add">
            <label>Дата рождения</label> 
            <input type="date" name="date">
        </div>
        <div class="add">
            <label>Телефон</label> 
            <input type="text" name="phone" placeholder="Телефон">
        </div>
        <div class="add">
            <label>Адрес</label> 
            <input type="text" name="location" placeholder="Адрес">
        </div>
        <div class="add">
            <label>Email</label> 
            <input type="email" name="email" placeholder="Email">
        </div>
        <div class="add">
            <label>Комментарий</label> 
            <textarea name="comment" placeholder="Краткий комментарий"></textarea>
        </div>
        
        <button type="submit" name="button" value="Добавить запись" class="form-btn">Добавить запись</button>
    </div>
</form>