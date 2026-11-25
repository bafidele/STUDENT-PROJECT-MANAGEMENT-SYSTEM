const filters      = document.querySelector('#project-filters');
const grid         = document.querySelector('#project-grid');
const searchInput  = document.querySelector('#project-search');
const statusFilter = document.querySelector('#status-filter');
const countLabel   = document.querySelector('#project-count');
const notice       = document.querySelector('#async-status');

const escapeHtml = value => String(value).replace(/[&<>"']/g, c =>
  ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

const cardHtml = p => `
  <article class="card project-card" data-status="${escapeHtml(p.status)}">
    <span class="eyebrow">${escapeHtml(p.status)}</span>
    <h2><a href="${window.SPMS.url(`/project-show.php?id=${p.id}`)}">${escapeHtml(p.title)}</a></h2>
    <p>${escapeHtml(p.description)}</p>
    <p class="meta">
      <strong>Student:</strong> ${escapeHtml(p.student_name)}<br>
      <strong>Supervisor:</strong> ${escapeHtml(p.supervisor_name)}<br>
      <strong>Category:</strong> ${escapeHtml(p.category_name)}
    </p>
    <div class="card-actions">
      <a class="button-ghost" href="${window.SPMS.url(`/project-form.php?id=${p.id}`)}">Edit</a>
      <form method="post" action="${window.SPMS.url('/project-delete.php')}" class="js-delete-form"
            onsubmit="return confirm('Delete this project?');">
        <input type="hidden" name="id" value="${p.id}">
        <button class="button-danger">Delete</button>
      </form>
    </div>
  </article>`;

const updateCount = () => {
  countLabel.textContent = grid.querySelectorAll('.project-card').length;
};

async function load() {
  const query = new URLSearchParams({ q: searchInput.value.trim(), status: statusFilter.value });
  notice.textContent = '';
  try {
    const { projects } = await window.SPMS.api(`/api/projects?${query}`);
    grid.innerHTML = projects.map(cardHtml).join('') || '<p>No projects match.</p>';
    updateCount();
  } catch (error) {
    notice.textContent = error.message;
  }
}

let timer;
searchInput.addEventListener('input', () => { clearTimeout(timer); timer = setTimeout(load, 220); });
statusFilter.addEventListener('change', load);
filters.addEventListener('submit', event => { event.preventDefault(); load(); });

// One listener handles delete forms on both server-rendered and live-rendered cards.
grid.addEventListener('submit', async event => {
  const form = event.target.closest('.js-delete-form');
  if (!form || event.defaultPrevented) return;   // defaultPrevented = the user cancelled the confirm()
  event.preventDefault();

  const button = form.querySelector('button');
  button.disabled = true;
  notice.textContent = '';
  try {
    await window.SPMS.api('/api/projects/delete', {
      method: 'POST',
      body: JSON.stringify({ id: Number(form.elements.id.value) })
    });
    form.closest('.project-card').remove();
    updateCount();
  } catch (error) {
    button.disabled = false;
    notice.textContent = error.message;
  }
});
