const STORAGE_KEY = 'spms.projects.v3';

const seed = [
  { id: 1, title: 'Student attendance dashboard', status: 'In progress',
    description: 'Track attendance and identify support needs.' },
  { id: 2, title: 'Small business sales insights', status: 'Proposed',
    description: 'Turn monthly sales records into useful charts.' }
];

let projects = JSON.parse(localStorage.getItem(STORAGE_KEY) || 'null') ?? seed;

export const allProjects = () => projects;
export const getProject  = id => projects.find(p => p.id === Number(id));

export function addProject(data) {
  const project = { id: Date.now(), ...data };
  projects.push(project);
  save();
  return project;
}

export function updateProject(id, changes) {
  const project = getProject(id);
  if (project) Object.assign(project, changes);
  save();
}

export function removeProject(id) {
  projects = projects.filter(p => p.id !== Number(id));
  save();
}

function save() {
  localStorage.setItem(STORAGE_KEY, JSON.stringify(projects));
}
