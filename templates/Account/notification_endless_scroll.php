<?php $this->disableAutoLayout(); ?>
<?= $this->element('notification_block', ['notifications' => $notifications, 'notifications_total_count' => $notifications_total_count]) ?>