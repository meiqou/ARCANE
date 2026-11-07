<?php
require __DIR__ . '/includes/bootstrap.php';

$mode = ($_GET['mode'] ?? 'login') === 'register' ? 'register' : 'login';
$error = '';
$formEmail = '';
$formName = '';

if (!empty($_SESSION['entry_allowed'])) {
    header('Location: ' . (current_city() ? 'landing.php' : 'city.php'));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $mode = $action === 'register' ? 'register' : 'login';
    $formEmail = strtolower(trim((string) ($_POST['email'] ?? '')));
    $formName = trim((string) ($_POST['display_name'] ?? ''));

    if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
        http_response_code(403);
        $error = 'Your form session expired. Please try again.';
    } elseif ($action === 'guest') {
        session_regenerate_id(true);
        $_SESSION['entry_allowed'] = true;
        unset($_SESSION['user_id'], $_SESSION['display_name'], $_SESSION['city_state']);
        header('Location: city.php');
        exit;
    } elseif (!in_array($action, ['login', 'register'], true)) {
        http_response_code(400);
        $error = 'Invalid account action.';
    } elseif (!filter_var($formEmail, FILTER_VALIDATE_EMAIL) || strlen($formEmail) > 254) {
        $error = 'Enter a valid email address.';
    } else {
        $password = (string) ($_POST['password'] ?? '');
        try {
            $connection = db();
            if ($action === 'register') {
                if (strlen($formName) < 2 || strlen($formName) > 80) {
                    $error = 'Display name must be between 2 and 80 characters.';
                } elseif (strlen($password) < 8 || strlen($password) > 4096) {
                    $error = 'Password must be at least 8 characters long.';
                } elseif ($password !== (string) ($_POST['password_confirm'] ?? '')) {
                    $error = 'The passwords do not match.';
                } else {
                    $statement = $connection->prepare(
                        'INSERT INTO users (display_name, email, password_hash) VALUES (:display_name, :email, :password_hash)'
                    );
                    $statement->execute([
                        'display_name' => $formName,
                        'email' => $formEmail,
                        'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                    ]);
                    $user = [
                        'id' => (int) $connection->lastInsertId(),
                        'display_name' => $formName,
                        'city_state' => null,
                    ];
                    enter_account($user);
                    header('Location: city.php');
                    exit;
                }
            } else {
                $statement = $connection->prepare(
                    'SELECT id, display_name, password_hash, city_state FROM users WHERE email = :email LIMIT 1'
                );
                $statement->execute(['email' => $formEmail]);
                $user = $statement->fetch();
                if (!$user || !password_verify($password, $user['password_hash'])) {
                    $error = 'Email or password is incorrect.';
                } else {
                    enter_account($user);
                    header('Location: ' . (current_city() ? 'landing.php' : 'city.php'));
                    exit;
                }
            }
        } catch (PDOException $exception) {
            if ($action === 'register' && $exception->getCode() === '23000') {
                $error = 'An account with that email already exists. Try logging in.';
            } else {
                error_log('Account database operation failed: ' . $exception->getMessage());
                http_response_code(503);
                $error = 'The account database is unavailable. Check the MySQL setup and try again.';
            }
        }
    }
}

$city = current_city();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in or register | Hextech Spark</title>
  <link rel="stylesheet" href="site.css">
  <link rel="stylesheet" href="pages.css">
  <link rel="stylesheet" href="ambient.css">
</head>
<body<?= $city ? ' data-city="' . h($city) . '"' : '' ?>>
<?php require __DIR__ . '/includes/header.php'; ?>
<main class="page-main">
  <div class="page-heading">
    <p class="eyebrow">Step 1 of 3 · Account</p>
    <h1 class="h1">Welcome to <span class="hl"><i>Arcane</i></span></h1>
    <p>Log in or register to save your city-state and return to your experience.</p>
  </div>
  <div class="entry-grid">
    <section class="entry-card page-panel" aria-labelledby="login-title"<?= $mode === 'register' ? ' hidden' : '' ?>>
      <h2 id="login-title">Log in</h2>
      <p>Access your account and saved city-state.</p>
      <form method="post" class="demo-form">
        <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
        <input type="hidden" name="action" value="login">
        <label>Email address<input name="email" type="email" autocomplete="email" maxlength="254" value="<?= h($mode === 'login' ? $formEmail : '') ?>" required></label>
        <label>Password<input name="password" type="password" autocomplete="current-password" required></label>
        <button class="btn" type="submit">Log in</button>
        <?php if ($mode === 'login' && $error !== ''): ?><p class="page-notice" role="alert"><?= h($error) ?></p><?php endif; ?>
      </form>
      <a class="account-switch" href="login.php?mode=register">New here? Register</a>
    </section>
    <section class="entry-card page-panel" aria-labelledby="register-title"<?= $mode === 'login' ? ' hidden' : '' ?>>
      <h2 id="register-title">Register</h2>
      <p>Create an account to save your city-state. Passwords are stored as secure hashes.</p>
      <form method="post" class="demo-form">
        <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
        <input type="hidden" name="action" value="register">
        <label>Display name<input name="display_name" type="text" autocomplete="nickname" maxlength="80" value="<?= h($mode === 'register' ? $formName : '') ?>" required></label>
        <label>Email address<input name="email" type="email" autocomplete="email" maxlength="254" value="<?= h($mode === 'register' ? $formEmail : '') ?>" required></label>
        <label>Password<input name="password" type="password" autocomplete="new-password" minlength="8" maxlength="4096" required></label>
        <label>Confirm password<input name="password_confirm" type="password" autocomplete="new-password" minlength="8" maxlength="4096" required></label>
        <button class="btn alt" type="submit">Create account</button>
        <?php if ($mode === 'register' && $error !== ''): ?><p class="page-notice" role="alert"><?= h($error) ?></p><?php endif; ?>
      </form>
      <a class="account-switch" href="login.php?mode=login">Already registered? Log in</a>
    </section>
  </div>
  <form method="post" class="dashboard-shortcuts">
    <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
    <input type="hidden" name="action" value="guest">
    <button class="btn" type="submit">Continue as guest <span aria-hidden="true">&#9654;</span></button>
  </form>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
