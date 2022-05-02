function changeStatus(idParams,idUser){
        const req = new XMLHttpRequest();
        req.onreadystatechange = function () {
            if (req.readyState === 4) {
                const result = req.responseText;

            //reload the window
                window.location.reload();
            }


        };


    req.open("GET", "ajax.php?idUser="+idUser+"&idParams="+idParams);
    req.send();

}