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
