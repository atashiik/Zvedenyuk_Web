<?php
date_default_timezone_set("Europe/Moscow");

// ---------- [4–5] ЛОГИРОВАНИЕ ----------
$logFile = __DIR__ . "/logs/log.txt";
$logEntry = "[" . date("Y-m-d H:i:s") . "] Запрос к галерее\n";
file_put_contents($logFile, $logEntry, FILE_APPEND);

// Проверка на превышение 10 записей
$lines = file($logFile);
if (count($lines) >= 10) {
    $i = 0;
    while (file_exists("logs/log{$i}.txt")) {
        $i++;
    }
    rename($logFile, "logs/log{$i}.txt");
    file_put_contents($logFile, ""); // сброс
}

// ---------- ФУНКЦИЯ ПОСТРОЕНИЯ ГАЛЕРЕИ ----------
function buildGallery($dir) {
    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
        $fullPath = "$dir/$file";
        $thumbPath = "thumbs/$file";

        if (!is_file($fullPath)) continue;

        // если миниатюры нет — создаем
        if (!file_exists($thumbPath)) {
            createThumbnail($fullPath, $thumbPath, 200);
        }

        echo "<a href='$fullPath' target='_blank'><img src='$thumbPath' width='200' style='margin:5px'></a>";
    }
}

// ---------- СОЗДАНИЕ МИНИАТЮРЫ ----------
function createThumbnail($src, $dest, $width) {
    $info = getimagesize($src);
    [$w, $h] = $info;

    $ratio = $w / $h;
    $new_w = $width;
    $new_h = $width / $ratio;

    $thumb = imagecreatetruecolor($new_w, $new_h);

    switch ($info['mime']) {
        case 'image/jpeg': $img = imagecreatefromjpeg($src); break;
        case 'image/png':  $img = imagecreatefrompng($src); break;
        case 'image/gif':  $img = imagecreatefromgif($src); break;
        default: return;
    }

    imagecopyresampled($thumb, $img, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
    imagejpeg($thumb, $dest);
}
?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Фотогалерея</title></head>
<body>
<h1>Фотогалерея</h1>

<!-- ЗАГРУЗКА -->
<form action="upload.php" method="post" enctype="multipart/form-data">
    Загрузить изображение (JPEG/PNG, макс. 2MB):<br>
    <input type="file" name="image" required>
    <input type="submit" value="Загрузить">
</form>

<hr>

<!-- ГАЛЕРЕЯ -->
<?php buildGallery("images"); ?>

</body>
</html>
