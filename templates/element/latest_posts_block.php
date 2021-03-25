<article class="card border-0 mb-5">
    <div class="card-body p-0">
        <div class="media">
            <div class="u-avatar mr-3">
                <img class="img-fluid rounded" src="<?= $this->Custom->getDp($post->image, "posts") ?>" alt="Image Description">
            </div>
            <div class="media-body">
                <h4 class="h6 font-weight-normal mb-0">
                    <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'stories', 'action' => 'view', $post->id, \Cake\Utility\Text::slug(strtolower($post->title))]); ?>"><?= $post->title ?></a>
                </h4>
            </div>
        </div>
    </div>
</article>