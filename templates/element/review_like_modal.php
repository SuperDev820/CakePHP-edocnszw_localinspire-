<div id="likedModal<?= $review->id ?>" class="js-modal-window u-modal-window" style="width: 600px;">
    <div class="card mb-9">
        <!-- Header -->
        <header class="bg-white pt-3 border-bottom py-3 px-5">
            <div class="row justify-content-between align-items-center no-gutters">
                <h3 class="h6 mb-0 bold">
                    <a class="bold text-dark" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $review->user->username]); ?>"><?= ucfirst($review->user->firstname) . " " . ucfirst(substr($review->user->lastname, 0, 1)) ?>'s
                    </a>
                    review
                </h3>

                <button type="button" class="close text-darker" aria-label="Close" onclick="Custombox.modal.close();">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </header>
        <!-- End Header -->
        <!-- End Report Review Form -->

        <!-- Body -->
        <div style="height: 500px;" class="js-scrollbar card-body pt-1 px-2">

            <!-- Card -->
            <?php for ($h = 0; $h < $review->helpful_count; $h++) {
                $rhelp = $review->helpful_reviews[$h];

            ?>

                <a class="bold text-dark" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $rhelp->user->username]); ?>">
                    <div class="border-bottom mb-2">
                        <div class="card-body">
                            <div class="media d-block d-sm-flex justify-content-sm-between align-items-sm-center">
                                <div class="u-avatar mr-3">
                                    <img class="img-fluid rounded-circle mb-2 mb-sm-0" src="<?= !empty($rhelp->user) ?  $this->Custom->getDp($rhelp->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description" style="width: 100%;height: 100%;">
                                </div>
                                <div class="media-body mb-2 mb-sm-0">
                                    <h4 class="h6 mb-0 text-dark bold">
                                        <a class="bold text-dark" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $rhelp->user->username]); ?>">
                                            <?= ucfirst($rhelp->user->firstname) . " " . ucfirst(substr($rhelp->user->lastname, 0, 1)) ?>.
                                        </a>
                                    </h4>
                                    <small class="d-block font-size-10-5 text-graylt mb-1">
                                        <?= !empty($rhelp->user->city) ? '<i class="fas fa-map-marker-alt "></i>  ' . $rhelp->user->city->name . ", " . strtoupper($rhelp->user->city->state->code) : ""; ?>
                                    </small>
                                    <small class="d-block font-size-10-5 text-graylt">
                                        <b><?= $this->Custom->userContributions($rhelp->user) ?></b> contributions &bull;
                                        <b><?= $rhelp->user->followers_count ?></b>
                                        <?= $rhelp->user->followers_count > 1 ? "Followers" : "Follower"; ?>
                                    </small>
                                </div>
                                <div class="media-body text-sm-right">
                                    <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $rhelp->user->username]); ?>" class="btn btn-xs btn-outline-primary bold">
                                        <i class="fas fa-user-plus mr-1"></i>
                                        <?= $rhelp->is_follow ? "Stop Following" : "Follow"; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php } ?>
            <!-- End Card -->
        </div>
        <!-- End Body -->
    </div>
</div>