<?php
declare(strict_types=1);

namespace App\Services;

final class ProjectValidator {
    public static function validate(array $in): array {
        $d = [
            'title'         => trim((string)($in['title'] ?? '')),
            'description'   => trim((string)($in['description'] ?? '')),
            'status'        => (string)($in['status'] ?? 'Proposed'),
            'student_id'    => (int)($in['student_id'] ?? 0),
            'supervisor_id' => (int)($in['supervisor_id'] ?? 0),
            'category_id'   => (int)($in['category_id'] ?? 0),
        ];
        $errors = [];
        if (mb_strlen($d['title']) < 3)        $errors['title'] = 'Title must be at least 3 characters.';
        if (mb_strlen($d['description']) < 20) $errors['description'] = 'Description must be at least 20 characters.';
        if (!in_array($d['status'], ['Proposed', 'In progress', 'Completed', 'Archived'], true))
            $errors['status'] = 'Invalid status.';
        if ($d['student_id']    <= 0) $errors['student_id']    = 'Choose a student.';
        if ($d['supervisor_id'] <= 0) $errors['supervisor_id'] = 'Choose a supervisor.';
        if ($d['category_id']   <= 0) $errors['category_id']   = 'Choose a category.';
        return [$d, $errors];
    }
}
