//fonction pour afficher le formulaire de modification d'un utilisateur dans le backoffice
function changeStatus(idParams,idUser){
    const req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState === 4) {
            const result = req.responseText;

            //reload the window
            //window.location.reload();
            searchMembres();
        }
    };

    req.open("GET", "ajax.php?idUser="+idUser+"&idParams="+idParams);
    req.send();
}

// fonction pour afficher les utilisateurs en ajax dans le backoffice
function searchMembres(){
    let searchMembers = document.getElementById("searchMembers").value;
    if (searchMembers != null) {
        req = new XMLHttpRequest();
        req.onreadystatechange = function(){
            if(req.readyState === 4){
                const res = req.responseText;
                const count = document.getElementById("selectMembers");
                count.innerHTML = res;
            }
        };
        req.open("GET","Ajax.php?searchMembers="+searchMembers, true);
        req.send();
    }
}




