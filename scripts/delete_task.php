<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../config.php';

$task_id = $_GET["task_id"];

$stmt = $db->prepare("DELETE FROM tasks WHERE id = ?");

$stmt->bind_param("i", $task_id);
$stmt->execute();

?>