<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Project;
use App\Support\View;

final class DashboardController {
    public function home(): void {
        View::render('dashboard/home', ['title' => 'Home', 'stats' => Project::stats()]);
    }

    public function index(): void {
        View::render('dashboard/index', ['title' => 'Dashboard', 'stats' => Project::stats()]);
    }
}
