
<div>
    <!-- Business Owner -->
    <div class="media mb-3">
        <img class="u-avatar rounded-circle mr-3" src="<?= !empty($annnouncement->business->user) ?  $this->Custom->getDp($annnouncement->business->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">

        <div class="media-body align-self-center">
            <h4 class="d-inline-block mb-0">
                <a class="d-block h6 mb-0 bold" target="_blank" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($annnouncement->business->name)), $annnouncement->business->city->state->code, $annnouncement->business->id]); ?>"><?= $annnouncement->title ?></a>
            </h4>
            <span class="d-block txt-12lt text-graylt">Announcement from <?= $annnouncement->business->business_role->name ?> of <a class="bold" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($annnouncement->business->name)), $annnouncement->business->city->state->code, $annnouncement->business->id]); ?>"><?= $annnouncement->business->name ?></a>.</span>
        </div>
        <div class="media-body text-right">
            <small class="d-block"><a target="_blank" href="<?= $annnouncement->link ?>" class="btn btn-sm bold btn-recommend"><?= $annnouncement->cta ?></a></span></small>
        </div>
    </div>
    <!-- End Business Owner -->
    <p><?= $annnouncement->description ?> <?= !empty($annnouncement->start_date) ? "─ Starts: " . $this->Custom->readableTimestamp2($annnouncement->start_date) : "" ?> <?= !empty($annnouncement->stop_date) ? "- Ends: " . $this->Custom->readableTimestamp2($annnouncement->stop_date) : "" ?> </p>
</div>