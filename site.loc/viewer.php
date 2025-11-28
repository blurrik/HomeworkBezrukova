<?php
function getFriendsList($type = 'byid', $page = 0) {
    global $mysqli;
    
    if ($mysqli->connect_error) { return 'Ошибка подключения к БД: ' . $mysqli->connect_error; }
    
    switch ($type) {
        case 'surname':
            $order = 'surname ASC, name ASC';
            break;
        case 'date':
            $order = 'date ASC';
            break;
        default:
            $order = 'id ASC';
    }
    
    $count_result = $mysqli->query('SELECT COUNT(*) as total FROM friends');
    $total_row = $count_result->fetch_assoc();
    $TOTAL = $total_row['total'];
    
    if ($TOTAL == 0) { return 'В таблице нет данных'; }
    
    $PAGES = ceil($TOTAL / 10);
    $start = $page * 10;
    
    if ($page >= $PAGES) {
        $page = $PAGES - 1;
        $start = $page * 10;
    }
    
    $sql = "SELECT * FROM friends ORDER BY $order LIMIT $start, 10";
    $result = $mysqli->query($sql);
    
    if (!$result) { return 'Ошибка выполнения запроса: ' . $mysqli->error; }
    
    $ret = '<table border="1">';
    $ret .= '
    <tr>
    <th>Фамилия</th>
    <th>Имя</th>
    <th>Отчество</th>
    <th>Пол</th>
    <th>Дата рождения</th>
    <th>Телефон</th>
    <th>Адрес</th>
    <th>Email</th>
    <th>Комментарий</th>
    </tr>';
    
    while ($row = $result->fetch_assoc()) {
        $ret .= '<tr>';
        $ret .= '<td>' . htmlspecialchars($row['surname']) . '</td>';
        $ret .= '<td>' . htmlspecialchars($row['name']) . '</td>';
        $ret .= '<td>' . htmlspecialchars($row['lastname']) . '</td>';
        $ret .= '<td>' . htmlspecialchars($row['gender']) . '</td>';
        $ret .= '<td>' . htmlspecialchars($row['date']) . '</td>';
        $ret .= '<td>' . htmlspecialchars($row['phone']) . '</td>';
        $ret .= '<td>' . htmlspecialchars($row['location']) . '</td>';
        $ret .= '<td>' . htmlspecialchars($row['email']) . '</td>';
        $ret .= '<td>' . htmlspecialchars($row['comment']) . '</td>';
        $ret .= '</tr>';
    }
    
    $ret .= '</table>';
    
    if ($PAGES > 1) {
        $ret .= '<div class="pagination">';
        for ($i = 0; $i < $PAGES; $i++) {
            if ($i != $page) {
                $ret .= '<a href="?p=viewer&sort=' . $type . '&pg=' . $i . '">' . ($i + 1) . '</a> ';
            } else {
                $ret .= '<span>' . ($i + 1) . '</span> ';
            }
        }
        $ret .= '</div>';
    }
    
    return $ret;
}

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'byid';
$page = isset($_GET['pg']) ? intval($_GET['pg']) : 0;

echo getFriendsList($sort, $page);
?>