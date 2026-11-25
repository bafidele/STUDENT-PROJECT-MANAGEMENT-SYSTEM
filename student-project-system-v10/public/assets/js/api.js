window.SPMS = window.SPMS || {};

window.SPMS.csrf = () => document.querySelector('meta[name="csrf-token"]')?.content || '';

window.SPMS.api = async (path, options = {}) => {
  const { headers, ...rest } = options;
  const res = await fetch(window.SPMS.url ? window.SPMS.url(path) : path, {
    ...rest,
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
      'X-CSRF-Token': window.SPMS.csrf(),
      ...headers
    }
  });
  const payload = await res.json().catch(() => ({ ok: false, error: 'Invalid JSON from server' }));

  if (!res.ok || payload.ok === false) {
    throw new Error(payload.error || Object.values(payload.errors || {}).join(' ') || 'Request failed');
  }
  return payload.data;
};
