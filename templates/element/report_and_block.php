 <!-- Report & Block  -->

 <a class="text-secondary small mb-1 report_profile" href="javascript:;" data-receievername="<?= ucwords($targetUser->name_desc) ?>" data-receieverid="<?= $targetUser->id ?>">
     <i class="far fa-flag mr-1"></i> Report this profile
 </a>
 <br>

 <a class="text-secondary small block_user block_unblock" data-targetuser_id="<?= $targetUser->id ?>" data-user="<?= ucwords($targetUser->name_desc) ?>" href="javascript:;" style="display:<?= !$iblockedUser ? "block" : "none" ?>"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;&nbsp; <span class="block-text">Block</span> <span class="targetuser"><?php echo $targetUser->firstname ?> <?php echo substr($targetUser->lastname, 0, 1) . ""; ?></span>.</a>
 <a class="text-primary small unblock_user block_unblock" data-targetuser_id="<?= $targetUser->id ?>" data-user="<?= ucwords($targetUser->name_desc) ?>" href="javascript:;" style="display:<?= $iblockedUser ? "block" : "none" ?>"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;&nbsp; <span class="block-text">Unblock</span> <span class="targetuser"><?php echo $targetUser->firstname ?> <?php echo substr($targetUser->lastname, 0, 1) . ""; ?></span>.</a>

 <!-- End Report & Block  -->