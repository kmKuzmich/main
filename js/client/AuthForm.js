function showForgetForm() {
    closeRegistrationForm();
    closeRegistrationAnswerForm();
    document.getElementById("ForgetForm").style.visibility = "visible";
    document.getElementById("ForgetForm").style.left = "50%";
    document.getElementById("ForgetForm").style.marginLeft = "-200px";
    document.getElementById("ForgetForm").style.top = "200px";
    showAlBg();
}
function closeForgetForm() {
    document.getElementById("ForgetForm").style.visibility = "hidden";
    document.getElementById("ForgetForm").style.left = "-150%";
    document.getElementById("ForgetForm").style.top = "0%";
    document.getElementById("ForgetError").innerHTML = "";
    closeAlBg();
}
function showForgetAnswerForm() {
    closeForgetForm();
    closeRegistrationForm();
    closeRegistrationAnswerForm();
    document.getElementById("ForgetAnswerForm").style.visibility = "visible";
    document.getElementById("ForgetAnswerForm").style.left = "50%";
    document.getElementById("ForgetAnswerForm").style.marginLeft = "-200px";
    document.getElementById("ForgetAnswerForm").style.top = "200px";
    showAlBg();
}
function closeForgetAnswerForm() {
    document.getElementById("ForgetAnswerForm").style.visibility = "hidden";
    document.getElementById("ForgetAnswerForm").style.left = "-150%";
    document.getElementById("ForgetAnswerForm").style.top = "0%";
    closeAlBg();
}
function showRegistrationForm() {
    closeForgetForm();
    closeRegistrationAnswerForm();
    document.getElementById("RegistrationForm").style.visibility = "visible";
    document.getElementById("RegistrationForm").style.left = "50%";
    document.getElementById("RegistrationForm").style.marginLeft = "-200px";
    document.getElementById("RegistrationForm").style.top = "200px";

    JsHttpRequest.query('content.php', {'w': 'showStateForm'},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                document.getElementById("RegState_place").innerHTML = result["content"];
            }
        }, true);

    JsHttpRequest.query('content.php', {'w': 'showActivityForm'},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                document.getElementById("RegActivity_place").innerHTML = result["content"];
            }
        }, true);
    showAlBg();
}
function showCityForm(state) {
    JsHttpRequest.query('content.php', {'w': 'showCityForm', 'state': state},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                document.getElementById("RegCity_place").innerHTML = result["content"];
            }
        }, true);
}
function showCityOrderForm(state) {
    JsHttpRequest.query('content.php', {'w': 'showCityOrderForm', 'state': state},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                document.getElementById("OrderCity_place").innerHTML = result["content"];
            }
        }, true);
}
function checkNewCity(new_city) {
    if (new_city > 0) {
        document.getElementById("new_city").style.visibility = "hidden";
        document.getElementById("new_city").style.position = "absolute";
        document.getElementById("new_city").value = "";
    }
    if (new_city == 0 || new_city == "") {
        document.getElementById("new_city").style.visibility = "visible";
        document.getElementById("new_city").style.position = "relative";
        document.getElementById("new_city").value = "";
    }
}
function checkNewOrderCity(new_city) {
    if (new_city > 0) {
        document.getElementById("new_ordercity").style.visibility = "hidden";
        document.getElementById("new_ordercity").style.position = "absolute";
        document.getElementById("new_ordercity").value = "";
    }
    if (new_city == 0 || new_city == "") {
        document.getElementById("new_ordercity").style.visibility = "visible";
        document.getElementById("new_ordercity").style.position = "relative";
        document.getElementById("new_ordercity").value = "";
    }
}
function closeRegistrationForm() {
    document.getElementById("RegistrationForm").style.visibility = "hidden";
    document.getElementById("RegistrationForm").style.left = "-150%";
    document.getElementById("RegistrationForm").style.top = "0%";
    closeAlBg();
}
function showRegistrationAnswerForm(answer) {
    closeRegistrationForm();
    document.getElementById("RegistrationAnswerForm").style.visibility = "visible";
    document.getElementById("RegistrationAnswerForm").style.left = "50%";
    document.getElementById("RegistrationAnswerForm").style.marginLeft = "-200px";
    document.getElementById("RegistrationAnswerForm").style.top = "200px";
    document.getElementById("RegistrationAnswer").innerHTML = answer;
    showAlBg();
}
function closeRegistrationAnswerForm() {
    document.getElementById("RegistrationAnswerForm").style.visibility = "hidden";
    document.getElementById("RegistrationAnswerForm").style.left = "-150%";
    document.getElementById("RegistrationAnswerForm").style.top = "0%";
    document.getElementById("RegistrationAnswer").innerHTML = "";
    closeAlBg();
}
function SaveRegistration() {

    document.getElementById("RegError").innerHTML = "";

    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var email = document.getElementById("RegEmail").value;
    var name = document.getElementById("RegName").value;
    var state = document.getElementById("RegState_form").value;
    var city = document.getElementById("RegCity_form").value;
    var new_city = document.getElementById("new_city").value;
    var address = document.getElementById("RegAddress").value;
    var phone = document.getElementById("RegPhone").value;
    var activity = document.getElementById("RegActivity_form").value;
    var recaptcha_challenge_field = document.getElementById("recaptcha_challenge_field").value;
    var recaptcha_response_field = document.getElementById("recaptcha_response_field").value;
    var errorEmail = document.getElementById("errorEmail").value;

    if (reg.test(email) == false) {
        submit_email = 0;
    } else {
        submit_email = 1;
    }
    if (name == "") {
        submit_name = 0;
    } else {
        submit_name = 1;
    }
    if (address == "") {
        submit_address = 0;
    } else {
        submit_address = 1;
    }
    if (phone == "") {
        submit_phone = 0;
    } else {
        submit_phone = 1;
    }


    if (submit_email == 0) {
        document.getElementById("RegError").innerHTML += "Введите Ваш E-mail<br>";
    }
    if (submit_name == 0) {
        document.getElementById("RegError").innerHTML += "Укажите Ваше Имя<br>";
    }
    if (submit_address == 0) {
        document.getElementById("RegError").innerHTML += "Укажите по какому адресу Вы проживаете<br>";
    }
    if (submit_phone == 0) {
        document.getElementById("RegError").innerHTML += "Введите Ваш номер телефона<br>";
    }
    if (submit_email == 0) {
        document.getElementById("RegError").innerHTML += "Email принадлежит другому пользователю<br>";
    }
    if (submit_email == 1 && submit_name == 1 && submit_address == 1 && submit_phone == 1) {
        JsHttpRequest.query('content.php', {
                'w': 'SaveRegistration',
                'recaptcha_challenge_field': recaptcha_challenge_field,
                'recaptcha_response_field': recaptcha_response_field,
                'email': email,
                'name': name,
                'state': state,
                'city': city,
                'new_city': new_city,
                'address': address,
                'phone': phone,
                'activity': activity
            },
            function (result, errors) {
                if (errors) {
                    alert(errors);
                }
                if (result) {
                    if (result["err"] == "0") {
                        closeRegistrationForm();
                        showRegistrationAnswerForm(result["answer"]);
                    }
                    if (result["err"] == "1") {
                        document.getElementById("RegError").innerHTML = result["answer"];
                    }
                }
            }, true);
    }
}


function AuthAcount() {
    startLoading();
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var email = document.getElementById("AuthEmail").value;
    var pass = document.getElementById("AuthPass").value;

    if (reg.test(email) == false) {
        submit_email = 0;
    } else {
        submit_email = 1;
    }
    if (pass == "") {
        submit_pass = 0;
    } else {
        submit_pass = 1;
    }

    if (submit_email == 0) {
        document.getElementById("AuthError").innerHTML = "Введите Ваш E-mail";
        stopLoading();
    }
    if (submit_pass == 0) {
        document.getElementById("AuthError").innerHTML = "Введите Ваш пароль";
        stopLoading();
    }
    if (submit_email == 1 && submit_pass == 1) {
        JsHttpRequest.query('content.php', {'w': 'AuthAcount', 'email': email, 'pass': pass},
            function (result, errors) {
                if (errors) {
                    alert(errors);
                    stopLoading();
                }
                if (result) {
                    if (result["answer"] == "ok") {
                        window.location.reload();
                    }
                    if (result["answer"] == "dolg") {
                        window.location.href = 'index.php?dep=32&dep_up=4&dep_cur=14';
                    }
                    if (result["answer"] != "ok" && result["answer"] != "dolg") {
                        document.getElementById("AuthError").innerHTML = result["answer"];
                        stopLoading();
                    }
                }
            }, true);
    }
}
function SendAcountInfo() {
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var email = document.getElementById("ForgetEmail").value;
    if (reg.test(email) == false) {
        submit_email = 0;
    } else {
        submit_email = 1;
    }
    if (submit_email == 1) {
        JsHttpRequest.query('content.php', {'w': 'sendAcountInfo', 'email': email},
            function (result, errors) {
                if (errors) {
                    alert(errors);
                }
                if (result) {
                    if (result["answer"] == "ok") {
                        showForgetAnswerForm();
                    }
                    if (result["answer"] != "ok") {
                        document.getElementById("ForgetError").innerHTML = result["answer"];
                    }
                }
            }, true);
    }
}

function ShowAcountInfo() {
    JsHttpRequest.query('content.php', {'w': 'showAcountInfo'},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                document.getElementById("AcountInfo").innerHTML = result["content"];
            }
        }, true);
}
function LogOutAcount() {
    JsHttpRequest.query('content.php', {'w': 'out_acount'},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                document.location.reload();
            }
        }, true);
}

function check_nom(place) {
    var kol = place.value;
    var len = kol.length;
    var reg_simb = /([^0-9\[\]\{\}\s\.])/i;
    if (reg_simb.test(kol)) {
        kol = kol.substring(0, len - 1);
        place.value = kol;
    }
}
function checkPhone(place) {
    check_nom(place);
    var ph = place.value;
    if (ph.length <= 3) {
        place.value = "380";
    }
    if (ph.length > 12) {
        place.value = place.value.substring(0, 12);
    }
}
function checkClientEmail(email) {
    JsHttpRequest.query('content.php', {'w': 'checkClientEmail', 'email': email},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                document.getElementById("emailStatus").innerHTML = result["answer"];
                document.getElementById("errorEmail").value = result["er"];
            }
        }, true);
}

function checkMessageBox() {
    JsHttpRequest.query('content.php', {'w': 'checkMessageBox'},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                if (result["ex"] == 1) {
                    document.getElementById("messageBox").innerHTML = result["form"];
                }
            }
        }, true);
}

function showMessageBox(id) {
    JsHttpRequest.query('content.php', {'w': 'showMessageBox', 'id': id},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                showAlertForm(result["content"]);
            }
        }, true);
}

function setMessageStatus(id, status) {
    JsHttpRequest.query('content.php', {'w': 'setMessageStatus', 'id': id, 'status': status},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                closeAlertForm();
                document.getElementById("messageBox").innerHTML = "";
                checkMessageBox();
            }
        }, true);
}
function setMessageAnswer(id) {
    var answer = document.getElementById("messageAnswerId").value;
    JsHttpRequest.query('content.php', {'w': 'setMessageAnswer', 'id': id, 'answer': answer},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result) {
                closeAlertForm();
                document.getElementById("messageBox").innerHTML = "";
                checkMessageBox();
            }
        }, true);
}
//Функция Показа информации о наступлении просрочки 
function showMessageExp() {
    JsHttpRequest.query('content.php', {'w': 'showMessageExp'},
        function (result, errors) {
            if (errors) {
                alert(errors);
            }
            if (result["show"] == 1) {
                showAlertForm(result["content"]);
            }
        }, true);
}