let form = document.querySelector('#contact-form');

form.addEventListener('submit', function (event) {
    event.preventDefault();
    let formData = new FormData(form);
    let name = formData.get('name');
    let email = formData.get('email');
    let subject = formData.get('subject');
    let message = formData.get('message');

    fetch('http://127.0.0.1:8000/send/mail', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            name: name,
            email: email,
            subject: subject,
            message: message
        })
    })
        .then(response => response.json())
        .then(data => console.log('Ответ сервера:', data))
        .catch(error => console.error('Ошибка:', error));

    event.target.reset();
})