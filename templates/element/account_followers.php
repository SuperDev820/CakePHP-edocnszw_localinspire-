<?php foreach ($user_followers_followingArray as $i => $user_follower_following) { ?>
    <?php
    $usr = null;
    if ($following) {
        $usr = $user_follower_following->user;
    } else {
        $usr = $user_follower_following->follower;
    }
    ?>
    <div class="col-md-4 col-lg-4 col-sm-6 one-follower">
        <div class="card text-center mb-5">
            <div class="card-body">
                <!-- Team -->
                <div class="mb-4">
                    <span class="btn btn-lg btn-icon btn-soft-primary rounded-circle mb-3">
                        <a href="<?= $this->Url->build(['prefix'=>false,'controller' => 'user', 'action' => 'index', $usr->username]); ?>"><img style="width:100%;height:100%;" class="img-fluid rounded-circle" src="<?= !empty($usr) ?  $this->Custom->getDp($usr->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description"></a>
                        <span class="badge badge-xs badge-outline-success badge-pos badge-pos--bottom-left rounded-circle"></span>
                    </span>


                    <h2 class="h6 mb-0">
                        <a href="<?= $this->Url->build(['prefix'=>false,'controller' => 'user', 'action' => 'index', $usr->username]); ?>"><?= ucfirst($usr->firstname) . " " . ucfirst(substr($usr->lastname, 0, 1)) ?></a>
                    </h2>
                    <span class="txt-xs text-dark"> <?= !empty($usr->city) ? '<i class="fas fa-map-marker-alt "></i>  ' . $usr->city->name . ", " . strtoupper($usr->city->state->code) : ""; ?></span><br>
                    <span class="small text-primary status"></span>
                </div>
                <!-- End Team -->

                <!-- Social Networks -->
                <ul class="list-inline mb-5" style="min-height: 32px;">
                    <?php if (!empty($usr->facebook_link)) { ?>
                        <li class="list-inline-item">
                            <a class="btn btn-sm btn-icon btn-soft-secondary rounded-circle" href="https://www.facebook.com/<?= $usr->facebook_link ?>">
                                <span class="fab fa-facebook-f btn-icon__inner"></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($usr->google_link)) { ?>
                        <li class="list-inline-item">
                            <a class="btn btn-sm btn-icon btn-soft-secondary rounded-circle" href="https://www.instagram.com/<?= $usr->google_link ?>">
                                <span class="fab fa-instagram btn-icon__inner"></span>
                            </a>
                        </li>
                    <?php }  ?>
                    <?php if (!empty($usr->twitter_link)) { ?>
                        <li class="list-inline-item">
                            <a class="btn btn-sm btn-icon btn-soft-secondary rounded-circle" href="https://www.twitter.com/<?= $usr->twitter_link ?>">
                                <span class="fab fa-twitter btn-icon__inner"></span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                <!-- End Social Networks -->
                <?php $random_id_target = "follow_block" . mt_rand(100000, 999999); ?>
                <div id="<?= $random_id_target ?>">
                    <?= $this->element('follow_block', ['ckUser' => $currentUser, 'targetUser' => $usr, 'ckfollowsUser' => $user_follower_following->followsUser, 'ckfollowedByUser' => $user_follower_following->followedByUser, 'random_id_target' => $random_id_target]) ?>
                </div>

            </div>

            <div class="card-footer py-4 ">
                <a class="btn btn-sm btn-soft-primary sendmessage" href="javascript:void(0)" data-receievername="<?= ucwords($usr->name_desc) ?>" data-receieverid="<?= $usr->id ?>">
                    <span class="far fa-envelope mr-2"></span>
                    Send a Message
                </a>
            </div>
        </div>
    </div>
<?php } ?>