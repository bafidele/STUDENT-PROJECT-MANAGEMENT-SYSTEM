import { allProjects, getProject, addProject, updateProject, removeProject } from './projects.js';
import { wireModal } from './modal.js';

const grid         = document.querySelector('#project-grid');
const searchInput  = document.querySelector('#project-search');
const statusFilter = document.querySelector('#status-filter');
const countLabel   = document.querySelector('#project-count');
const addButton    = document.querySelector('#add-project-btn');
const form         = document.querySelector('#project-form');
const fields       = form.elements;
const modalTitle   = document.querySelector('#modal-title');
const modal        = wireModal(document.querySelector('#project-modal'));

function render() {
  const term = searchInput.value.trim().toLowerCase();

  const visible = allProjects().filter(p => {
    const okText   = p.title.toLowerCase().includes(term) || p.description.toLowerCase().includes(term);
    const okStatus = !statusFilter.value || p.status === statusFilter.value;
    return okText && okStatus;
  });

  grid.replaceChildren(...visible.map(p => {
    const card = document.createElement('article');
    card.className = 'card project-card';
    card.dataset.id = p.id;
    card.dataset.status = p.status;
    card.innerHTML = `
      <span class="eyebrow"></span>
      <h2></h2>
      <p></p>
      <div class="card-actions">
        <button data-action="edit" class="button-ghost">Edit</button>
        <button data-action="delete" class="button-danger">Delete</button>
      </div>`;
    card.querySelector('.eyebrow').textContent = p.status;
    card.querySelector('h2').textContent = p.title;
    card.querySelector('p').textContent = p.description;
    return card;
  }));

  countLabel.textContent = visible.length;
}

function openForCreate() {
  form.reset();
  fields.id.value = '';
  modalTitle.textContent = 'New project';
  modal.open();
}

function openForEdit(id) {
  const p = getProject(id);
  if (!p) return;
  fields.id.value = p.id;
  fields.title.value = p.title;
  fields.status.value = p.status;
  fields.description.value = p.description;
  modalTitle.textContent = 'Edit project';
  modal.open();
}

searchInput.addEventListener('input', render);
statusFilter.addEventListener('change', render);
addButton.addEventListener('click', openForCreate);

form.addEventListener('submit', event => {
  event.preventDefault();
  if (!form.checkValidity()) { form.reportValidity(); return; }

  const data = {
    title: fields.title.value.trim(),
    status: fields.status.value,
    description: fields.description.value.trim()
  };

  if (fields.id.value) updateProject(fields.id.value, data);
  else                 addProject(data);

  modal.close();
  render();
});

grid.addEventListener('click', event => {
  const btn = event.target.closest('[data-action]');
  if (!btn) return;
  const id = btn.closest('.project-card').dataset.id;
  if (btn.dataset.action === 'edit') openForEdit(id);
  if (btn.dataset.action === 'delete' && confirm('Delete this project?')) {
    removeProject(id);
    render();
  }
});

render();
