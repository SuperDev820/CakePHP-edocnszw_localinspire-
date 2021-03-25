<?php $top_answer = $question->answers[0]; ?>

<div id="top_answer_<?= $question->id ?>">
    <!-- Answered -->
    <?= $this->element('answer_block', ['answer' => $top_answer, 'question' => $question, 'business' => $business]) ?>
    <!-- End Answered -->
</div>

<?php if (count($question->answers) > 1) { ?>
    <div style="display: none;" id="showallanswer<?= $question->id ?>">
        <div class="">
            <?php for ($aa = 1; $aa < count($question->answers); $aa++) { ?>
                <!-- Answered -->
                <?= $this->element('answer_block', ['answer' => $question->answers[$aa], 'question' => $question, 'business' => $business]) ?>
                <!-- End Answered -->
            <?php } ?>

        </div>
    </div>

    <div class="mt-0">
        <button style="cursor: pointer;" class="btn btn-link bold btn-sm cursor showcollapsemore" onclick="$(this).parent().find('button.showcollapseless').css('display', 'block');$(this).css('display','none');$('#showallanswer<?= $question->id ?>').css('display','block');">
            Show all answers
        </button>
        <button onclick="$(this).parent().find('button.showcollapsemore').css('display', 'block');$(this).css('display','none');$('#showallanswer<?= $question->id ?>').css('display','none');" style="display: none;cursor: pointer;" class="btn btn-link bold btn-sm showcollapseless">
            Show top answer
        </button>

    </div>
<?php } else { ?>
    <div style="display: none;" id="showallanswer<?= $question->id ?>"></div>
    <div class="mt-0" id="showallbutton<?= $question->id ?>" style="display: none; cursor: pointer;">
        <button style="cursor: pointer;" class="btn btn-link bold btn-sm cursor showcollapsemore" onclick="$(this).parent().find('button.showcollapseless').css('display', 'block');$(this).css('display','none');$('#showallanswer<?= $question->id ?>').css('display','block');">
            Show all answers
        </button>
        <button onclick="$(this).parent().find('button.showcollapsemore').css('display', 'block');$(this).css('display','none');$('#showallanswer<?= $question->id ?>').css('display','none');" style="display: none;cursor: pointer;" class="btn btn-link bold btn-sm showcollapseless">
            Show top answer
        </button>
    </div>
<?php } ?>