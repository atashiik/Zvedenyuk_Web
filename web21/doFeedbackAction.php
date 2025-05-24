<?php
include "database.php";

function doFeedbackAction($db) {
    $action = $_POST['action'] ?? '';
    $id = (int)($_POST['id'] ?? 0);
    $product_id = (int)($_POST['product_id'] ?? 0);

    switch ($action) {
        case 'create':
            $username = pg_escape_string($db, $_POST['username']);
            $content = pg_escape_string($db, $_POST['content']);
            pg_query($db, "INSERT INTO reviews (product_id, username, content) VALUES ($product_id, '$username', '$content')");
            break;

        case 'delete':
            pg_query($db, "DELETE FROM reviews WHERE id = $id");
            break;

        case 'update':
            $content = pg_escape_string($db, $_POST['content']);
            pg_query($db, "UPDATE reviews SET content = '$content' WHERE id = $id");
            break;
    }

    header("Location: product.php?id=$product_id");
    exit;
}

doFeedbackAction($db);
