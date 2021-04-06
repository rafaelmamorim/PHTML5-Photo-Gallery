/* 
 * Source: https://www.digitalocean.com/community/tutorials/submitting-ajax-forms-with-jquery
 */


$(document).ready(function () {
    $("form").submit(function (event) {
        $(".form-group").removeClass("has-error");
        $(".help-block").remove();
        var formData = {
            name: $("#name").val(),
            email: $("#email").val(),
            message: $("#message").val(),
        };

        $.ajax({
            type: "POST",
            url: "sendform.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            console.log(data);
            if (!data.success) {
                if (data.errors.name) {
                    $("#name-group").addClass("has-error");
                    $("#name-group").append(
                            '<div class="help-block">' + data.errors.name + "</div>"
                            );
                }

                if (data.errors.email) {
                    $("#email-group").addClass("has-error");
                    $("#email-group").append(
                            '<div class="help-block">' + data.errors.email + "</div>"
                            );
                }

                if (data.errors.message) {
                    $("#message-group").addClass("has-error");
                    $("#message-group").append(
                            '<div class="help-block">' + data.errors.message + "</div>"
                            );
                }
            } else {
                $("form").html(
                        '<div class="alert alert-success">' + data.message + "</div>"
                        );
            }

        });

        event.preventDefault();
    });
});