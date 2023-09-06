// Fonction pour afficher ou masquer le formulaire en fonction de son état actuel
function toggleFormulaire() {
    var formDiv = document.getElementById("formDiv");
    formDiv.style.display = (formDiv.style.display === "none") ? "block" : "none";
}

// Attacher un gestionnaire d'événement au bouton
var toggleFormButton = document.getElementById("toggleFormButton");
toggleFormButton.addEventListener("click", toggleFormulaire);

//Changement de couleur choisi sur le <SELECT> couleur:
document.addEventListener('DOMContentLoaded', function () {
    var colorSelect = document.getElementById('colorSelect');
    changeSelectColor(colorSelect);
    });
    
    function changeSelectColor(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var backgroundColor = selectedOption.style.backgroundColor;
    
        selectElement.style.backgroundColor = backgroundColor;
    }