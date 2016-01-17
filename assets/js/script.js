
/*
* Проверка поля ввода на наличие введенной информации (если поле пустое выводится сообщение)
*  field - поле для проверки
*  message - сообщение для вывода
*/
function checkRequireField(field, message) {
    if (field.parentNode.querySelector('.form-message-red')) {
        field.parentNode.querySelector('.form-message-red').remove();
    }
    if (field.parentNode.querySelector('.form-message')) {
        field.parentNode.querySelector('.form-message').remove()
    }
    var div = document.createElement('div');
    div.className = 'form-message';
    field.parentNode.appendChild(div);
    if (!field.value) {
        field.nextElementSibling.innerHTML = message;
        field.nextElementSibling.className = "form-message-red";
        return false;
    } else {
        field.nextElementSibling.innerHTML = "";
        field.nextElementSibling.className = "form-message";
        return true;
    }
}

// проверка ввода эл. адреса
function checkEmail(email) {

    var emailReg = /\S+@\S+\.\S+/; // рег. выражение для проверки ввода E-mail

    if (emailReg.test(email.value) == false) {
        email.nextElementSibling.innerHTML = "Эл. адрес должен содержать символы '@' и '.'";
        email.nextElementSibling.className = "form-message-red";
        return false;
    } else {
        email.nextElementSibling.innerHTML = "";
        email.nextElementSibling.className = "form-message";
        return true;
    }
}

// проверка ввода пароля
function checkPassword(pass, confirm) {

    if (!confirm.value && pass.value) {
        if (confirm.value == pass.value) {
            showErrorMessage('confirm');
        }
    }

    /*
    if (!pass.value) {
        pass.nextElementSibling.innerHTML = "Введите пароль";
        pass.nextElementSibling.className = "form-message-red";
    } else {
        pass.nextElementSibling.innerHTML = "";
        pass.nextElementSibling.className = "form-message";
    }

    if (!confirm.value) {
        confirm.nextElementSibling.innerHTML = "Подтвердите пароль";
        confirm.nextElementSibling.className = "form-message-red";
    } else {
        confirm.nextElementSibling.innerHTML = "";
        confirm.nextElementSibling.className = "form-message";
    }
    */

}

/*
* Вывод ошибок
* error - текст ошибки
* если error отсутствует, удаляется существующее сообщение
* */
function showErrorMessage(error) {

    if (document.querySelector('.error-message')) {
        document.querySelector('.error-message').remove();
    }

    var message = document.createElement('div');
    message.className = "error-message";

    var form = document.querySelector('.form-content');
    form.appendChild(message);

    if(error) {
        message.innerHTML = error;
    }

}

// функция изменяет поле при фокусировке
function changeFormField(field) {
    /*
     1. Без фокуса - серый (a. первый показ, б. нет тескта)
     2. Сфокусирован - синий ( ввод текста)
     3.
     3.1 Если поле пустое - без фокуса красный
     3.2 Если поле заполенено - сфокусирован серый

     используемые классы

     .label-focused-blue
     .label-focused-gray
     .label-unfocused-gray
     .label-unfocused-red

     .input-focused-blue
     .input-focused-gray
     .input-unfocused-gray
     .input-unfocused-red

     .form-message
     .form-message-red
     */

    var label = field.firstElementChild; // название поля ввода
    var input = field.firstElementChild.nextElementSibling; // поле ввода



    var requiredClassName = /required/; // метка для необходимых полей
    if (requiredClassName.test(field.className) == true) {
        var required = document.createElement("span");
        required.innerHTML = "*";
        required.className = "required-span";
        label.appendChild(required);
    }


    label.className = 'label-unfocused-gray';
    input.className = 'input-unfocused-gray';


    input.addEventListener('focus', function () {
        label.className = 'label-focused-blue';
        input.className = 'input-focused-blue';
        if (required) {
            required.className = "required-span-red";
        }

    });
    input.addEventListener('blur', function () {
        if (!input.value) {
            label.className = 'label-unfocused-red';
            input.className = 'input-unfocused-red';
        } else {
            label.className = 'label-focused-gray';
            input.className = 'input-unfocused-gray';
            if (required) {
                required.className = "required-span";
            }

        }
    });
}



var formField = document.querySelectorAll(".form-field");
for (var i = 0; i <formField.length; i++) {
    changeFormField(formField[i]);
}

var loginForm = document.forms.namedItem("login");


// обработчик формы логин
if (loginForm) {
    loginForm.addEventListener('submit', function(e) {

        var formData = new FormData(loginForm);
        var checked = true;

        if ( !checkRequireField( this.elements.password, "Введите пароль" )) {
            checked = false;
        }

        if ( checkRequireField( this.elements.email, "Введите эл. адрес" )) {
            if (!checkEmail(email)) {
                checked = false;
            }
        } else {
            checked = false;
        }

        if (checked) {
            var request = new XMLHttpRequest();
            request.open("POST", "login/login_check");
            request.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    if (this.responseText == "false") {
                        showErrorMessage('Указан неправильный адрес или пароль');
                    } else {
                        location.href = 'profile';
                    }
                }
            };
            request.send(formData);
        }

        e.preventDefault();
    });
}

var registerForm = document.forms.namedItem("register");
if (registerForm) {

    // Загрузка фото по умолчанию
    var image = new Image();
    image.src = "assets/images/user_blank_200x200.jpg";
    registerForm.querySelector(".image").appendChild(image);

    // Обработчик предпросмотра фото
    registerForm.elements.image.addEventListener("change", function() {

        registerForm.querySelector(".image").firstElementChild.remove();

        var file = this.files[0];

        var image = document.createElement("img");
        image.file = file;
        registerForm.querySelector(".image").appendChild(image);

        var reader = new FileReader();
        reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(image);
        reader.readAsDataURL(file);

    });

    // Обработчик формы регистрации
    registerForm.addEventListener("submit", function(e) {

        var formData = new FormData(registerForm);

        var checked = true;

        if ( !checkRequireField( this.elements.first_name, "Введите имя" )) {
            checked = false;
        }

        if ( !checkRequireField( this.elements.password, "Введите пароль" )) {
            checked = false;
        }

        if ( !checkRequireField( this.elements.password_confirm, "Подтвердите пароль" )) {
            checked = false;
        }

        if ( checkRequireField( this.elements.email, "Введите эл. адрес" )) {
            if (!checkEmail(email)) {
                checked = false;
            }
        } else {
            checked = false;
        }

        if ( (this.elements.password.value && this.elements.password_confirm.value)
            && (this.elements.password.value != this.elements.password_confirm.value) ) {
            showErrorMessage("Пароли не совпадают");
            checked = false;
        } else {
           showErrorMessage();
        }

        if (checked) {
            var request = new XMLHttpRequest();
            request.open("POST", "register/add_user");
            request.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    if (this.responseText) {
                        showErrorMessage(this.responseText);
                    } else {
                        location.href = "/";
                    }
                }
            };
            request.send(formData);
        }

        e.preventDefault();
    }, false);
}