export function wireModal(modal) {
  const close = () => { modal.hidden = true; };

  modal.querySelectorAll('[data-close]').forEach(btn => btn.addEventListener('click', close));
  modal.addEventListener('click', event => { if (event.target === modal) close(); });
  document.addEventListener('keydown', event => {
    if (event.key === 'Escape' && !modal.hidden) close();
  });

  return {
    open() {
      modal.hidden = false;
      modal.querySelector('input:not([type=hidden]), select, textarea')?.focus();
    },
    close
  };
}
