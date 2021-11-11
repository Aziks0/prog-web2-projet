const loginForm = document.querySelector('.login__form');
const usernameInput = document.getElementById('username');
const passwordInput = document.getElementById('password');
const usernameErrorElement = document.querySelector(
    '.login__username__container .error'
);
const passwordErrorElement = document.querySelector(
    '.login__password__container .error'
);

let usernameError = false;
let passwordError = false;

loginForm.addEventListener('submit', (event) => {
    event.preventDefault();

    if (usernameInput.value === '') {
        usernameError = true;
        usernameErrorElement.style.display = 'block';
    } else {
        usernameError = false;
        usernameErrorElement.style.display = 'none';
    }

    if (passwordInput.value === '') {
        passwordError = true;
        passwordErrorElement.style.display = 'block';
    } else {
        passwordError = false;
        passwordErrorElement.style.display = 'none';
    }

    if (usernameError || passwordError) return;

    loginForm.submit();
});

// Remove the error message (if there is one) when the user is typing
usernameInput.addEventListener('input', () => {
    if (usernameErrorElement === '') return;
    usernameErrorElement.style.display = 'none';
});

// Remove the error message (if there is one) when the user is typing
passwordInput.addEventListener('input', () => {
    if (passwordErrorElement === '') return;
    passwordErrorElement.style.display = 'none';
});
