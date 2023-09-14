/* bouton CSS */
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
/*FIN bouton CSS */


/* Check mot de passe */
var passwordInput = document.getElementById("password");
var confirmPasswordInput = document.getElementById("confirmPassword");
var passwordError = document.getElementById("passwordError");

confirmPasswordInput.addEventListener("input", function() {
    if (passwordInput.value !== confirmPasswordInput.value) {
        passwordError.textContent = "Les mots de passes ne sont pas identiques.";
    } else {
        passwordError.textContent = "";
    }
});
/* FIN Check mot de passe */

/* Check email if exist */
const emailInput = document.getElementById('email');
const emailError = document.getElementById('email-error');
const buttonBe = document.getElementById('buttonBe');

emailInput.addEventListener('blur', async () => {
    const email = emailInput.value;
    const response = await fetch(`/check-email?email=${email}`);
    const data = await response.json();

    if (data.exists) {
        emailError.textContent = "existemail";
        buttonBe.disabled = true;
    } else {
        emailError.textContent = '';
        buttonBe.disabled = false;
    }
});
/* FIN Check email if exist */