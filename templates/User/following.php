<?php $this->assign('title', $user->name_desc . " Following"); ?>
<?= $this->element('profilenav', ['user' => $user]) ?>
<?= $this->element('followers_following', ['user_followers_following' => $user_followers_following, 'total_f_count' => $total_f_count, 'show_following' => true]) ?>

