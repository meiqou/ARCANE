<?php
require __DIR__ . '/includes/bootstrap.php';

if (!empty($_SESSION['entry_allowed'])) {
    header('Location: ' . (current_city() ? 'landing.php' : 'city.php'));
} else {
    header('Location: login.php');
}
exit;
