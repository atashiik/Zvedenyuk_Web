<?php
$db = pg_connect("host=localhost dbname=web21 user=postgres password=123456");
if (!$db) {
    die("Ошибка подключения к PostgreSQL");
}
?>