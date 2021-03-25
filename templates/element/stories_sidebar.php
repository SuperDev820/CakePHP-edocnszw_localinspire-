<!-- Sticky Block -->
<div class="js-sticky-block" data-offset-target="#logoAndNav" data-parent="#stickyBlockStartPoint" data-sticky-view="lg" data-start-point="#stickyBlockStartPoint" data-end-point="#stickyBlockEndPoint" data-offset-top="32" data-offset-bottom="170">
    <h3 class="h5 text-primary font-weight-semi-bold mb-4">Latest Posts</h3>
    <?php foreach ($latest_posts as $post) { ?>
        <?= $this->element('latest_posts_block', ['post' => $post]) ?>
    <?php } ?>


    <hr class="my-7">

    <h3 class="h5 text-primary font-weight-semi-bold mb-4">Tags</h3>

    <!-- Tags -->
    <ul class="list-inline mb-0">
        <?php foreach ($city_tags as $tag) { ?>
            <li class="list-inline-item pb-3">
                <a class="btn btn-xs btn-gray btn-pill" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'stories', 'action' => 'index', $tag->slug, '?' => ['location' => isset($currentLocation['city']) ? $currentLocation['city'] . "-" . $currentLocation['region'] : '']]); ?>"><?= $tag->name ?></a>
            </li>
        <?php } ?>

    </ul>
    <!-- End Tags -->
</div>
<!-- End Sticky Block -->