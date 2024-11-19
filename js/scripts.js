document.addEventListener("DOMContentLoaded", function() {
    const parametrosURL = new URLSearchParams(window.location.search);
    const nome = parametrosURL.get('name');
    const email = parametrosURL.get('email');

    if (nome && email) {
        document.getElementById('result').innerHTML = `<b>Nome:</b> ${nome} <br> <b>Email:</b> ${email}`;
    }
});