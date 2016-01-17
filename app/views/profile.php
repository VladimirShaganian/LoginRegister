
<div class="form form-profile">
    <div class="form-title">Добро Пожаловать</div>
    <div class="image">
        <img class="image-profile" src="<?php echo '../../assets/uploads/'. $data['image']; ?>">
    </div>

    <div class="form-content">
        <ul>
            <li>
                <div class="profile-name"><?php echo $data['first_name'].' '.$data['last_name']; ?></div>
            </li>
            <li>
                <div><?php echo $data['email']; ?></div>
                <span class="form-message">Эл. адрес</span>
            </li>
        </ul>
    </div>
    <div class="card-action">
        <a class="href" href='profile/logout'">Выйти</a>
    </div>
</div>