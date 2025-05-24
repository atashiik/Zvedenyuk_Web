<?php
include "database.php";

$id = (int)($_GET['id'] ?? 0);
$product = pg_fetch_assoc(pg_query($db, "SELECT * FROM products WHERE id = $id"));
$reviews = pg_fetch_all(pg_query($db, "SELECT * FROM reviews WHERE product_id = $id ORDER BY created_at DESC")) ?: [];
?>

<head>
    <link rel="stylesheet" href="style.css">
</head>
<p>
    <a href="catalog.php" style="display:inline-block; margin-top: 20px; padding: 8px 16px; background-color: #ccc; color: #000; text-decoration: none; border-radius: 5px;">
        ← Назад в каталог
    </a>
</p>
<?php if ($product): ?>
    <h1><?= ($product['name']) ?></h1>
    <img src="<?= ($product['image_path']) ?>" alt="">
    <p><?= nl2br(($product['description'])) ?></p>
    <p><strong>Цена:</strong> <?= number_format($product['price'], 2, ',', ' ') ?> ₽</p>

    <h2>Отзывы</h2>
    <?php if ($reviews): ?>
        <?php foreach ($reviews as $review): ?>
            <div class="review">
                <b><?= ($review['username']) ?></b>
                <p><?= nl2br(($review['content'])) ?></p>
                <small><?= $review['created_at'] ?></small>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Пока нет отзывов.</p>
    <?php endif; ?>

    <h3>Оставить отзыв</h3>
    <form action="doFeedbackAction.php" method="POST">
        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
        <input type="text" name="username" placeholder="Ваше имя" required>
        <textarea name="content" placeholder="Ваш отзыв" required></textarea>
        <button type="submit" name="action" value="create">Отправить</button>
    </form>
<?php else: ?>
    <p>Товар не найден.</p>
<?php endif; ?>
