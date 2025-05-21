<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Задания на PHP</title>
</head>
<body>

<h2>1. Числа от 0 до 10 (do...while)</h2>
<?php
function printNumbers() {
    $i = 0;
    do {
        if ($i === 0) {
            echo "$i – это ноль.<br>";
        } elseif ($i % 2 === 0) {
            echo "$i – чётное число.<br>";
        } else {
            echo "$i – нечётное число.<br>";
        }
        $i++;
    } while ($i <= 10);
}
printNumbers();
?>

<hr>

<h2>2. Области и города</h2>
<?php
$regions = [
    "Московская область" => ["Москва", "Зеленоград", "Клин"],
    "Ленинградская область" => ["Санкт-Петербург", "Всеволожск", "Павловск", "Кронштадт"],
    "Рязанская область" => ["Рязань", "Касимов", "Скопин", "Шацк"]
];

foreach ($regions as $region => $cities) {
    echo "<strong>$region:</strong><br>";
    echo implode(', ', $cities) . ".<br><br>";
}
?>

<hr>

<h2>3. Транслитерация</h2>
<?php
$translit = [
    'а' => 'a',  'б' => 'b',  'в' => 'v',  'г' => 'g',  'д' => 'd',
    'е' => 'e',  'ё' => 'yo', 'ж' => 'zh', 'з' => 'z',  'и' => 'i',
    'й' => 'y',  'к' => 'k',  'л' => 'l',  'м' => 'm',  'н' => 'n',
    'о' => 'o',  'п' => 'p',  'р' => 'r',  'с' => 's',  'т' => 't',
    'у' => 'u',  'ф' => 'f',  'х' => 'kh', 'ц' => 'ts', 'ч' => 'ch',
    'ш' => 'sh', 'щ' => 'shch', 'ъ' => '', 'ы' => 'y',  'ь' => '',
    'э' => 'e',  'ю' => 'yu', 'я' => 'ya'
];

function transliterate($string, $translit) {
    $string = mb_strtolower($string);
    $result = '';
    $len = mb_strlen($string);
    for ($i = 0; $i < $len; $i++) {
        $char = mb_substr($string, $i, 1);
        $result .= $translit[$char] ?? $char;
    }
    return $result;
}

$original = "Привет, мир!";
echo "Оригинал: $original<br>";
echo "Транслит: " . transliterate($original, $translit);
?>

<hr>

<h2>4. Динамическое меню</h2>
<?php
$menu = [
    "Главная",
    "О нас" => [
        "История",
        "Команда",
        "Вакансии"
    ],
    "Услуги",
    "Контакты"
];

function renderMenu($items) {
    echo "<ul>";
    foreach ($items as $key => $item) {
        if (is_array($item)) {
            echo "<li>$key";
            renderMenu($item);
            echo "</li>";
        } else {
            echo "<li>$item</li>";
        }
    }
    echo "</ul>";
}

renderMenu($menu);
?>

<hr>

<h2>5. Города на букву “К”</h2>
<?php
foreach ($regions as $region => $cities) {
    $filtered = array_filter($cities, fn($city) => mb_substr($city, 0, 1) === "К");
    if (!empty($filtered)) {
        echo "<strong>$region:</strong><br>";
        echo implode(', ', $filtered) . ".<br><br>";
    }
}
?>

</body>
</html>
