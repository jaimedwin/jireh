function show(id) {
    $('.topic').addClass('d-none');
    $('#' + id).removeClass('d-none');
}

$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
