<?php $this->disableAutoLayout(); ?>
<?= $this->element('answer_block', ['answer' => $top_answer, 'question' => $question, 'business' => $business]) ?>
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>