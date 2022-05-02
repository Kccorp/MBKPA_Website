function changeStatus(id,idUser){

    const req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState ===4) {
            const result = req.responseText;

            if (type==1) {
                searchMembres();
            }
        }
    };

    req.open("GET", "Ajax.php?idTable="+idUser+"&type="+type+"&id="+id);
    req.send();

}