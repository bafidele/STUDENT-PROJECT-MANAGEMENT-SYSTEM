const form    = document.querySelector('#registration-form');
const message = document.querySelector('#form-message');

form.addEventListener('submit', event => {
  event.preventDefault();

  if (!form.checkValidity()) {
    form.reportValidity();
    message.textContent = 'Please fix the highlighted fields.';
    message.className = 'error';
    return;
  }

  message.textContent = 'Client-side validation passed. The server will be added on Day 4.';
  message.className = 'success';
  form.reset();
});
