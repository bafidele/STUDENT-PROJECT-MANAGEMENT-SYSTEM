<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use App\Models\Project;
use App\Services\ProjectValidator;
use App\Support\Csrf;
use App\Support\Response;

final class ProjectApiController {
    public function index(): void {
        $q      = trim((string)($_GET['q'] ?? ''));
        $status = trim((string)($_GET['status'] ?? ''));
        Response::json(['ok' => true, 'data' => ['projects' => Project::all($q, $status)]]);
    }

    public function create(): void {
        $this->requireSafePost();
        [$data, $errors] = ProjectValidator::validate($this->input());
        if ($errors) Response::json(['ok' => false, 'errors' => $errors], 422);

        Response::json(['ok' => true, 'data' => ['id' => Project::create($data)]], 201);
    }

    public function delete(): void {
        $this->requireSafePost();
        $id = (int)($this->input()['id'] ?? 0);
        if ($id <= 0) Response::json(['ok' => false, 'error' => 'Invalid id'], 422);

        Project::delete($id);
        Response::json(['ok' => true, 'data' => ['id' => $id]]);
    }

    private function requireSafePost(): void {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            Response::json(['ok' => false, 'error' => 'POST only'], 405);
        }
        if (!Csrf::check($_SERVER['HTTP_X_CSRF_TOKEN'] ?? null)) {
            Response::json(['ok' => false, 'error' => 'Invalid CSRF token'], 419);
        }
    }

    private function input(): array {
        $json = json_decode(file_get_contents('php://input') ?: '', true);
        return is_array($json) ? $json : $_POST;
    }
}
