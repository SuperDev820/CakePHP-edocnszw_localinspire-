<?php $this->assign('title', "My Collections"); ?>

<?= $this->element('collection_content', ['accountpage' => true, 'user' => $currentUser]) ?>
