$(document).ready(function () {
    $("#show-sign-up-button").click(function () {
        $("#show-sign-up-form").animate({left: '17%'}, "fast");
        $("#show-sign-up-form").fadeIn("slow");
        $(".hide-login-form").fadeOut("slow");
    });

    $("#show-login-button").click(function () {
        $("#show-login-form").animate({right: '17%'}, "fast");
        $("#show-login-form").fadeIn("slow");
        $("#show-sign-up-form").fadeOut("slow");
    });

    $(".type-email").on("input", function () {
        var value = $(this).val();

        if (value)
            $("#mail-icon").attr("src", "../../images/mail-icon-active.png");
    });

    $(".type-password").on("input", function () {
        var value = $(this).val();

        if (value)
            $("#lock-icon").attr("src", "../../images/lock-icon-active.png");
    });

    $(".sign-up-type-name").on("input", function () {
        var value = $(this).val();

        if (value)
            $("#sign-up-user-icon").attr("src", "../../images/user-icon-active.png");
    });

    $(".sign-up-type-email").on("input", function () {
        var value = $(this).val();

        if (value)
            $("#sign-up-mail-icon").attr("src", "../../images/mail-icon-active.png");
    });

    $(".sign-up-type-password").on("input", function () {
        var value = $(this).val();

        if (value)
            $("#sign-up-lock-icon").attr("src", "../../images/lock-icon-active.png");
    });
});
document.addEventListener("DOMContentLoaded", function () {
    let passwordInput = document.getElementById("sign-up-password");
    let letter = document.getElementById("letter");
    let capital = document.getElementById("capital");
    let number = document.getElementById("number");
    let length = document.getElementById("length");

    passwordInput.onfocus = function () {
        document.getElementById("message").style.display = "block";
    };

    passwordInput.onblur = function () {
        document.getElementById("message").style.display = "none";
    };

    passwordInput.onkeyup = function () {

        let lowerCaseLetters = /[a-z]/g;
        if (passwordInput.value.match(lowerCaseLetters)) {
            letter.classList.remove("invalid");
            letter.classList.add("valid");
        } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
        }

        let upperCaseLetters = /[A-Z]/g;
        if (passwordInput.value.match(upperCaseLetters)) {
            capital.classList.remove("invalid");
            capital.classList.add("valid");
        } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
        }

        let numbers = /[0-9]/g;
        if (passwordInput.value.match(numbers)) {
            number.classList.remove("invalid");
            number.classList.add("valid");
        } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
        }

        if (passwordInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }
    }
});