<?php
include "database.php";

$query = "SELECT id, name, price, image_path FROM products ORDER BY id";
$result = pg_query($db, $query);
$products = pg_fetch_all($result) ?: [];
?>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<h1>Каталог товаров</h1>
<div class="catalog">
<?php foreach ($products as $p): ?>
    <div class="product">
        <a href="product.php?id=<?= (int)$p['id'] ?>">
            <img src="<?= ($p['image_path']) ?>" alt="<?= ($p['name']) ?>">
            <h3><?= ($p['name']) ?></h3>
            <p><?= number_format($p['price'], 2, ',', ' ') ?> ₽</p>
        </a>
    </div>
<?php endforeach; ?>
</div>
