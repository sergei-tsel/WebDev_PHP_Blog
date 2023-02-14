<div>
    <div>
        <a href="/profile/administer" class="btn btn-primary" tabindex="-1" role="button">Продолжить</a>
    </div>
    <div class="card mb-3 row">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?php echo $avatar ?>" style="max-width: 350px; height: 250px" class="card-img-top img-fluid col-md-6" alt="Фотография"/>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $name . ' ' . $surname ?></h5>
                    <p class="card-text">
                        Дата рождения: <?php echo $birth ?>
                    </p>
                    <p class="card-text">
                        Пол: <?php echo $sex ?>
                    </p>
                    <p class="card-text">
                        Телефон: <?php echo $phone ?>
                    </p>
                    <p class="card-text">
                        E-mail: <?php echo $email ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>