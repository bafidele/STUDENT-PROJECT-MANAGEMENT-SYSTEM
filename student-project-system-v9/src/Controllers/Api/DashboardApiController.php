<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use App\Models\Project;
use App\Support\Response;

final class DashboardApiController {
    public function index(): void {
        Response::json(['ok' => true, 'data' => Project::stats()]);
    }
}
