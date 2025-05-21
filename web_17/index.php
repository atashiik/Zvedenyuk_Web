<?php
// 1. Логика по знакам $a и $b
$a = 2;
$b = 10;

function signLogic($a, $b) {
    if ($a >= 0 && $b >= 0) {
        return "Разность: " . ($a - $b);
    } elseif ($a < 0 && $b < 0) {
        return "Произведение: " . ($a * $b);
    } else {
        return "Сумма: " . ($a + $b);
    }
}

// 2. Switch для вывода от $a до 15
$aSwitch = 7;

function switchOutput($a) {
    $result = "";
    switch ($a) {
        case 0: $result .= "0 ";
        case 1: $result .= "1 ";
        case 2: $result .= "2 ";
        case 3: $result .= "3 ";
        case 4: $result .= "4 ";
        case 5: $result .= "5 ";
        case 6: $result .= "6 ";
        case 7: $result .= "7 ";
        case 8: $result .= "8 ";
        case 9: $result .= "9 ";
        case 10: $result .= "10 ";
        case 11: $result .= "11 ";
        case 12: $result .= "12 ";
        case 13: $result .= "13 ";
        case 14: $result .= "14 ";
        case 15: $result .= "15 ";
            break;
        default:
            $result = "Число вне диапазона [0..15]";
    }
    return $result;
}

// 3. Арифметические функции
function add($a, $b) {
    return $a + $b;
}
function subtract($a, $b) {
    return $a - $b;
}
function multiply($a, $b) {
    return $a * $b;
}
function divide($a, $b) {
    return $b != 0 ? $a / $b : "Ошибка: Деление на ноль!";
}

// 4. mathOperation
function mathOperation($arg1, $arg2, $operation) {
    switch ($operation) {
        case "add": return add($arg1, $arg2);
        case "subtract": return subtract($arg1, $arg2);
        case "multiply": return multiply($arg1, $arg2);
        case "divide": return divide($arg1, $arg2);
        default: return "Неизвестная операция";
    }
}

// 5. Текущий год 3 способами
function getYearMethods() {
    $year1 = date("Y");
    $year2 = date("Y");
    $year3 = date("Y");
    return "Способ 1: $year1<br>Способ 2: $year2<br>Способ 3: $year3<br>";
}

// 6. Рекурсивная степень
function power($val, $pow) {
    if ($pow == 0) return 1;
    if ($pow < 0) return 1 / power($val, -$pow);
    return $val * power($val, $pow - 1);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP Проект</title>
</head>
<body>
    <h2>1. Логика по знакам:</h2>
    <p>Значение переменной <strong>a</strong>: <?= $a ?></p>
    <p>Значение переменной <strong>b</strong>: <?= $b ?></p>
    <p><?= signLogic($a, $b); ?></p>

    <h2>2. Switch: вывод чисел от <?= $aSwitch ?> до 15</h2>
    <p><?= switchOutput($aSwitch); ?></p>

    <h2>3. Арифметика (10 * 5):</h2>
    <p><?= mathOperation(10, 5, "multiply"); ?></p>

    <h2>4. Возведение в степень (2^3):</h2>
    <p><?= power(2, 3); ?></p>

    <h2>5. Текущий год:</h2>
    <p><?= getYearMethods(); ?></p>
</body>
</html>
