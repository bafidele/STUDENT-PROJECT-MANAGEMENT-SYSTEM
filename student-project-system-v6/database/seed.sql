INSERT INTO students (full_name, reg_number, email) VALUES
  ('Alice Uwase',    'BIT/2024/001', 'alice@example.com'),
  ('Bob Mugisha',    'BIT/2024/002', 'bob@example.com'),
  ('Claire Ineza',   'BIT/2024/003', 'claire@example.com'),
  ('David Habimana', 'BIT/2024/004', 'david@example.com');

INSERT INTO supervisors (full_name, email) VALUES
  ('Dr. Sarah Namukasa',  'sarah@example.com'),
  ('Prof. James Okello',  'james@example.com'),
  ('Dr. Eric Nkurunziza', 'eric@example.com');

INSERT INTO categories (name) VALUES
  ('Web development'), ('Mobile development'), ('Database systems'), ('Cybersecurity');

INSERT INTO projects (title, description, status, student_id, supervisor_id, category_id) VALUES
  ('Student attendance dashboard',  'Track attendance and identify support needs.',     'In progress', 1, 1, 1),
  ('Small business sales insights', 'Turn monthly sales records into useful charts.',   'Proposed',    2, 2, 3),
  ('Campus navigation app',         'Indoor navigation for new students.',              'Completed',   3, 3, 2),
  ('Phishing detection demo',       'A teaching demo for spotting phishing.',           'Proposed',    4, 1, 4),
  ('Library management system',     'A comprehensive library system.',                  'Completed',   1, 2, 3),
  ('Course registration portal',    'Streamlined course registration.',                 'In progress', 2, 3, 1);
