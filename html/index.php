<?php
echo "<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='UTF-8'>
    <title>Лабораторная работа №9</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .task { background: #f0f0f0; margin: 15px 0; padding: 15px; border-radius: 8px; }
        .task h3 { margin: 0 0 10px 0; color: #333; }
        .result { background: #fff; padding: 10px; margin-top: 10px; border-left: 3px solid green; }
        hr { margin: 20px 0; }
    </style>
</head>
<body>
    <h1>Лабораторная работа №9</h1>";

//1
echo "<div class='task'>
    <h3>1. array_map() - преобразование в заглавные буквы</h3>
    <div class='result'>";

$arr = ['a', 'b', 'c', 'd', 'e'];
$result = array_map('strtoupper', $arr);
echo "Исходный массив: ['a', 'b', 'c', 'd', 'e']<br>";
echo "Результат: ['" . implode("', '", $result) . "']";

echo "</div></div>";

//2
echo "<div class='task'>
    <h3>2. count() - последний элемент массива</h3>
    <div class='result'>";

$arr = [10, 20, 30, 40, 50];
$last = $arr[count($arr) - 1];
echo "Массив: [10, 20, 30, 40, 50]<br>";
echo "Последний элемент: $last";

echo "</div></div>";

//3
echo "<div class='task'>
    <h3>3. array_search() - проверка наличия элемента 3</h3>
    <div class='result'>";

$arr = [5, 2, 8, 3, 9];
$key = array_search(3, $arr);
if ($key !== false) {
    echo "В массиве есть элемент со значением 3 (индекс: $key)";
} else {
    echo "Элемента 3 нет";
}

echo "</div></div>";

//4
echo "<div class='task'>
    <h3>4. array_merge() - объединение массивов</h3>
    <div class='result'>";

$arr1 = [1, 2, 3];
$arr2 = ['a', 'b', 'c'];
$result = array_merge($arr1, $arr2);
echo "Первый массив: [1, 2, 3]<br>";
echo "Второй массив: ['a', 'b', 'c']<br>";
echo "Результат: [" . implode(", ", $result) . "]";

echo "</div></div>";

//5
echo "<div class='task'>
    <h3>5. array_slice() - срез массива</h3>
    <div class='result'>";

$arr = [1, 2, 3, 4, 5];
$result = array_slice($arr, 1, 3);
echo "Исходный массив: [1, 2, 3, 4, 5]<br>";
echo "Результат: [" . implode(", ", $result) . "]";

echo "</div></div>";

//6
echo "<div class='task'>
    <h3>6. array_keys() и array_values()</h3>
    <div class='result'>";

$arr = ['a' => 1, 'b' => 2, 'c' => 3];
$keys = array_keys($arr);
$values = array_values($arr);
echo "Исходный массив: ['a'=>1, 'b'=>2, 'c'=>3]<br>";
echo "\$keys: ['" . implode("', '", $keys) . "']<br>";
echo "\$values: [" . implode(", ", $values) . "]";

echo "</div></div>";

//7
echo "<div class='task'>
    <h3>7. array_combine() - создание массива</h3>
    <div class='result'>";

$keys = ['a', 'b', 'c'];
$values = [1, 2, 3];
$result = array_combine($keys, $values);
echo "Массив ключей: ['a', 'b', 'c']<br>";
echo "Массив значений: [1, 2, 3]<br>";
echo "Результат: <pre>" . print_r($result, true) . "</pre>";

echo "</div></div>";

//8
echo "<div class='task'>
    <h3>8. array_search() - поиск позиции '-'</h3>
    <div class='result'>";

$arr = ['a', '-', 'b', '-', 'c', '-', 'd'];
$pos = array_search('-', $arr);
echo "Массив: ['a', '-', 'b', '-', 'c', '-', 'd']<br>";
echo "Позиция первого '-': $pos";

echo "</div></div>";

//9
echo "<div class='task'>
    <h3>9. Сортировки массивов</h3>
    <div class='result'>";

$arr = ['3'=>'a', '1'=>'c', '2'=>'e', '4'=>'b'];
echo "Исходный массив: <pre>" . print_r($arr, true) . "</pre>";

$arr_asort = $arr;
asort($arr_asort);
echo "asort() (по значениям): <pre>" . print_r($arr_asort, true) . "</pre>";

$arr_ksort = $arr;
ksort($arr_ksort);
echo "ksort() (по ключам): <pre>" . print_r($arr_ksort, true) . "</pre>";

$arr_arsort = $arr;
arsort($arr_arsort);
echo "arsort() (обратная по значениям): <pre>" . print_r($arr_arsort, true) . "</pre>";

echo "</div></div>";

//10
echo "<div class='task'>
    <h3>10. Сумма цифр из строки</h3>
    <div class='result'>";

$str = '1234567890';
$arr = str_split($str);
$sum = array_sum($arr);
echo "Строка: '1234567890'<br>";
echo "Сумма цифр: $sum";

echo "</div></div>";

//11
echo "<div class='task'>
    <h3>11. array_fill() - заполнение массива</h3>
    <div class='result'>";

$arr = array_fill(0, 10, 'x');
echo "Результат: ['" . implode("', '", $arr) . "']";

echo "</div></div>";

//12
echo "<div class='task'>
    <h3>12. array_intersect() - общие элементы</h3>
    <div class='result'>";

$arr1 = [1, 2, 3, 4, 5];
$arr2 = [3, 4, 5, 6, 7];
$result = array_intersect($arr1, $arr2);
echo "Первый массив: [1, 2, 3, 4, 5]<br>";
echo "Второй массив: [3, 4, 5, 6, 7]<br>";
echo "Общие элементы: [" . implode(", ", $result) . "]";

echo "</div></div>";

echo "</body></html>";
?>