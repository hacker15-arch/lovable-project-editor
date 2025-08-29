<?php
// backend/db.php
require_once 'config.php';

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    // Log error details in production instead of echoing them
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed.']);
    exit;
}
?>
