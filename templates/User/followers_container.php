<?php $this->disableAutoLayout(); ?>
<?php echo $this->element('user_followers_following', ['user_followers_following' => $user_followers_following, 'total_f_count' => $total_f_count, 'show_following' => $show_following]) ?>