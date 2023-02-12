<div class="row">
    <div>
        <a href="/profile/read" class="btn btn-primary" tabindex="-1" role="button">Открыть свой профиль</a>
    </div>
    <div>
        <a href="/profile/introduce" class="btn btn-primary" tabindex="-1" role="button">Изменить свой профиль</a>
    </div>
    <div>
        <a href="/profile/exit" class="btn btn-primary" tabindex="-1" role="button">Выйти из своего профиля</a>
    </div>
    <div>
        <a href="/profile/use" class="btn btn-primary" tabindex="-1" role="button">Удалить свой профиль</a>
    </div>
    <div>
        <a href="/news/make" class="btn btn-primary" tabindex="-1" role="button">Добавить новость</a>
    </div>
</div>
<div>
    <div class="form-outline mb-4">
        <form action="/profile/search" method="post">
            <input type="search" class="form-control" id="datatable-search-input">
            <label class="form-label" for="datatable-search-input">Поиск</label>
        </form>
    </div>
    <div id="datatable">
        <?php foreach ($data as $value) : ?>
        <div class="card mb-3 row g-0">
            <div class="col-md-4">
                <img src="<?php echo $avatar ?>" style="max-width: 70px; height: 50px" class="card-img-top img-fluid col-md-6" alt="Фотография"/>
                <p class="card-text"><?php echo $name . ' ' . $surname ?></p>
                <a href="/profile/look/<?php echo $value['id'] ?>" class="btn btn-primary" tabindex="-1" role="button">Об авторе</a>
            </div>
            <div class="col-md-8 card-body">
                <section class="border-bottom pb-4 mb-5>
                    <div class="col-md-6 mb-4">
                        <span class="badge bg-danger px-2 py-1 shadow-1-strong mb-3"><?php echo $value['tag'] ?></span>
                        <h4><strong><?php echo $value['title'] ?></strong></h4>
                        <p class="text-muted">
                            <?php echo $value['prev_desc'] ?>
                        </p>
                        <a href="<?php echo $value['href_news'] ?>" class="btn btn-primary" tabindex="-1" role="button">Далее</a>
                    </div>
                </section>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

