<form class="form" method="post" name="register">
    <div class="form-title"><?php echo $data['lang']['registration'] ?></div>
    <div class="form-content">
        <div class="form-field required">
            <label for="first-name"><?php echo $data['lang']['first_name'] ?></label>
            <input id="first-name" type="text" name="first_name"/>
        </div>
        <div class="form-field">
            <label for="second-name"><?php echo $data['lang']['second_name'] ?></label>
            <input id="second-name" type="text" name="second_name"/>
        </div>
        <div class="form-field required">
            <label for="email"><?php echo $data['lang']['email'] ?></label>
            <input id="email" type="text" name="email"/>
        </div>
        <div class="form-field required">
            <label for="password"><?php echo $data['lang']['password'] ?></label>
            <input id="password" type="password" name="password"/>
        </div>
        <div class="form-field required">
            <label for="password-confirm"><?php echo $data['lang']['password_confirm'] ?></label>
            <input id="password-confirm" type="password" name="password_confirm"/>
        </div>
        <div class="form-field-upload">
            <div class="button-upload"><?php echo $data['lang']['upload_photo'] ?></div>
            <input type="file" name="image">
            <div class="image"></div>
        </div>
    </div>
    <div class="form-action">
        <input class="button-submit" type="submit" value="<?php echo $data['lang']['register'] ?>">
        <div class="href lang">
            <a href="register/en">en</a> | <a href="register/ru">ru</a>
        </div>
        <a class="href" href="/"><?php echo $data['lang']['cancel'] ?></a>
    </div>
</form>