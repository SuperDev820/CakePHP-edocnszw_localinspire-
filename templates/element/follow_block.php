<?php //echo(json_encode($ckUser)) 
?>
<?php if (!empty($targetUser)) { ?>
    <?php if (!empty($ckUser->id) and $ckUser->id == $targetUser->id) { ?>

    <?php } else { ?>


        <?php if (!empty($ckfollowsUser) and $ckfollowsUser) { ?>
            <div>
                <a class="btn btn-block btn-sm btn-soft-primary bold unfollow" href="javascript:void(0);" data-targetuser_id="<?= $targetUser->id ?>" data-block="<?= $random_id_target ?>"><span class="fas fa-user-minus small mr-2"></span> Stop Following <?= ucfirst($targetUser->firstname) ?></a>
            </div>
        <?php } else if (!empty($ckfollowedByUser) and $ckfollowedByUser) { ?>
            <div>
                <a class="btn btn-block btn-sm btn-soft-primary bold following follow" data-targetuser_id="<?= $targetUser->id ?>" data-block="<?= $random_id_target ?>" href="javascript:void(0);">Follow Back</a>
            </div>
        <?php } else { ?>
            <div>
                <a class="btn btn-block btn-sm btn-soft-primary bold follow" data-targetuser_id="<?= $targetUser->id ?>" data-block="<?= $random_id_target ?>" href="javascript:void(0);"><span class="fas fa-user-plus small mr-2"></span> Follow <?= ucfirst($targetUser->firstname) ?></a>
            </div>
        <?php } ?>
    <?php } ?>

<?php } ?>