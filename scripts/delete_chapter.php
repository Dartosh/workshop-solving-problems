<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../config.php';

$chapter_id = $_GET["chapter_id"];

$stmt = $db->prepare("DELETE FROM chapters WHERE id = ?");

$stmt->bind_param("i", $chapter_id);
$stmt->execute();

?>