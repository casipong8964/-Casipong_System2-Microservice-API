<?php
/**
 * api.php — Returns employee data as JSON.
 *
 * This is the endpoint the Main System calls (see main_system/fetch_api.php)
 * to populate the "Assigned Staff" dropdown on the CREATE and UPDATE forms.
 *
 *   GET /api.php            -> all employees
 *   GET /api.php?id=3       -> a single employee
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once 'db_config.php';
require_once 'get_employees.php';

$employees = getAllEmployees($pdo);

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $match = array_values(array_filter($employees, fn($e) => (int)$e['id'] === $id));
    echo json_encode($match[0] ?? ['error' => 'Employee not found']);
    exit;
}

echo json_encode($employees);
