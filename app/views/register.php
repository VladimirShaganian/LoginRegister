<form class="form" method="post" name="register">
    <div class="form-title">Регистрация</div>
    <div class="form-content">
        <div class="form-field required">
            <label for="first-name">Имя</label>
            <input id="first-name" type="text" name="first_name"/>
        </div>
        <div class="form-field">
            <label for="last-name">Фамилия</label>
            <input id="last-name" type="text" name="last_name"/>
        </div>
        <div class="form-field required">
            <label for="email">Почта</label>
            <input id="email" type="text" name="email"/>
        </div>
        <div class="form-field required">
            <label for="password">Пароль</label>
            <input id="password" type="password" name="password"/>
        </div>
        <div class="form-field required">
            <label for="password-confirm">Подтверждение пароля</label>
            <input id="password-confirm" type="password" name="password_confirm"/>
        </div>
        <div class="form-field-upload">
            <div class="button-upload">Загрузить Фото</div>
            <input type="file" name="image">
            <div class="image"></div>
        </div>
    </div>
    <div class="form-action">
        <input class="button-submit" type="submit" value="Зарегистрироваться">
        <a class="href" href="/">Отмена</a>
    </div>
</form>