<form action="/auth/<?php echo $action ?>" method="post">
    <div class="col-8 px-5">
        <div class="mb-3">
            <label for="login" class="form-label">Логин: </label>
            <input type="text" class="form-control" name="login" id="login">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль: </label>
            <input type="<?php echo $type ?>" class="form-control" name="password" id="password">
        </div>
        <div class="row">
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3"><?php echo $button ?></button>
            </div>
            <div class="col-4 ms-auto">
                <a href="/auth/form" class="btn btn-primary" tabindex="-1" role="button">Создать аккаунт</a>
            </div>
        </div>
    </div>
</form>