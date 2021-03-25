<!-- Sidebar Info -->

<div class="card p-4 mb-5">
    <div class="border-bottom pb-2 mb-2">

        <h6 class="bold">About</h6>

        <!-- Additional Info -->
        <ul class="list-inline font-size-15 mb-4 text-grey">
            <li class="list-inline-item mb-1">
                <small class="fas fa-map-marker-alt mr-1"></small>
                <span class="txt-12"><?= !empty($user->city) ?  $user->city->name . ", " . strtoupper($user->city->state->code) : '' ?></span></li>
                <BR>
            <li class="list-inline-item"><i class="far fa-calendar-alt mr-1"></i>
                <span class="txt-12">Joined <?= $this->Custom->niceDateMonthYear($user->created) ?></span>
            </li>
        </ul>
        <!-- End Additional Info -->
        <div class="pb-1 mb-1">
            <h3 class="font-size-1 font-weight-semi-bold mb-1">My Hometown</h3>

            <!-- Languages -->
            <span class="d-block txt-12 font-weight-medium mb-1"><?= $user->hometown ?>
                <!-- End Languages -->
        </div>

        <h2 class="font-size-1 font-weight-semi-bold mb-1">About Me</h2>

        <p class="txt-12 mb-3"><?= !empty($user->about_me) ? "<q>" . $user->about_me . "</q>" : ""; ?></p>
        <?php $random_id_target = "follow_block" . mt_rand(100000, 999999); ?>
        <div id="<?= $random_id_target ?>">
            <?= $this->element('follow_block', ['ckUser' => $currentUser, 'targetUser' => $user, 'ckfollowsUser' => $followsUser, 'ckfollowedByUser' => $followedByUser, 'random_id_target' => $random_id_target]) ?>
        </div>

    </div>

    <div class="text-center">
        <a href="https://www.facebook.com/<?= $user->facebook_link ?>" class="btn btn-icon btn-link" target="_blank">
            <span class="fab fa-facebook-f btn-icon__inner"></span>
        </a>
        <a href="https://twitter.com/<?= $user->twitter_link ?>" class="btn btn-icon btn-link" target="_blank">
            <span class="fab fa-twitter btn-icon__inner"></span>
        </a>
        <a href="https://www.instagram.com/<?= $user->google_link ?>" class="btn btn-icon btn-link" target="_blank">
            <span class="fab fa-instagram btn-icon__inner"></span>
        </a>
    </div>
</div>


<?php if (!empty($currentUser) and $currentUser->id != $user->id) { ?>
    <?= $this->element('report_and_block', ['targetUser' => $user, 'iblockedUser' => $blockedUser]) ?>
<?php } ?>

<br><br>


<script>
    $(document).ready(function() {

      

    })
</script>