

x = true;
 function showHidden(){
     if(x){
        document.getElementById('pass').setAttribute("type","text");
         x = false;
     }else{
        document.getElementById('pass').setAttribute("type","password");
         x = true;
     }
}


