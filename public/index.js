$(document).on("click",".editIconLink", function () {
    const articleId = $(this).attr('data-id');
    $("#createButton").hide();
    $("#saveButton").show();
    $(".create-news").hide();
    $(".edit-news").show().css("display", "grid");

    $.ajax({
        url: "fetch.php",
        type: "POST",
        data: {
            id: articleId,
        },
        fail: function (error) {
            console.log(error);
        },
        success: function(html){
            console.log('success');
            $('.form-parent-parent').append(html);

        }
    });
});



function exitEdit() {
    $(document).ready(function () {
        $("#createButton").show();
        $("#saveButton").hide();
        $(".create-news").show();
        $(".edit-news").hide();

    })
}
