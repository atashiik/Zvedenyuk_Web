<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['image'];

    // Проверка ошибок
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("Ошибка загрузки.");
    }

    // Проверка типа
    $type = mime_content_type($file['tmp_name']);
    if (!in_array($type, ['image/jpeg', 'image/png'])) {
        die("Разрешены только JPEG и PNG.");
    }

    // Проверка размера (2MB)
    if ($file['size'] > 2 * 1024 * 1024) {
        die("Размер файла превышает 2 МБ.");
    }

    // Сохранение файла
    $filename = basename($file['name']);
    $targetPath = "images/" . $filename;

    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        die("Не удалось сохранить файл.");
    }

    // Редирект обратно
    header("Location: index.php");
    exit;
}
?>
