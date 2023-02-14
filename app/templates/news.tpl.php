<article class="border-bottom pb-4 mb-5>
    <header class="col-md-6 mb-4>
        <h2><strong><?php echo $news['title'] ?></strong></h2>
    </header>
    <main class="col-md-6 mb-4>
        <p class="text-muted">
            <?php echo $news['full_desc'] ?>
        </p>
    </main>
    <footer class="col-md-6 mb-4>
        <span class="text-muted"><?php echo $news['dt_publish'] ?></span>
        <p class="text-muted">
            <?php echo $author['name'] . ' ' . $author['surname'] ?>
        </p>
        <div class="row">
            <?php foreach ($news['tag'] as $tag): ?>
                <span class="badge bg-danger px-2 py-1 shadow-1-strong col-md-3 mb-3"><?php echo $tag ?></span>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <a <?php if(!empty($like)) {
                echo "hidden";
            }?> href="/news/mark" class="btn btn-primary col-md-3" tabindex="-1" role="button">Отметить</a>
            <p class="text-muted">
                <?php echo $news['amount_view'] . " просмотров" ?>
            </p>
            <p class="text-muted">
                <?php echo $news['amount_like'] . " отметивших" ?>
            </p>
        </div>
    </footer>
</article>