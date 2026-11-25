<?php
declare(strict_types=1);

function validate_project(array $in): array {
    $data = [
        'title'         => trim((string)($in['title'] ?? '')),
        'description'   => trim((string)($in['description'] ?? '')),
        'status'        => (string)($in['status'] ?? 'Proposed'),
        'student_id'    => (int)($in['student_id'] ?? 0),
        'supervisor_id' => (int)($in['supervisor_id'] ?? 0),
        'category_id'   => (int)($in['category_id'] ?? 0),
    ];
    $errors = [];

    if (mb_strlen($data['title']) < 3)        $errors['title'] = 'Title must be at least 3 characters.';
    if (mb_strlen($data['description']) < 20) $errors['description'] = 'Description must be at least 20 characters.';
    if (!in_array($data['status'], ['Proposed', 'In progress', 'Completed', 'Archived'], true))
        $errors['status'] = 'Choose a valid status.';
    if ($data['student_id']    <= 0) $errors['student_id']    = 'Choose a student.';
    if ($data['supervisor_id'] <= 0) $errors['supervisor_id'] = 'Choose a supervisor.';
    if ($data['category_id']   <= 0) $errors['category_id']   = 'Choose a category.';

    return [$data, $errors];
}
