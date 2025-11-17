<?php

if (!empty($_POST["part"])) { //проверяем не пустой ли запрос)

    $part = $_POST["part"]; //($_POST - массив переменных, передаваемых из браузера (от клиента)

    $result = solve($part);

    echo "выражение - ".$part. "\n";
    echo "результат - ".$result;

} else {
    echo "Переменные не дошли";
}

function plus($a, $b) {
    return $a + $b;
}

function minus($a, $b) {
    return $a - $b;
}

function multi($a, $b) {
    return $a * $b;
}

function divide($a, $b) {
    if ($b ==0) {   
        return "Деление на ноль невозможно";
    }
    return $a/$b;
}

function solve($part) {

    preg_match("'/(\d+)([\+\-\*\/])(\d+)/'", $part, $matches);
    if (count($matches) != 4) {
        return "Неверно введенное выражение";
    }

    $a = $matches[1];
    $oper = $matches[2];
    $b = $matches[3];

    switch ($oper) {
        case "+":
            return plus($a, $b);
        case "-":
            return minus($a, $b);
        case "*":   
            return multi($a, $b);
        case "/":
            return divide($a, $b);
        default:
            "Ошибка";
        
    }
}

?>