<?php
require_once '../config/database.php';

$id = $_GET['id'];

$sql = "DELETE FROM employees WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute((['id' => $id]));

header("Location: index.php");