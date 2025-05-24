<?php include "menu.php"; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Меню</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="list-items" id="list-items"></div>

    <script>
        const menu = <?= $menu ?>;
    </script>
    <script src="js/index.js"></script>
</body>
</html>
