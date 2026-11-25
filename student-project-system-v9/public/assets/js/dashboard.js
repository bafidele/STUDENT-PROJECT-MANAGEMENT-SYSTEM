(async () => {
  try {
    const stats = await window.SPMS.api('/api/dashboard');
    document.querySelectorAll('[data-stat]').forEach(el => {
      el.textContent = stats[el.dataset.stat] ?? 0;
    });
  } catch { /* keep the server-rendered numbers */ }
})();
