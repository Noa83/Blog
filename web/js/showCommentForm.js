$(document).ready(function(){
    $("#publish_comment, #cancel_comment").click( function() {
        $("#comment_field").hide();
    });
    $("#add_comment").click(function(){
        $("#comment_field").show();
    });
});