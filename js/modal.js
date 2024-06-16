const modal = document.getElementById('modal-window');
const cancelButton = document.getElementById('modal-window-cancel-button');
const submitButton = document.getElementById('modal-window-submit-button');

function openModalWindow(url) {
    const modal = document.getElementById('modal-window');

    modal.style.display = 'flex';
    modal.style.alignItems = 'center';
    modal.style.justifyContent = 'center';

    submitButton.onclick = function() {
        fetch(url).then(() => {
            console.log('Request seccessfully executed');

            location.reload();
        }).catch(() => {
            console.log('Failed to make request');
        });
    }
}

cancelButton.onclick = function() {
    modal.style.display = 'none';
}
