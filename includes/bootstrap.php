<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params([
        'httponly' => true,
        'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'samesite' => 'Lax',
    ]);
    session_start();
}

function db(): PDO
{
    static $connection = null;
    if ($connection instanceof PDO) {
        return $connection;
    }

    $host = getenv('DB_HOST') ?: '127.0.0.1';
    $port = getenv('DB_PORT') ?: '3306';
    $name = getenv('DB_NAME') ?: 'arcane_spark';
    $user = getenv('DB_USER') ?: 'root';
    $password = getenv('DB_PASS') ?: '';
    $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', $host, $port, $name);

    $connection = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    return $connection;
}

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function csrf_token(): string
{
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_is_valid(mixed $token): bool
{
    return is_string($token)
        && isset($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token);
}

function current_city(): ?string
{
    $city = $_SESSION['city_state'] ?? null;
    return in_array($city, ['piltover', 'zaun'], true) ? $city : null;
}

function enter_account(array $user): void
{
    session_regenerate_id(true);
    $_SESSION['entry_allowed'] = true;
    $_SESSION['user_id'] = (int) $user['id'];
    $_SESSION['display_name'] = (string) $user['display_name'];
    if (in_array($user['city_state'] ?? null, ['piltover', 'zaun'], true)) {
        $_SESSION['city_state'] = $user['city_state'];
    } else {
        unset($_SESSION['city_state']);
    }
}

function persist_city(string $city): void
{
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['city_state'] = $city;
        return;
    }

    $statement = db()->prepare('UPDATE users SET city_state = :city WHERE id = :id');
    $statement->execute([
        'city' => $city,
        'id' => (int) $_SESSION['user_id'],
    ]);
    if ($statement->rowCount() === 0) {
        $check = db()->prepare('SELECT id FROM users WHERE id = :id');
        $check->execute(['id' => (int) $_SESSION['user_id']]);
        if (!$check->fetch()) {
            http_response_code(401);
            exit('Your account session has expired. Please log in again.');
        }
    }
    $_SESSION['city_state'] = $city;
}

function require_entry(): void
{
    if (empty($_SESSION['entry_allowed'])) {
        header('Location: login.php');
        exit;
    }
}

function require_city(): void
{
    require_entry();
    if (current_city() === null) {
        header('Location: city.php');
        exit;
    }
}
