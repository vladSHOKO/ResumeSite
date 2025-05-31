let button = document.querySelector('#login-button');

button.addEventListener('click', function(event) {
    event.preventDefault();
    window.location.href = "authorization";
})