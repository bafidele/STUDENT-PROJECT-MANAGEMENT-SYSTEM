<?php
declare(strict_types=1);

namespace App\Models;

use App\Config\Database;

final class Project {
    public static function all(string $search = '', string $status = ''): array {
        $sql = 'SELECT p.*, s.full_name AS student_name, sv.full_name AS supervisor_name, c.name AS category_name
                FROM projects p
                JOIN students s     ON s.id  = p.student_id
                JOIN supervisors sv ON sv.id = p.supervisor_id
                JOIN categories c   ON c.id  = p.category_id
                WHERE 1=1';
        $params = [];
        if ($search !== '') {
            $sql .= ' AND (p.title LIKE :search_title OR s.full_name LIKE :search_student)';
            $params['search_title']   = "%{$search}%";
            $params['search_student'] = "%{$search}%";
        }
        if ($status !== '') {
            $sql .= ' AND p.status = :status';
            $params['status'] = $status;
        }
        $sql .= ' ORDER BY p.updated_at DESC, p.id DESC';

        $stmt = Database::pdo()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array {
        $stmt = Database::pdo()->prepare('SELECT * FROM projects WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public static function create(array $d): int {
        $stmt = Database::pdo()->prepare('INSERT INTO projects (title, description, status, student_id, supervisor_id, category_id)
                                          VALUES (:title, :description, :status, :student_id, :supervisor_id, :category_id)');
        $stmt->execute($d);
        return (int)Database::pdo()->lastInsertId();
    }

    public static function update(int $id, array $d): void {
        $stmt = Database::pdo()->prepare('UPDATE projects SET title = :title, description = :description, status = :status,
                                          student_id = :student_id, supervisor_id = :supervisor_id, category_id = :category_id
                                          WHERE id = :id');
        $stmt->execute($d + ['id' => $id]);
    }

    public static function delete(int $id): void {
        $stmt = Database::pdo()->prepare('DELETE FROM projects WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    public static function stats(): array {
        return array_map('intval', Database::pdo()->query("
            SELECT COUNT(*)                                  AS total,
                   COALESCE(SUM(status = 'Completed'),   0)  AS completed,
                   COALESCE(SUM(status = 'In progress'), 0)  AS in_progress,
                   COALESCE(SUM(status = 'Proposed'),    0)  AS proposed
            FROM projects")->fetch());
    }
}
