function validate() {
    var username=document.getElementById('username').value;
    var pass=document.getElementById('password').value;
    var cpass=document.getElementById('confirmpassword').value;
    var email=document.getElementById('email').value;

    if(username==""){
        alert("Username required");
    }
    if(pass==""){
        alert("Password required");
    }
    if(cpass==""){
        alert("Confirm password required");
    }
    if(email==""){
        alert("Email required");
    }
    if(username.length<5 && username.length>30){
        alert("Username must contain at least 5 characters and must not contain more than 30 characters.");
    }
    if(pass.length<5 && pass.length>30){
        alert("Password must contain at least 5 characters and must not contain more than 30 characters.");
    }
    if(cpass.length<5 && cpass.length>30){
        alert("Username must contain at least 5 characters and must not contain more than 30 characters.");
    }
    if (pass!=cpass) {
        alert("These two passwords are not identical.");
    }
}