const cards        = Array.from(document.querySelectorAll('.project-card'));
const searchInput  = document.querySelector('#project-search');
const statusFilter = document.querySelector('#status-filter');
const countLabel   = document.querySelector('#project-count');

function filterProjects() {
  const term = searchInput.value.trim().toLowerCase();
  let visible = 0;

  cards.forEach(card => {
    const matchesText   = card.textContent.toLowerCase().includes(term);
    const matchesStatus = !statusFilter.value || card.dataset.status === statusFilter.value;
    card.hidden = !(matchesText && matchesStatus);
    if (!card.hidden) visible++;
  });

  countLabel.textContent = visible;
}

searchInput.addEventListener('input', filterProjects);
statusFilter.addEventListener('change', filterProjects);
filterProjects();
