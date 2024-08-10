$(function () {
    $("#stripeForm").hide();
    $("#paypalForm").hide();
    $("#stripeCloseBtn").hide();
    $("#paypalCloseBtn").hide();
    $(".paypalBtn").click(function () {
        $(".paypalBtn").hide();
        $(".stripeBtn").hide();
        $("#paypalForm").show();
        $("#stripeForm").hide();
        $("#stripeCloseBtn").hide();
        $("#paypalCloseBtn").show();
    });

    $(".stripeBtn").click(function () {
        $(".paypalBtn").hide();
        $(".stripeBtn").hide();
        $("#paypalForm").hide();
        $("#stripeForm").show();
        $("#stripeCloseBtn").show();
        $("#paypalCloseBtn").hide();
    });

    $(".resetStripeBtn").click(function () {
        $("#stripeForm")[0].reset();
    });

    $("#paypalCloseBtn").click(function () {
        $("#paypalCloseBtn").hide();
        $("#stripeCloseBtn").hide();
        $(".paypalBtn").show();
        $(".stripeBtn").show();
        $("#paypalForm")[0].reset();
        $("#paypalForm").hide();
    });

    $("#stripeCloseBtn").click(function () {
        $("#paypalCloseBtn").hide();
        $("#stripeCloseBtn").hide();
        $(".paypalBtn").show();
        $(".stripeBtn").show();
        $("#stripeForm")[0].reset();
        $("#stripeForm").hide();
    });

    var $form = $(".require-validation");

    $("form.require-validation").bind("submit", function (e) {
        var $form = $(".require-validation"),
            inputSelector = ["input[type=text]", "input[type=file]"].join(", "),
            $inputs = $form.find(".required").find(inputSelector),
            $errorMessage = $form.find("div.error"),
            valid = true;
        $errorMessage.addClass("hide");

        $(".has-error").removeClass("has-error");
        $inputs.each(function (i, el) {
            var $input = $(el);
            if ($input.val() === "") {
                $input.parent().addClass("has-error");
                $errorMessage.removeClass("hide");
                e.preventDefault();
            }
        });

        if (!$form.data("cc-on-file")) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data("stripe-publishable-key"));
            Stripe.createToken(
                {
                    number: $(".card-number").val(),
                    cvc: $(".card-cvc").val(),
                    exp_month: $(".card-expiry-month").val(),
                    exp_year: $(".card-expiry-year").val(),
                },
                stripeResponseHandler
            );
        }
    });

    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $(".error")
                .removeClass("hide")
                .find(".alert")
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response["id"];

            $form.find("input[type=text]").empty();
            $form.append(
                "<input type='hidden' name='stripeToken' value='" +
                    token +
                    "'/>"
            );
            $form.get(0).submit();
        }
    }
});
