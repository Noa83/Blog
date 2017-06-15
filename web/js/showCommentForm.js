$(document).ready(function(){
    $("#publish_comment, #cancel_comment").click( function() {
        $("#comment_form").hide();
    });

    $("#add_comment").click(function(){
        $("#comment_form").appendTo($('#comment_field'));
        $("#comment_form").show();
    });

    $('.reply_button').click(function () {
        $('#comment_form').appendTo($('#comment_reply_container_' + this.id));
        $('#comment_form').show();
        $('form[name="comment"]')[0].action = $('form[name="comment"]')[0].action + '/' + this.id;
    })
});