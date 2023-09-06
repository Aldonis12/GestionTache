function AjoutTache() {
    window.location.href = "/PageAjoutTache";
}

function DeleteAll(){
    window.location.href = "/DeleteAll";
}

function RestoreAll(){
    window.location.href = "/RestoreAll";
}

function AddSubTask(task) {
    window.location.href = "/PageAjoutSousTache/" + task;
}

function navigateToPage(tacheId) {
    window.location.href = "/DetailsTache/" + tacheId;
}