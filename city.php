<?php
require __DIR__ . '/includes/bootstrap.php';
require_entry();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $city = $_POST['city'] ?? '';
    $isFetch = ($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'fetch';
    $respond = static function (int $status, array $data) use ($isFetch): void {
        http_response_code($status);
        if ($isFetch) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
        } else {
            echo h((string) ($data['message'] ?? 'Request failed.'));
        }
        exit;
    };

    $csrfToken = $isFetch
        ? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? null)
        : ($_POST['csrf_token'] ?? null);
    if (!csrf_is_valid($csrfToken)) {
        $respond(403, ['message' => 'Your session expired. Reload the page and try again.']);
    }
    if (!in_array($city, ['piltover', 'zaun'], true)) {
        $respond(400, ['message' => 'Choose a valid city-state.']);
    }

    try {
        persist_city($city);
    } catch (PDOException $exception) {
        error_log('Unable to save the selected city-state: ' . $exception->getMessage());
        $respond(503, ['message' => 'The database could not save your city-state. Try again.']);
    }

    if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'fetch') {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['city' => $city]);
        exit;
    }
    header('Location: landing.php');
    exit;
}

$currentCity = current_city();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="<?= h(csrf_token()) ?>">
  <title>Choose your city | Hextech Spark</title>
  <link rel="stylesheet" href="site.css">
  <link rel="stylesheet" href="pages.css">
  <link rel="stylesheet" href="ambient.css">
</head>
<body<?= $currentCity ? ' data-city="' . h($currentCity) . '"' : '' ?>>
<?php require __DIR__ . '/includes/header.php'; ?>
<main class="page-main">
  <div class="page-heading">
    <p class="eyebrow">Step 2 of 3 · Allegiance</p>
    <h1 class="h1">Choose your <span class="hl"><i>city-state</i></span></h1>
    <p>Pick a side to shape the colors and atmosphere of the experience. You can change your choice later.</p>
  </div>
  <div class="city-options">
    <form method="post">
      <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
      <input type="hidden" name="city" value="piltover">
      <button class="city-option piltover" type="submit">
        <strong>Piltover</strong>
        <span>Order, invention, and ambition. Gold and blue, with a polished hextech glow.</span>
      </button>
    </form>
    <form method="post">
      <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
      <input type="hidden" name="city" value="zaun">
      <button class="city-option zaun" type="submit">
        <strong>Zaun</strong>
        <span>Resilience, rebellion, and shimmer. Neon green, deep violet, and industrial edge.</span>
      </button>
    </form>
  </div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
