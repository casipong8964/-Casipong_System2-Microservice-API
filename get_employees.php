<?php
/**
 * get_employees.php
 * Example: returns employee data — the actual DB query used by api.php.
 */

function getAllEmployees(PDO $pdo): array
{
    $stmt = $pdo->query('SELECT id, name, position, department, email FROM employees ORDER BY name');
    return $stmt->fetchAll();
}
