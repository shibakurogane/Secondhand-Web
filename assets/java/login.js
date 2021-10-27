
// an hien password
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

function validate() {
    var u = document.forms["contactForm"]["username"].value;
    // var fname = document.getElementById("fname").value;
    var p = document.forms["contactForm"]["pass"].value;
    // var sname = document.getElementById("sname").value;
    
 
    if (u == null || u == "") {
        alert("Username must be filled out");
        return false;
    } else if (p == null || p == "") {
        alert("Password must be filled out");
        return false;
    } 
}
