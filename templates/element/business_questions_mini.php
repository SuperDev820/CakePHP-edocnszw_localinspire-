<?php if (!empty($business_questions)) { ?>
    <?php foreach ($business_questions as $index => $question) { ?>
        <div class="row">
            <div class="col-12">
                <div class="media">
                    <div class="u-avatar mr-3">
                        <a class="font-weight-bold txt-sm" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $question->user->username]); ?>">
                            <img class="u-avatar border rounded-circle mr-3" src="<?= !empty($question->user) ?  $this->Custom->getDp($question->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">
                        </a>
                    </div>
                    <div class="media-body"><?= nl2br($question->question) ?><br>

                        <h6 class="d-inline-block mb-1 small">
                            Asked by <a class="font-weight-bold txt-sm" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $question->user->username]); ?>"><?= ucfirst($question->user->firstname) . " " . ucfirst(substr($question->user->lastname, 0, 1)) ?>.</a> on <?= $this->Custom->niceDateMonthDayYear($question->created) ?>&nbsp;|&nbsp;

                            <a class="small reportquestion" href="javascript:;" data-question_id="<?= $question->id ?>" data-b="<?= $business->id ?>"> <i data-toggle="tooltip" data-placement="top" title="Problem with this question?" class="fas text-grey fa-flag"></i></a>

                        </h6>

                    </div>
                </div>
                <?php

                if ($question->total_answers <= 0) {
                    $q_answer = "<span id='answer_count" . $question->id . "'>Show Question</span>";
                } else {
                    $q_answer = "<span id='answer_count" . $question->id . "'> Show " . ($question->total_answers > 1 ? 'all ' : '') . $question->total_answers . " answer" . ($question->total_answers > 1 ? 's' : '') . "</span>";
                }
                ?>
                <div class="mt-3">
                    <a class="btn btn-xs txt-15 text-primary  mr-1" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'singleQuestion', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($question->question)), 70), $question->id]); ?>" role="button"><?= $q_answer ?></a>
                    <a class="btn btn-xs btn-dark  bold text-right" data-toggle="collapse" href="#answer<?= $question->id ?>" role="button" aria-expanded="false" aria-controls="answer1">Answer
                    </a>

                    <?php $random_id_target_and_id =  "ajaxQuestion" . mt_rand(100000, 999999); ?>
                <div id="<?= $random_id_target_and_id ?>"></div>
                </div>
               
                <div class="collapse" id="answer<?= $question->id ?>">
                    <form class="js-validate mb-4 answer_form" action="" data-response_target="<?= $random_id_target_and_id ?>">
                        <div class="js-form-message mt-2" style="display: flex;justify-content: start;flex-wrap: wrap;">
                             <img class="u-avatar rounded-circle mr-3" src="<?= !empty($currentUser->image) ?  $this->Custom->getDp($currentUser->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" style="width: 30px; height: 30px;">

                            <textarea name="answer" style="padding: 5px;padding-left:15px;border-color: #ffffff;background-color: #f0f2f5; width:90%;border-radius:     30px" rows="1" class="" style="flex: 1;" onfocusin="$('#answerbuttons_<?= $index ?>').collapse('show');$(this).attr('rows', '3');" placeholder="Write a public answer" aria-label="Answer question" required="" data-msg="Answer question" data-error-class="u-has-error" data-success-class="u-has-success"></textarea>
                        </div>
                        <input type="hidden" name="question_id" value="<?= $question->id ?>" />

                        <div class="collapse" id="answerbuttons_<?= $index ?>">

                            <div class="row mt-2">
                                <div class="col-sm-5"> <button type="submit" class="btn btn-sm btn-primary btn-smsq mr-2 ml-7">Submit</button>
                                    <button type="button" class="btn btn-sm btn-link btn-smsq ml-2" onclick="$('#answer<?= $question->id ?>').collapse('hide');$(this).parents('form').find('textarea').attr('rows', '1');">Cancel</button>
                                </div>
                                <div class="col-sm-7 text-right">
                                    <a class="btn btn-link btn-sm" href="#answerModal" onclick="new Custombox.modal({content: {effect: 'fadein',target: '#answerModal'}}).open();">Posting guidelines</a> </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
    <?php } ?>

<?php } else { ?>

    <div class="card pt-3 mt-4 mb-4 text-center pb-4 ">
        <i class="far fa-question-circle fa-3x"></i>
        <h5>
            <h4 class="bold">No questions here</h4> Have a question? Get helpful advice from our past visitors.
        </h5>
    </div>

<?php } ?>