<div>
    <div>
        <a href="/profile/administer" class="btn btn-primary"
           tabindex="-1" role="button">Продолжить</a>
    </div>
    <form enctype="multipart/form-data" action="/news/create" method="post">
        <div class="col-8 px-5">
            <div class="mb-3">
                <label for="title" class="form-label">Заголовок: </label>
                <input type="text" class="form-control" name="title" id="title">
            </div>
            <div class="mb-3">
                <label for="prev" class="form-label">Краткое описние: </label>
                <input type="text" class="form-control" name="prev" id="prev">
            </div>
            <div class="mb-3">
                <label for="full" class="form-label">Полное описание: </label>
                <input type="text" class="form-control" name="full" id="full">
            </div>
            <div class="mb-3">
                <label for="href" class="form-label">Ссылка (URI): </label>
                <input type="text" class="form-control" name="href" id="href">
            </div>
            <div class="mb-3">
                <label for="tag" class="form-label">Тэг </label>
                <input type="text" class="form-control" name="tag" id="tag">
            </div>
            <button type="submit" class="btn btn-primary mb-3">Отправить</button>
        </div>
    </form>
</div>
