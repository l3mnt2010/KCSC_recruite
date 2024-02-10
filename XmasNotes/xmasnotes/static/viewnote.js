let currentNote = new URL(location.href).searchParams.get('uuid') ?? '1';
const note = document.getElementById('note');
const noteText = document.getElementById('note-content');
const errorMessage = document.getElementById('error-message');
const nextLink = document.getElementById('next');
const previousLink = document.getElementById('previous');
const submitNote = document.getElementById('submit_note');
const report = document.getElementById('report');
const vistingMessage =document.getElementById('visting');

const typeMessage = (message) => {
  vistingMessage.innerText = '';
  vistingMessage.style.display = '';

  message.split('').forEach((char, index) => {
      setTimeout(() => {
          vistingMessage.innerHTML += char;
      }, index * 100);
  });
};

const loadNote = () => {
  fetch(`/note/${currentNote}`)
    .then(response => response.json())
    .then(data => {

      if (data.error) {
        note.style.display = 'none';
        errorMessage.style.display = '';
        errorMessage.textContent = data.error;
        return;
      }

      note.style.display = '';
      errorMessage.style.display = 'none';
      noteText.innerHTML = data.message;
    });
};

loadNote();

const reportToBot = () => {
  typeMessage('Bot is visiting...');
  fetch(`/visit/${currentNote}`)
    .then(response => response.json())
    .then(data => {
      if (data.error) {
        alert(data.error)
        return;
      }
      alert(data.message)
      location.reload();
    });
};
