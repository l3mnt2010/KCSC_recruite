const submitNote = document.getElementById('submit_note');
const sendNote = document.getElementById('save-note');
const input = document.getElementById('note-content-input');

const typeMessage = (message) => {
    sendNote.innerText = '';
    sendNote.style.display = '';

    message.split('').forEach((char, index) => {
        setTimeout(() => {
            sendNote.innerHTML += char;
        }, index * 100);
    });
};

submitNote.addEventListener('click', (event) => {

    typeMessage('Saving your note...');

    fetch('/submit', {
            method: 'POST',
            body: JSON.stringify({
                message: input.value,
            }),
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .catch(error => {
            typeMessage(error);
        })
        .then(response => response.json()
            .then(data => {
                if (response.status !== 201) {
                    typeMessage(data.message);
                } else {
                    setTimeout(() => {
                        window.location = '/notes?uuid=' + data.message;
                    }, 2000);
                }
            }));
});