<?php
// Установка часового пояса для Тюмени
date_default_timezone_set('Asia/Yekaterinburg');

// Блок переменных
$title = "Мой сайт";
$main_heading = "Добро пожаловать!";
$current_year = date("Y");

// Функция для форматирования времени с правильными склонениями
function getCurrentTimeFormatted() {
    $hours = (int)date('G');
    $minutes = (int)date('i');

    $hourWord = getPluralForm($hours, 'час', 'часа', 'часов');
    $minuteWord = getPluralForm($minutes, 'минута', 'минуты', 'минут');

    return "$hours $hourWord $minutes $minuteWord";
}

// Функция для склонения слов
function getPluralForm($n, $form1, $form2, $form5) {
    $n = abs($n) % 100;
    $n1 = $n % 10;
    if ($n > 10 && $n < 20) return $form5;
    if ($n1 > 1 && $n1 < 5) return $form2;
    if ($n1 == 1) return $form1;
    return $form5;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
</head>
<body>
    <h1><?= $main_heading ?></h1>
    <p>Текущий год: <?= $current_year ?></p>
    <p>Текущее время в Тюмени: <?= getCurrentTimeFormatted() ?></p>
</body>
</html>

