
<div class="form form-profile">
    <div class="form-title"><?php echo $data['lang']['welcome'] ?></div>
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
                <span class="form-message"><?php echo $data['lang']['email'] ?></span>
            </li>
        </ul>
    </div>
    <div class="card-action">
        <div class="href lang">
            <a href="profile/en">en</a> | <a href="profile/ru">ru</a>
        </div>
        <a class="href" href='profile/logout'"><?php echo $data['lang']['logout'] ?></a>
    </div>
</div>