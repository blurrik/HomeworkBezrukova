<?php

if (!empty($_POST["part"]))//проверяем не пустой ли запрос
{ 
    $part = $_POST["part"]; //($_POST - массив переменных, передаваемых из браузера (от клиента)

    $result = solve($part);
    // $result = isset($_GET['result']) ? $_GET['result'] :'';
    // if (!empty($_GET["result"])) {
    // echo "выражение - ".$part. "<br>";
    // echo "результат - ".$result;
    // }

    header("Location: calc.html?result=".urlencode($result));
    exit;

} else { //если выражение пустое то выводим ошибку
      header("Location: calc.html?result=ошибка: введите значение!");
}

function plus($a, $b)
{
    return $a + $b;
}

function minus($a, $b)
{
    return $a - $b;
}

function multi($a, $b)
{
    return $a * $b;
}

function divide($a, $b)
{
    if ($b == 0)
    {
        return "Деление на ноль невозможно";
    }
    return $a / $b;
}

function solve($part)
{

   if (preg_match('/(\d+)([\*\/])(\d+)/', $part, $matches)) {
   
    $a = $matches[1];
    $oper = $matches[2];
    $b = $matches[3];

    if ($oper == '*'){
        $result = multi($a, $b);
    }else if ($oper == '/'){
        $result = divide($a, $b);
    }

    $newPart = str_replace($matches[0], $result, $part);

    return solve($newPart);
   }

    if (preg_match('/(\d+)([\+\-])(\d+)/', $part, $matches)) {
   
    $a = $matches[1];
    $oper = $matches[2];
    $b = $matches[3];

    if ($oper == '+'){
        $result = plus($a, $b);
    }else if ($oper == '-'){
        $result = minus($a, $b);
    }

    $newPart = str_replace($matches[0], $result, $part);

    return solve($newPart);
   }

  return $part;

}

?>
