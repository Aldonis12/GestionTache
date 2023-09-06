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

    const emailInput = document.getElementById('email');
    const emailError = document.getElementById('email-error');
    const buttonBe = document.getElementById('buttonBe');

    emailInput.addEventListener('blur', async () => {
        const email = emailInput.value;
        const response = await fetch(`/checkEmailForUpdate?email=${email}`);
        const data = await response.json();

        if (data.exists) {
            emailError.textContent = 'Cet email existe déjà !';
            buttonBe.disabled = true;
        } else {
            emailError.textContent = '';
            buttonBe.disabled = false;
        }
    });

    function AfficherMasquer(elementId) {
        var element = document.getElementById(elementId);
        if (element) {
            element.style.display = (element.style.display === 'none') ? 'block' : 'none';
        }
    }

    const mdp = document.getElementById('mdp');
    const goodmdp = document.getElementById('goodmdp');
    const buttonBemdp = document.getElementById('buttonBemdp');
    var newmdpError = document.getElementById("newmdpError");
    const newmdp = document.getElementById('password');
    const confnewmdp = document.getElementById('confirmPassword');

    mdp.addEventListener('blur', async () => {
        const email = mdp.value;
        const response = await fetch(`/checkPasswordForUpdate?password=${email}`);
        const data = await response.json();

        if (data.exists) {
            goodmdp.textContent = 'Succès !';
            buttonBemdp.disabled = false;
            goodmdp.style.color = "rgb(27, 138, 27)";
            newmdp.readOnly = false;
            confnewmdp.readOnly = false;
        } else {
            goodmdp.textContent = 'Le mot de passe est incorrect !';
            goodmdp.style.color = "red";
            buttonBemdp.disabled = true;
            newmdp.readOnly = true;
            confnewmdp.readOnly = true;
        }
    });

    newmdp.addEventListener("input", function() {
    if (mdp.value === newmdp.value) {
        newmdpError.textContent = "Le nouveau mot de passe doit etre different de l'actuel!";
        newmdpError.style.color = "red";
        newmdpError.style.size = "10px";
    } else {
        newmdpError.textContent = "";
    }
});