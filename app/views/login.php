<form class="form" method="post" name="login">
    <div class="form-title"><?php echo $data['lang']['log_reg'] ?></div>
    <div class="form-content">
        <div class='form-field'>
            <label for="email"><?php echo $data['lang']['email'] ?></label>
            <input id="email" type="text" name="email"/>
        </div>
        <div class="form-field">
            <label for="password"><?php echo $data['lang']['password'] ?></label>
            <input id="password" type="password" name="password"/>
        </div>
    </div>
    <div class="form-action">
        <input class="button-submit" type="submit" value="<?php echo $data['lang']['login'] ?>"/>
        <div class="href lang">
            <a class="lang-en" href="en">en</a> | <a class="lang-ru" href="ru">ru</a>
        </div>
        <a class="href" href="register"><?php echo $data['lang']['register'] ?></a>
    </div>
</form>

