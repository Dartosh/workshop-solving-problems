<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../config.php';

$section_id = $_GET["section_id"];

$stmt = $db->prepare("DELETE FROM sections WHERE id = ?");

$stmt->bind_param("i", $section_id);
$stmt->execute();

?>