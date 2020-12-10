function ajax(reqobj,link,callback){
var Req;
try{
    Req = new XMLHttpRequest();
}catch (e){

    alert("ERROR (AJAX)");
    return false;
}
var jsonobj = reqobj;
var jsonreq = JSON.stringify(jsonobj);
Req.open("GET",link+jsonreq,true);
Req.send();
Req.onreadystatechange = function() {
    if(this.readyState == 4 && this.status == 200){
        var resobj = JSON.parse(this.responseText);
        callback(resobj);
    }
    else    
        callback('false');
}
}