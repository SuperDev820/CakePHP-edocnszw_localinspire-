<?php $this->disableAutoLayout(); ?>
<?= $this->element('report_and_block', ['targetUser' => $targetUser, 'iblockedUser' => $targetUser->blockedUser]) ?>