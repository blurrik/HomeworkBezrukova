<?php
function renderMenu() {
    $current_page = isset($_GET['p']) ? $_GET['p'] : 'viewer';
    $current_sort = isset($_GET['sort']) ? $_GET['sort'] : 'byid';
    
    $menu = '<div class="menu-container">';
    $menu .= '<nav class="main-nav">';
    
    $menu_items = [
        'viewer' => 'Просмотр',
        'add' => 'Добавление записи',
        'edit' => 'Редактирование записи',
        'delete' => 'Удаление записи'
    ];
    
    foreach ($menu_items as $key => $value) {
        $class = ($current_page == $key) ? 'class="select"' : '';
        $menu .= '<a href="?p=' . $key . '" ' . $class . '>' . $value . '</a>';
    }
    
    $menu .= '</nav>';
    
    if ($current_page == 'viewer') {
        $menu .= '<div class="submenu">';
        $sort_items = [
            'byid' => 'По-умолчанию',
            'surname' => 'По фамилии',
            'date' => 'По дате рождения'
        ];
        
        foreach ($sort_items as $key => $value) {
            $class = ($current_sort == $key) ? 'class="select"' : '';
            $menu .= '<a href="?p=viewer&sort=' . $key . '" ' . $class . '>' . $value . '</a>';
        }
        
        $menu .= '</div>';
        $menu .= '</div>';
    }
    
    return $menu;
}

echo renderMenu();
?>