<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Support\Flash;
use App\Support\View;

final class RegistrationController {
    public function form(): void {
        View::render('auth/register', [
            'title'   => 'Register',
            'errors'  => Flash::get('errors', []),
            'success' => Flash::get('success'),
            'old'     => fn(string $k, string $d = '') => Flash::old($k, $d),
        ]);
        Flash::clearOld();
    }

    public function process(): void {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') { header('Location: ' . \App\Support\Url::to('/register.php'), true, 303); exit; }

        $name  = trim((string)($_POST['name']  ?? ''));
        $email = trim((string)($_POST['email'] ?? ''));
        $errors = [];

        if (mb_strlen($name) < 3)                       $errors[] = 'Enter your name (at least 3 characters).';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Enter a valid email address.';

        if ($errors) {
            Flash::set('errors', $errors);
            Flash::keepOld(['name' => $name, 'email' => $email]);
        } else {
            Flash::set('success', 'Registration accepted for ' . $name . '.');
        }

        header('Location: ' . \App\Support\Url::to('/register.php'), true, 303);
        exit;
    }
}
