<div>
    <div>
        <a href="/profile/administer" class="btn btn-primary"
           tabindex="-1" role="button">Продолжить</a>
    </div>
    <form enctype="multipart/form-data" action="/profile/update" method="post">
        <div class="col-8 px-5">
            <div class="mb-3">
                <label for="name" class="form-label">Имя: </label>
                <input type="text" class="form-control" value="<?php echo $name ?>" name="name" id="name">
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label">Фамилия: </label>
                <input type="text" class="form-control" value="<?php echo $surname ?>" name="surname" id="surname">
            </div>
            <div class="mb-3">
                <label for="birth" class="form-label">Дата родения: </label>
                <input type="text" class="form-control" value="<?php echo $birth ?>" name="birth" id="birth">
            </div>
            <div class="mb-3">
                <label for="sex" class="form-label">Пол: </label>
                <input type="text" class="form-control" value="<?php echo $sex ?>" name="sex" id="sex">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Телефон: </label>
                <input type="text" class="form-control" value="<?php echo $phone ?>" name="phone" id="phone">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail: </label>
                <input type="text" class="form-control" value="<?php echo $email ?>" name="email" id="email">
            </div>
            <input type="file" class="btn btn-primary mb-3" name="avatar" id="avatar">
            <button type="submit" class="btn btn-primary mb-3">Отправить</button>
        </div>
    </form>
</div>