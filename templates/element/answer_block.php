<?php
//			print_r($answer);
$answer_reviewed = "";
if ($answer->user_id == $business->user_id) {
    $answer_reviewed = "<span class='text-primary'>Business Representative</span>";
} else if ($userHasReviewedBusiness) {
    $answer_reviewed = "Reviewed business";
} else if ($answer->user_id != $business->user_id and $userHasReviewedBusiness) {
    } else if (!empty($business->business_reviews)) {
     } else if ($a0['business_representative'] == 0 && $a0['reviewed_business'] > 0) {
   $answer_reviewed = "&nbsp;|&nbsp; Reviewed this property";
} else {
     $answer_reviewed = "Reviewed business";
}

?>

<hr>
<div class="media">
    <div class="u-sm-avatar mr-3">
        <a class="bold text-gray" href="<?= $this->Url->build(['controller' => 'profile', 'view', $answer->user->username]);  ?>"><img class="after_login_img  u-sidebar--account__toggle-img mr-2 " src="<?= !empty($answer->user) ?  $this->Custom->getDp($answer->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description" style="height: 100%;"></a>
    </div>
    <div class="media-body">
        <span class="d-inline-block small">
            Answer from <a class="bold text-dark" href="<?= $this->Url->build(['controller' => 'user', '', $answer->user->username]);  ?>"><?= ucfirst($answer->user->firstname) . " " . ucfirst(substr($answer->user->lastname, 0, 1)) ?>.</a> <span class="txt-12lt text-graylt"> on <?= $this->Custom->niceDateMonthDayYear($answer->created) ?></span>
        </span>
        <span class="d-block txt-12lt text-gray-dark">
            <?= $answer_reviewed ?>
            <span id="all_helpful_<?= $answer->id ?>">
                <?php if (count($answer->helpful_answers) > 0) { ?>
                    &bull;
                    <?= count($answer->helpful_answers) ?>
                    <?= (count($answer->helpful_answers) == 1) ? " person found this helpful &nbsp;-&nbsp; " : " people found this helpful &nbsp;-&nbsp;" ?>
                    <?= $answer->mosthelpful ? " <span  class='fas fa-thumbs-up txt-14 text-primary mr-1 <?= $is_helpful ?>'></span> Most helpful answer" : "" ?>
                <?php } ?>
                &nbsp;|&nbsp;
                <a class="small text-grey reportanswer" href="javascript:;" data-answer_id="<?= $answer->id ?>">
                    <i data-toggle="tooltip" data-placement="top" title="" class="fas fa-flag" data-original-title="Problem with this answer?"></i>
                </a>
            </span>
    </div>
</div>

<div class=" mt-2 pl-3 border-left">
    <!-- <a href="<?php //echo $this->Url->build('/', ['fullBase' => true]) ?>questions/<?php  //$q['question_url'] 
                                                                ?>_answer-<?= $answer->id ?>" class="text-gray txt-14"><?= nl2br($answer->answer) ?></a> -->

    <?= nl2br($answer->answer) ?>

    <!-- <a class="text-gray txt-14" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'singleQuestion', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($question->question)), 70), $question->id]); ?>"><?= nl2br($question->question) ?></a> -->

</div>


<div class="mt-2">
    <?php
    $is_helpful = "";
    $is_unhelpful = "";
    if (!$this->Custom->answerNotHelpful($answer) and !$this->Custom->answerHelpful($answer)) {
        // if ($answer['give_helpful'] == 0 && $answer['give_unhelpful'] == 0) {
        $is_helpful = " give_helpful_answer";
        $is_unhelpful = " give_unhelpful_answer";
    } elseif ($this->Custom->answerHelpful($answer)) {
        // } elseif ($answer['give_helpful'] == 1 && $answer['give_unhelpful'] == 0) {
        $is_helpful = " gave_helpful_answer";
        $is_unhelpful = "";
    } elseif ($this->Custom->answerNotHelpful($answer)) {
        // } elseif ($answer['give_helpful'] == 0 && $answer['give_unhelpful'] == 1) {
        $is_helpful = "";
        $is_unhelpful = " gave_unhelpful_answer";
    }

    ?>
    <!-- Likes/Reply -->
    <ul class="list-inline d-flex">
        <li class="list-inline-item mr-4">

            <a class="text-body txt-12 bold <?= $is_helpful ?>" href="javascript:;" data-aid="<?= $answer->id ?>" data-helpfultarget="helpful_span_<?= $answer->id ?>">

                <span class="fas fa-thumbs-up text-black-50 txt-14 mr-1 <?= $is_helpful ?>"></span> Helpful <span class="show_helpful" id="helpful_span_<?= $answer->id ?>"><?= count($answer->helpful_answers) ?></span>
            </a>

        </li>
        <li class="list-inline-item mr-4">
            <h6>
                <a class="text-body txt-12 bold <?= $is_unhelpful ?>" href="javascript:;" data-aid="<?= $answer->id ?>" data-unhelpfultarget="unhelpful_span_<?= $answer->id ?>">

                    <span class="fas fa-thumbs-down  <?= $is_unhelpful ?> text-black-50 txt-14 mr-1"></span> Not Helpful <span class="show_unhelpful" id="unhelpful_span_<?= $answer->id ?>"><?= count($answer->unhelpful_answers) ?></span>
                </a>
            </h6>
        </li>

    </ul>
    <!-- End Likes/Reply -->

</div>