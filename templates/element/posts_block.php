  <?php if (!empty($post)) { ?>
      <article class="card border-0">
          <div class="card-body p-0">
              <div class="mb-5">
                  <img class="img-fluid rounded" src="<?= $this->Custom->getDp($post->image, "posts") ?>" alt="Image Description">
              </div>
              <small class="d-block text-secondary mb-1"><?= $this->Custom->niceDateMonthDayYear($post->created) ?></small>
              <h2 class="h5">
                  <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'stories', 'action' => 'view', $post->id, \Cake\Utility\Text::slug(strtolower($post->title))]); ?>"><?= $post->title ?></a>
              </h2>
              <p><?= ucfirst($this->Custom->truncate($post->excerpt, 50, true)) ?></p>
          </div>
      </article>
  <?php } ?>