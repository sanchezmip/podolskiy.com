<?php
echo "<h1>Лабораторная работа 12</h1>";

echo "<h2>Часть 1</h2>";

// 1
echo "<h3>1. Открытие несуществующего файла</h3>";
try {
    $file = fopen("no_file.txt", "r");
} catch (Exception $ex) {
    echo "Ошибка: " . $ex->getMessage() . "<br>";
}

// 2
echo "<h3>2. Деление на ноль</h3>";
try {
    $a = 10;
    $b = 0;
    if ($b == 0) {
        throw new Exception("Деление на ноль!");
    }
    $res = $a / $b;
} catch (Exception $ex) {
    echo "Ошибка: " . $ex->getMessage() . "<br>";
    file_put_contents("log.txt", $ex->getMessage());
}

// 3
echo "<h3>3. Несуществующий элемент массива</h3>";
$countries = ['Spain' => 'Madrid', 'Russia' => 'Moscow'];
try {
    echo $countries['Germany'];
} catch (Exception $ex) {
    echo "Ошибка: " . $ex->getMessage() . "<br>";
}

echo "<h2>Часть 2</h2>";

// 1
echo "1. " . mktime(10, 25, 0, 3, 15, 2025) . "<br>";

// 2
$old = mktime(8, 5, 59, 10, 2, 1990);
echo "2. " . (time() - $old) . " секунд<br>";

// 3
echo "3. " . date('Y.m.d H:i:s') . "<br>";

// 4
echo "4. " . date('Y.m.d', mktime(0, 0, 0, 9, 1)) . "<br>";

// 5
$week = ['вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб'];
echo "5. " . $week[date('w', mktime(0, 0, 0, 2, 2, 2000))] . "<br>";

// 6
echo "6. Сегодня: " . $week[date('w')] . "<br>";

// 7
echo "<h3>7. Сравнение дат</h3>";
echo '<form method="post">
    Дата 1: <input type="date" name="d1"><br>
    Дата 2: <input type="date" name="d2"><br>
    <input type="submit" name="comp" value="Сравнить">
</form>';
if(isset($_POST['comp'])){
    if($_POST['d1'] > $_POST['d2']) echo "Больше: " . $_POST['d1'];
    else echo "Больше: " . $_POST['d2'];
}

// 8
echo "<br>8. " . date('d-m-Y', strtotime('2025-12-31')) . "<br>";

// 9
$date = date_create('2000-02-03');
date_modify($date, '+2 days');
echo "9. +2 дня: " . date_format($date, 'd.m.Y') . "<br>";

// 10
$ny = mktime(0,0,0,1,1,date('Y')+1);
echo "10. До НГ: " . ceil(($ny - time())/86400) . " дней";
?>
