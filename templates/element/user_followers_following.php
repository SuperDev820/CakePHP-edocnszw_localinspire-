<?php if ($total_f_count > 0) { ?>

    <?php foreach ($user_followers_following as $i => $user_follower_following) { ?>

        <?php

        $usr = null;

        if ($show_following) {
            $usr = $user_follower_following->user;
        } else {
            $usr = $user_follower_following->follower;
        }
        ?>

        <div class="col-md-4 col-lg-4 col-sm-6 no-gutter-2 f_content">
            <!-- Friends List -->
            <a class="card card-frame mb-3" href="<?= $this->Url->build(['prefix'=>false,'controller' => 'user', 'action' => 'index', $usr->username]); ?>">
                <div class="card-body">
                    <div class="media">
                        <div class="u-avatar mr-3">
                            <img class="img-fluid rounded-circle border" src="<?= !empty($usr) ?  $this->Custom->getDp($usr->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description" style="width:100%;height:100%;">
                        </div>
                        <div class="media-body">
                            <h4 class="txt-12 text-dark bold mt-2 mb-0"><?= ucfirst($usr->firstname) . " " . ucfirst(substr($usr->lastname, 0, 1)) ?>.</h4>
                            <div class="text-graylt bold txt-12lt">
                                <?= !empty($usr->city) ? '<i class="fas fa-map-marker-alt "></i>  ' . $usr->city->name . ", " . strtoupper($usr->city->state->code) : ""; ?>
                            </div>

                        </div>
                    </div>
                    <div class="text-graylt text-center mt-3 txt-12lt"> <b><?= $usr->followers_count ?></b> <?= $usr->followers_count > 1 ? "followers" : "follower"; ?> &bull; <b><?= $this->Custom->userContributions($usr) ?></b> contributions
                    </div>

                </div>
            </a>
            <!-- End Friends List -->

        </div>
    <?php } ?>

<?php } else { ?>
    <div class="col-md-12 f_content">
        <div class="card pt-3 mb-4 text-center pb-4 w-100">
            <i class="fas fa-user-friends fa-3x"></i>

            <?php if ($show_following) { ?>
                <h5>
                    <h4 class="bold">Not following anyone yet</h4> <?= ucfirst($user->firstname) . " " . ucfirst(substr($user->lastname, 0, 1)) ?>. is not following anyone at the moment
                </h5>
            <?php } else { ?>
                <h5>
                    <h4 class="bold">No followers yet</h4> <?= ucfirst($user->firstname) . " " . ucfirst(substr($user->lastname, 0, 1)) ?>. doesn't have any followers yet. Why not be their first?
                </h5>
            <?php } ?>
        </div>
    </div>

<?php } ?>
<script>
    
</script>