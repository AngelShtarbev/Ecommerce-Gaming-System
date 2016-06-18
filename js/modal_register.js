<<<<<<< HEAD
//Profile Modal All Orders
$('#ordersModal').on('show.bs.modal', function (event) {

});
//End

//Profile Modal All New Orders
$('#newOrdersModal').on('show.bs.modal', function (event) {

});
//End

//Bootstrap Delete User Modal
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    //$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
});
//End

//Light Box Images Gallery
$(document).ready(function(){
    $("a[rel='colorbox']").colorbox({maxWidth: "90%", maxHeight: "90%", opacity: ".5"});
});
//End

//Bootstrap Log In Tooltip
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
//End
=======
//Profile Modal All Orders
$('#ordersModal').on('show.bs.modal', function (event) {

});
//End

//Profile Modal All New Orders
$('#newOrdersModal').on('show.bs.modal', function (event) {

});
//End

//Bootstrap Delete User Modal
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    //$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
});
//End

//Light Box Images Gallery
$(document).ready(function(){
    $("a[rel='colorbox']").colorbox({maxWidth: "90%", maxHeight: "90%", opacity: ".5"});
});
//End

//Bootstrap Log In Tooltip
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
//End
>>>>>>> origin/master
