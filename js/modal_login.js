//Bootstrap Modal Login Form
$(document).ready(function(){
    $("#login").click(function(){
        $("#loginModal").modal();
    });
});
//End

// Bootstrap Modal Register Form
$("#register").click(function(){
    $("#loginModal").modal("hide");
    $(".registerModal").modal();
});
//End

//Login Successful Alert Message
function success() {
    alert("Login successful fool !");
}