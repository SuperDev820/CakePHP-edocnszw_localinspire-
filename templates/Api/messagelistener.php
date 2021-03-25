<?php $this->disableAutoLayout(); ?>
<?= $this->element('notifications_unread', ['notifications_values' => $notifications_unread_messages, 'message_notification' => true]) ?>