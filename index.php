<?php
require_once 'db_config.php';
require_once 'get_employees.php';

$employees = getAllEmployees($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Employee Microservice — API</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body { font-family: 'Courier New', monospace; background: #0f1622; color: #d7dce2; max-width: 720px; margin: 60px auto; padding: 0 20px; }
    h1 { color: #e4c877; font-size: 22px; }
    .tag { display:inline-block; background:#1c2942; color:#bf9b30; padding:3px 10px; border-radius:4px; font-size:12px; margin-bottom:18px; }
    code { background: #1c2942; padding: 2px 6px; border-radius: 4px; }
    table { width: 100%; border-collapse: collapse; margin-top: 24px; font-size: 13px; }
    th, td { text-align: left; padding: 8px 10px; border-bottom: 1px solid #26374f; }
    th { color: #bf9b30; }
    a { color: #e4c877; }
  </style>
</head>
<body>
  <span class="tag">SYSTEM 2 — MICROSERVICE — PORT 81</span>
  <h1>Employee Microservice</h1>
  <p>Provides employee data to the Main System (Harbor &amp; Key, port 80) so its
  CREATE / UPDATE booking forms can assign a staff member.</p>

  <p><strong>Endpoints</strong></p>
  <ul>
    <li><code>GET /api.php</code> — all employees, JSON array</li>
    <li><code>GET /api.php?id=1</code> — single employee, JSON object</li>
  </ul>

  <p>Try it: <a href="api.php" target="_blank">/api.php</a></p>

  <table>
    <tr><th>ID</th><th>Name</th><th>Position</th><th>Department</th></tr>
    <?php foreach ($employees as $e): ?>
      <tr>
        <td><?= (int)$e['id'] ?></td>
        <td><?= htmlspecialchars($e['name']) ?></td>
        <td><?= htmlspecialchars($e['position']) ?></td>
        <td><?= htmlspecialchars($e['department']) ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
