document.querySelector('form').addEventListener('submit', function (event) {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    if (username === '' || password === '') {
        alert('Mohon untuk mengisi semua form!');
        event.preventDefault();
    }
});