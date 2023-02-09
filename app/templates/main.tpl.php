<div class="container-fluid row gx-5">
    <?php foreach ($news as $value) : ?>
        <!--Section: News of the day-->
        <section class="border-bottom pb-4 mb-5>
            <div class="col-md-6 mb-4">
                <span class="badge bg-danger px-2 py-1 shadow-1-strong mb-3"><?php echo $value['tag'] ?></span>
                <h4><strong><?php echo $value['title'] ?></strong></h4>
                <p class="text-muted">
                    <?php echo $value['prev_desc'] ?>
                </p>
                <button type="button" class="btn btn-primary"><a id="news"></a>Далее</button>
                <script>get('.news', <?php echo $value['href_news'] ?>)</script>
            </div>
        </section>
        <!--Section: News of the day-->
    <?php endforeach; ?>
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
