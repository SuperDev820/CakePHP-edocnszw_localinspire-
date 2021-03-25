  <a class="d-flex align-items-center bg-img-hero restaurant-city gradient-overlay-half-dark-v1 height-300 rounded-pseudo" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'search', 'action' => 'index', '?' => ['find' => 'Restaurants', 'location' => $city->name . "-" . strtoupper($city->state->code)]]); ?>" style="background-image: url(<?= $this->Custom->getDp($city->image, 'cities', '210x100') ?>);">
      <article class="w-100 text-center p-6">
          <div class="mt-0">
              <h2 class="h2 font-weight-semi-bold text-white"><?= ucfirst($city->name) ?>, <?= ucfirst($city->state->code) ?></h2>
              <strong class="d-block text-white mt-0"><?= ucfirst($city->description) ?></strong>
          </div>
      </article>
  </a>