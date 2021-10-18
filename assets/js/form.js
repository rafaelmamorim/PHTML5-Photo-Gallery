/* 
 * 
 * Javascript file for PHTML5 Photo Gallery
 * @version 1.0-102021
 * @author Rafael Amorim <github.com/rafaelmamorim>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * 
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
            beforeSend: function () {
                $("#sendButton").prop('disabled', true);
                $('.actions').before("<center><img src='images/loading32.gif' border='0' width='32'/></center>");
            }
        }).done(function (data) {
            if (!data.success) {
                $("#sendButton").prop('disabled', false);
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

        }).fail(function () {
            $("#sendButton").prop('disabled', false);
        });

        event.preventDefault();
    });
});