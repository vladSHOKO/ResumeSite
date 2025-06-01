let registrationForm = document.querySelector('#registration-form');

registrationForm.addEventListener('submit', function(event) {
    event.preventDefault();
    let formData = new FormData(registrationForm);
    let email = formData.get('email');
    let password = formData.get('password');
    fetch('http://127.0.0.1:8000/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            email: email,
            password: password
        })
    })
        .then(response => response.json())
        .then(data => alert('Ответ сервера: ' + data))
        .catch(error => console.log('Ошибка: '+ error));

    event.target.reset();

})