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

function deleteCoupon(idCoupon){
    const req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState === 4) {
            const result = req.responseText;

            //reload the window
            //window.location.reload();
            searchMembres();
        }
    };

    req.open("GET", "ajax.php?idCoupon="+idCoupon);
    req.send();
}

// fonction pour afficher les utilisateurs en ajax dans le backoffice


function searchMembres(ifPartner){
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
        if (ifPartner != 1) {
            req.open("GET","ajax.php?searchMembers="+searchMembers, true);
        }else {
            req.open("GET", "Ajax.php?searchPartners=" + searchMembers, true);
        }
        req.send();
    }
}

