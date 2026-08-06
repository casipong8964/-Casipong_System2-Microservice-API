<?php
/**
 * db_config.php — Microservice database connection
 * Connects to employee_db on the shared MySQL container.
 */

$db_host = 'mysql';       // service name in docker-compose.yml
$db_name = 'employee_db';
$db_user = 'appuser';
$db_pass = 'apppassword';

try {
    $pdo = new PDO(
        "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4",
        $db_user,
        $db_pass
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    die(json_encode(['error' => 'Database connection failed']));
}
