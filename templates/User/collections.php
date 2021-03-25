<?php $this->assign('title', $user->name_desc . " Collections"); ?>

<?= $this->element('profilenav', ['user' => $user]) ?>
<?= $this->element('collection_content', ['user' => $user]) ?>
