<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['employees' => []]);
    exit;
}
require '../includes/db.php';

$q = '%' . trim($_GET['q'] ?? '') . '%';

$stmt = $pdo->prepare("SELECT id, name, contact_no, username FROM employees WHERE name LIKE ? OR contact_no LIKE ? OR username LIKE ? ORDER BY id DESC");
$stmt->execute([$q, $q, $q]);
$employees = $stmt->fetchAll();

echo json_encode(['employees' => $employees]);
?>
