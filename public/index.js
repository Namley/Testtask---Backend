$(document).on("click",".editIconLink", function () {
    const articleId = $(this).attr('data-id');
    $("#createButton").hide();
    $("#saveButton").show();
    $(".create-news").hide();
    $(".edit-news").show().css("display", "grid");

    $(".form-parent-parent").load("fetch.php", {
        id: articleId
    })
});

function exitEdit() {
    $(document).ready(function () {
        $("#createButton").show();
        $("#saveButton").hide();
        $(".create-news").show();
        $(".edit-news").hide();

    })
}
