<?php
declare(strict_types=1);

require __DIR__ . '/../src/Support/autoload.php';

use App\Support\Url;

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$base = Url::base();
if ($base !== '' && str_starts_with($path, $base)) $path = substr($path, strlen($base)) ?: '/';
if ($path === '/index.php') $path = '/';

// PHP's built-in server sends every request here; let real files (CSS, images) pass through.
if (PHP_SAPI === 'cli-server' && $path !== '/' && !str_ends_with($path, '.php') && is_file(__DIR__ . $path)) {
    return false;
}

session_start();

use App\Controllers\DashboardController;
use App\Controllers\ProjectController;
use App\Controllers\RegistrationController;

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

match ($path) {
    '/'                         => (new DashboardController())->home(),
    '/dashboard.php'            => (new DashboardController())->index(),
    '/projects.php'             => (new ProjectController())->index(),
    '/project-show.php'         => (new ProjectController())->show(),
    '/project-form.php'         => (new ProjectController())->form(),
    '/project-save.php'         => (new ProjectController())->save(),
    '/project-delete.php'       => (new ProjectController())->delete(),
    '/register.php'             => (new RegistrationController())->form(),
    '/process-registration.php' => (new RegistrationController())->process(),
    default                     => (function () { http_response_code(404); echo 'Not found'; })(),
};
