function GetArticle(){

        req = new XMLHttpRequest();
        req.onreadystatechange = function(){
            if(req.readyState === 4){
                const res = req.responseText;
                console.log(res);
            }
        };
        req.open("GET","ajax.php?GetArticle", true);
        req.send();
    }

