<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Student;
use App\Models\Supervisor;
use App\Services\ProjectValidator;
use App\Support\Csrf;
use App\Support\Flash;
use App\Support\View;

final class ProjectController {
    public function index(): void {
        $q      = trim((string)($_GET['q'] ?? ''));
        $status = trim((string)($_GET['status'] ?? ''));
        View::render('projects/index', [
            'title'    => 'Projects',
            'projects' => Project::all($q, $status),
            'q'        => $q,
            'status'   => $status,
            'success'  => Flash::get('success'),
        ]);
    }

    public function show(): void {
        $p = Project::find((int)($_GET['id'] ?? 0));
        if (!$p) { http_response_code(404); exit('Not found'); }
        View::render('projects/show', ['title' => $p['title'], 'project' => $p]);
    }

    public function form(): void {
        $id = (int)($_GET['id'] ?? 0);
        $p  = $id ? Project::find($id) : null;
        if ($id && !$p) { http_response_code(404); exit('Not found'); }

        View::render('projects/form', [
            'title'       => $p ? 'Edit project' : 'New project',
            'project'     => $p,
            'students'    => Student::all(),
            'supervisors' => Supervisor::all(),
            'categories'  => Category::all(),
            'errors'      => Flash::get('errors', []),
            'old'         => fn(string $k, string $d = '') => Flash::old($k, $d),
        ]);
        Flash::clearOld();
    }

    public function save(): void {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') { header('Location: ' . \App\Support\Url::to('/projects.php'), true, 303); exit; }
        Csrf::require();

        $id = (int)($_POST['id'] ?? 0);
        [$data, $errors] = ProjectValidator::validate($_POST);

        if ($errors) {
            Flash::set('errors', array_values($errors));
            Flash::keepOld($_POST);
            header('Location: ' . \App\Support\Url::to($id ? "/project-form.php?id={$id}" : '/project-form.php'), true, 303);
            exit;
        }

        if ($id) { Project::update($id, $data); Flash::set('success', 'Project updated.'); }
        else     { Project::create($data);      Flash::set('success', 'Project created.'); }

        header('Location: ' . \App\Support\Url::to('/projects.php'), true, 303);
        exit;
    }

    public function delete(): void {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') { header('Location: ' . \App\Support\Url::to('/projects.php'), true, 303); exit; }
        Csrf::require();

        Project::delete((int)($_POST['id'] ?? 0));
        Flash::set('success', 'Project deleted.');
        header('Location: ' . \App\Support\Url::to('/projects.php'), true, 303);
        exit;
    }
}
