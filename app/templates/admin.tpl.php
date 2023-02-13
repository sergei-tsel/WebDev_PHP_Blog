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
    <div>
        <a href="/news/list" class="btn btn-primary" tabindex="-1" role="button">Вывести свежие новости в порядке убывания отметок и просмотров</a>
    </div>
</div>
<div>
    <div class="form-outline mb-4">
        <form action="/news/search" method="post">
            <input type="search" class="form-control" name="search" id="datatable-search-input">
            <label class="form-label" for="datatable-search-input">Поиск</label>
        </form>
    </div>
    <div id="datatable">
        <?php foreach ($data as $value) : ?>
            <div class="card mb-3 row g-0">
                <div class="col-md-4">
                    <img src="<?php echo $value['href_avatar'] ?>" style="max-width: 70px; height: 50px" class="card-img-top img-fluid col-md-6" alt="Фотография"/>
                    <p class="card-text"><?php echo $value['name'] . ' ' . $value['surname'] ?></p>
                    <a href="/profile/look/<?php echo $value['id'] ?>" class="btn btn-primary" tabindex="-1" role="button">Об авторе</a>
                </div>
                <div class="col-md-8 card-body">
                    <section class="border-bottom pb-4 mb-5>
                        <div class="col-md-6 mb-4">
                            <div class="row">
                                <?php foreach ($value['tag'] as $tag): ?>
                                    <span class="badge bg-danger px-2 py-1 shadow-1-strong mb-3"><?php echo $tag ?></span>
                                <?php endforeach; ?>
                            </div>
                            <h4><strong><?php echo $value['title'] ?></strong></h4>
                            <p class="text-muted">
                                <?php echo $value['prev_desc'] ?>
                            </p>
                            <a href="/news/read/<?php echo $value['href_news'] ?>" class="btn btn-primary" tabindex="-1" role="button">Далее</a>
                        </div>
                    </section>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
$limit = 10;

$pages = ceil($total / $limit);

$page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
    'options' => array(
        'default'   => 1,
        'min_range' => 1,
    ),
)));

$offset = ($page - 1)  * $limit;

$start = $offset + 1;
$end = min(($offset + $limit), $total);

$prevLink = ($page > 1) ? '<a href="./Main/index/1" title="First page">&laquo;</a> <a href="./Main/index/'
    . ($page - 1) . '" title="Previous page">&lsaquo;</a>' :
    '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

$nextLink = ($page < $pages) ? '<a href="/' . ($page + 1) .
    '" title="Next page">&rsaquo;</a> <a href="/' . $pages . '" title="Last page">&raquo;</a>' :
    '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

echo
'<div id="paging"><p>', $prevLink, ' Страница ', $page, ' из ', $pages, ' страниц, отображается ',
$start, '-', $end, ' из ', $total, ' результатов ', $nextLink, ' </p></div>';
?>
