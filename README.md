# Casipong_System2 — Microservice (Employee API)

This is **System 2** of the Harbor & Key Final Performance Task — a small microservice that exposes employee data as JSON. It runs on **port 81** and is consumed by System 1's "Assigned staff" dropdown.

> This repo only contains the microservice code. To actually run it, you need the Docker infrastructure — see the **[Casipong_DockerCodebase](https://github.com/casipong8964/Casipong_DockerCodebase)** repo, which wires this code together with Nginx, PHP, MySQL, and the other services.

## 📄 What's in this repo

| File | Purpose |
|---|---|
| `index.php` | Entry point for the microservice |
| `db_config.php` | Database connection settings (connects to `employee_db`) |
| `api.php` | Main API endpoint — returns employee data as JSON |
| `get_employees.php` | Query logic for pulling employee records from `employee_db` |

## 🔗 How this connects to the other repos

```
Casipong_DockerCodebase   → docker-compose.yml, nginx, php, mysql, redis (the infrastructure)
Casipong_System1          → mounted into main_system/  → served on http://localhost
Casipong_System2 (this repo) → mounted into microservice/ → served on http://localhost:81
```

System 1's `fetch_api.php` calls this microservice at `http://nginx:81/api.php` (using the Docker service name, not `localhost`, since containers talk to each other over the internal Docker network).

## 🚀 Running it

This repo isn't meant to run standalone — it needs the Docker environment from `Casipong_DockerCodebase`:

1. Clone the infrastructure repo:
   ```powershell
   git clone https://github.com/casipong8964/Casipong_DockerCodebase.git
   cd Casipong_DockerCodebase
   ```
2. Clone System1's contents into `main_system/`
3. Clone this repo's contents into `microservice/`
4. Start everything:
   ```powershell
   docker-compose up -d --build
   ```
5. Open **http://localhost:81/api.php** — this is System 2 (this repo) responding directly.

## 🗄️ Database

Connects to the `employee_db` database (auto-created by `mysql/init/init.sql` in the DockerCodebase repo on first container start).

| Setting | Value |
|---|---|
| Host | `mysql` (Docker service name) |
| Database | `employee_db` |
| User | `appuser` |
| Password | `apppassword` |

## 📡 API Endpoint

| Endpoint | Method | Returns |
|---|---|---|
| `/api.php` | GET | JSON list of employees (id, name, role, etc.) |

Example response shape:
```json
[
  { "id": 1, "name": "Employee Name", "role": "Front Desk" },
  { "id": 2, "name": "Employee Name", "role": "Housekeeping" }
]
```

This is the exact data System 1 fetches to populate its "Assigned staff" dropdown when creating or updating a booking.

## 🔗 Related Repos

- 🏗️ Docker infrastructure: [Casipong_DockerCodebase](https://github.com/casipong8964/Casipong_DockerCodebase)
- 🏨 Main System (Hotel Booking): [Casipong_System1](https://github.com/casipong8964/Casipong_System1)

---
**Author:** Jave Casipong (casipong8964)
