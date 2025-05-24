<?php
include "database.php";

$sections = getSections($db);
$menu = json_encode($sections, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

function getSections($db): array
{
    $query = "SELECT * FROM menu_section";
    $result = pg_query($db, $query);

    if (!$result) {
        die("Ошибка запроса: " . pg_last_error($db));
    }

    $allSections = [];
    while ($row = pg_fetch_assoc($result)) {
        $row['children'] = []; 
        $allSections[] = $row;
    }

    $tree = [];
    foreach ($allSections as $section) {
        if ($section['parent_id'] === null) {
            $tree[] = buildChildren($section, $allSections);
        }
    }

    return $tree;
}

function buildChildren(array $parent, array $allSections): array
{
    foreach ($allSections as $section) {
        if ($section['parent_id'] == $parent['id']) {
            $parent['children'][] = buildChildren($section, $allSections);
        }
    }
    return $parent;
}

