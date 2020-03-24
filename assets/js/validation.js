/*
    JavaScript Example of email and password verification - Phase 1 COSC 360 - 33970138

    Pre-jQuery - TODO : Will Rewrite if time allows.

*/


/*
    NOTE: Some of the very basic check for ANY input is handled by bootstrap - To Avoid this being an issue as far as the assignment goes I have
    implemented a more substantial check here to determine that the input is actually in email format and the password contains numeric, symbols, 
    and letters. 

    The professor said we can use bootstrap, but no other frameworks. I believe bootstrap uses jquery so I hope that is alright. I have not used any more and I
    can refrain from using any further bootstrap if it is any issue.
*/

function validatePW(pw) {
    var button = document.getElementById("sign-in-button");
    var box = document.getElementById("pw");
    var header = document.getElementById("main-header");

    var validLength = false;
    var hasSymbol = false;
    var hasNumber = false;

    if (pw.length < 10) {
        alert("Password must be at least 10 characters long.");
        box.style.backgroundColor = "rgb(255,0,0, 0.25)";
        document.getElementById("registration-form").reset();
        button.hidden = true;
        header.style.marginBottom = "7em";
    } else {

        validLength = true;

        var symbolCount = 0;
        var numberCount = 0;
        var symbols = ['!', '@', '#', '$', '%', '&'];
        var numbers = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];

        for (var i = 0; i < pw.length; i++) {

            for (var j = 0; j < symbols.length; j++)
                if (pw.charAt(i) == symbols[j]) {
                    hasSymbol = true;
                }

            for (var j = 0; j < numbers.length; j++)
                if (pw.charAt(i) == numbers[j]) {
                    hasNumber = true;
                }
        }

        if (!hasSymbol || !hasNumber) {
            alert("Password must contain at least one number and symbol. [0-9], [!@#$%&]");
            box.style.backgroundColor = "rgb(255,0,0, 0.25)";
            document.getElementById("registration-form").reset();
            button.hidden = true;
            header.style.marginBottom = "7em";
        }
    }

    if (validLength && hasNumber && hasSymbol) {
        box.style.backgroundColor = "rgb(255,255,255)";
        button.hidden = false;
        header.style.marginBottom = "4em";
    }
}

function validateConfirmPW(pw) {
    var button = document.getElementById("sign-in-button");
    var box = document.getElementById("confirmPw");
    var firstPW = document.getElementById("pw").value;
    var header = document.getElementById("main-header");

    if (firstPW != pw) {
        alert("Passwords don't match!");
        box.style.backgroundColor = "rgb(255,0,0, 0.25)";
        button.hidden = true;
        header.style.marginBottom = "7em";
    } else {
        box.style.backgroundColor = "rgb(255,255,255)";
        button.hidden = false;
        header.style.marginBottom = "4em";
    }
}

function validateEmail(email) {
    var box = document.getElementById("email");
    var verifiedEmails = ['outlook.', 'gmail.', 'hotmail.', 'msn', 'ubc.mail.', 'shaw.', 'telus.'];
    var button = document.getElementById("sign-in-button");
    var header = document.getElementById("main-header");

    var valid = false;
    for (var i = 0; i < verifiedEmails.length; i++) {
        if (email.indexOf('@') > 0 && email.indexOf(verifiedEmails[i]) > 0) {
            valid = true;
        }
    }
    if (valid) {
        box.style.backgroundColor = "rgb(255,255,255)";
        button.hidden = false;
        header.style.marginBottom = "4em";
    } else {
        alert("Enter a valid Email!");
        box.style.backgroundColor = "rgb(255,0,0, 0.25)";
        button.hidden = true;
        header.style.marginBottom = "7em";
    }
}


$(document).ready(function () {
    // Clear form on window load
    $('#registration-form').find("input[type=text], textarea").val("");
    $('#registration-form').find("input[type=password], textarea").val("");
    $('#registration-form').find("input[type=email], textarea").val("");

});