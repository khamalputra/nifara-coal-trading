<?php
/**
 * CMS Delete Article Action (POST Method + CSRF Protected)
 * PT. Nifara Coal Trading
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';

requireAdminAuth();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header("Location: dashboard.php?msg=method_not_allowed");
    exit;
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$token = $_POST['csrf_token'] ?? '';

if ($id > 0 && verifyCSRFToken($token)) {
    $db = getDB();
    $stmt = $db->prepare("DELETE FROM articles WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: dashboard.php?msg=deleted");
    exit;
} else {
    header("Location: dashboard.php?msg=invalid_token");
    exit;
}
