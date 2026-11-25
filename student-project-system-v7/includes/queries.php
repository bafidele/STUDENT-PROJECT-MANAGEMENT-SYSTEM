<?php
declare(strict_types=1);

function project_rows(PDO $pdo, string $search = '', string $status = ''): array {
    $sql = 'SELECT p.*, s.full_name AS student_name, sv.full_name AS supervisor_name, c.name AS category_name
            FROM projects p
            JOIN students s     ON s.id  = p.student_id
            JOIN supervisors sv ON sv.id = p.supervisor_id
            JOIN categories c   ON c.id  = p.category_id
            WHERE 1=1';
    $params = [];

    if ($search !== '') {
        // With native prepares a named placeholder may be used only once, so each use gets its own name.
        $sql .= ' AND (p.title LIKE :search_title OR s.full_name LIKE :search_student)';
        $params['search_title']   = "%{$search}%";
        $params['search_student'] = "%{$search}%";
    }
    if ($status !== '') {
        $sql .= ' AND p.status = :status';
        $params['status'] = $status;
    }

    $sql .= ' ORDER BY p.updated_at DESC, p.id DESC';

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function project_stats(PDO $pdo): array {
    return $pdo->query("
        SELECT COUNT(*)                          AS total,
               COALESCE(SUM(status = 'Completed'),   0) AS completed,
               COALESCE(SUM(status = 'In progress'), 0) AS in_progress,
               COALESCE(SUM(status = 'Proposed'),    0) AS proposed
        FROM projects
    ")->fetch();
}

function find_project(PDO $pdo, int $id): ?array {
    $stmt = $pdo->prepare('SELECT * FROM projects WHERE id = :id');
    $stmt->execute(['id' => $id]);
    return $stmt->fetch() ?: null;
}
function create_project(PDO $pdo, array $d): int {
    $stmt = $pdo->prepare('INSERT INTO projects (title, description, status, student_id, supervisor_id, category_id)
                           VALUES (:title, :description, :status, :student_id, :supervisor_id, :category_id)');
    $stmt->execute($d);
    return (int)$pdo->lastInsertId();
}
function update_project(PDO $pdo, int $id, array $d): void {
    $stmt = $pdo->prepare('UPDATE projects
                           SET title = :title, description = :description, status = :status,
                               student_id = :student_id, supervisor_id = :supervisor_id, category_id = :category_id
                           WHERE id = :id');
    $stmt->execute($d + ['id' => $id]);
}
function delete_project(PDO $pdo, int $id): void {
    $stmt = $pdo->prepare('DELETE FROM projects WHERE id = :id');
    $stmt->execute(['id' => $id]);
}
function all_students(PDO $pdo): array    { return $pdo->query('SELECT id, full_name FROM students ORDER BY full_name')->fetchAll(); }
function all_supervisors(PDO $pdo): array { return $pdo->query('SELECT id, full_name FROM supervisors ORDER BY full_name')->fetchAll(); }
function all_categories(PDO $pdo): array  { return $pdo->query('SELECT id, name FROM categories ORDER BY name')->fetchAll(); }
