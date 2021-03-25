<style>
    .btn-soft-facebook:hover {
        color: #fff;
        background: #3b5998;
    }
</style>
<?php if (!empty($business_questions)) {
    foreach ($business_questions as $index => $question) { ?>
        <div class="card pt-3 mt-4 px-4 mb-4">
            <div class="row">
                <div class="col-9">
                    <!-- Card -->
                    <div class="media">
                        <div class="u-avatar mr-3">
                            <a class="bold text-dark" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $question->user->username]); ?>">
                                <img class="u-avatar rounded-circle mr-3" src="<?= !empty($question->user) ?  $this->Custom->getDp($question->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description"></a>
                        </div>
                        <div class="media-body">
                            <span class="d-inline-block font-weight-normal small">
                                <a class="bold text-dark" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $question->user->username]); ?>"><?= ucfirst($question->user->firstname) . " " . ucfirst(substr($question->user->lastname, 0, 1)) ?>.</a> asked a question <?= $this->Custom->niceDateMonthDayYear($question->created) ?>
                            </span>
                            <span class="d-block txt-12lt text-gray-dark">
                                <?= !empty($question->user->city) ? '<i class="fas fa-map-marker-alt "></i>  ' . $question->user->city->name . ", " . strtoupper($question->user->city->state->code) : ""; ?>
                                &bull; <?= $this->Custom->userContributions($question->user) ?>
                                contributions </span>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <div class="col-3 text-right">
                    <!-- Icons -->
                    <ul class="list-inline mb-0">

                        <li class="list-inline-item mr-0">
                            <!-- Settings Dropdown -->
                            <div class="position-relative">
                                <a id="createProjectSettingsDropdown<?= "answer" . $index ?>Invoker" class="btn btn-sm btn-icon btn-soft-link btn-bg-transparent" href="javascript:;" role="button" aria-controls="createProjectSettingsDropdown<?= "answer" . $index ?>" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-target="#createProjectSettingsDropdown<?= "answer" . $index ?>" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                                    <span class="fas fa-ellipsis-h text-dark btn-icon__inner"></span>
                                </a>

                                <div id="createProjectSettingsDropdown<?= "answer" . $index ?>" class="dropdown-menu dropdown-unfold border dropdown-menu-right u-unfold--css-animation u-unfold--hidden fadeOut" aria-labelledby="createProjectSettingsDropdown<?= "answer" . $index ?>Invoker" style="min-width: 120px;">

                                    <a class="dropdown-item reportquestion" href="javascript:;" data-question_id="<?= $question->id ?>" data-b="<?= $business->id ?>">Report this</a>
                                </div>
                            </div>
                            <!-- End Settings Dropdown -->
                        </li>

                    </ul>
                    <!-- End Icons -->
                </div>
            </div>
            <!-- End Header -->
            <!-- End Author -->
            <div class="media">
                <a class="text-dark txt-17 line-height mt-4" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'singleQuestion', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($question->question)), 70), $question->id]); ?>"><?= nl2br($question->question) ?></a>
            </div>

            <?php if (!empty($question->answers)) { ?>
                <?= $this->element('question_answers', ['question' => $question, 'business' => $business]) ?>
            <?php } else { ?>
                <div id="top_answer_<?= $question->id ?>"></div>
                <div style="display: none;" id="showallanswer<?= $question->id ?>"></div>
                <div class="mt-0" id="showallbutton<?= $question->id ?>" style="display: none; cursor: pointer;">
                    <button style="cursor: pointer;" class="btn btn-link bold btn-sm cursor showcollapsemore" onclick="$(this).parent().find('button.showcollapseless').css('display', 'block');$(this).css('display','none');$('#showallanswer<?= $question->id ?>').css('display','block');">
                        Show all answers
                    </button>
                    <button onclick="$(this).parent().find('button.showcollapsemore').css('display', 'block');$(this).css('display','none');$('#showallanswer<?= $question->id ?>').css('display','none');" style="display: none;cursor: pointer;" class="btn btn-link bold btn-sm showcollapseless">Show top answer
                    </button>
                </div>
            <?php } ?>
            <?php $random_id_target_and_id =  "ajaxQuestion" . mt_rand(100000, 999999); ?>
            <div id="<?= $random_id_target_and_id ?>"></div>
            <hr>
            <form class="js-validate mb-4 answer_form" action="" data-response_target="<?= $random_id_target_and_id ?>">
                <div class="js-form-message mt-2" style="display: flex;justify-content: start;flex-wrap: wrap;">
                    <img class="u-avatar rounded-circle mr-3" src="<?= !empty($currentUser->image) ?  $this->Custom->getDp($currentUser->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" style="width: 30px; height: 30px;">

                    <textarea name="answer" rows="1" style="padding: 5px;padding-left:15px;border-color: #ffffff;background-color: #f0f2f5; width:90%;border-radius:     30px"class="small" style="flex: 1;" onfocusin="$('#answerbuttons_<?= $index ?>').collapse('show');$(this).attr('rows', '3');" placeholder="Answer question" aria-label="Answer question" data-msg="Answer question" data-error-class="u-has-error" data-success-class="u-has-success" required></textarea>
                </div>
                <input type="hidden" name="question_id" value="<?= $question->id ?>" />
                <div class="collapse" id="answerbuttons_<?= $index ?>">
                    <div class="row mt-2">
                        <div class="col-sm-5">
                            <button type="submit" class="btn btn-sm btn-primary btn-smsq mr-2 ml-7">Submit</button>
                            <button type="button" class="btn btn-sm btn-link btn-smsq ml-2" onclick="$('#answerbuttons_<?= $index ?>').collapse('hide');$(this).parents('form').find('textarea').attr('rows', '1');">
                                Cancel
                            </button>

                        </div>
                        <div class="col-sm-7 text-right">
                            <a class="btn btn-link btn-sm" href="#answerModal" onclick="new Custombox.modal({content: {effect: 'fadein',target: '#answerModal'}}).open();">
                                Posting guidelines
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <?php } ?>

    <?= $this->element('pagination_block') ?>

<?php } else { ?>

    <div class="card pt-3 mt-4 mb-4 text-center pb-4 ">
        <i class="far fa-question-circle fa-3x"></i>
        <h5>
            <h4 class="bold">No questions yet</h4> Have a question? Get helpful advice from our past visitors.
        </h5>
    </div>

<?php } ?>

<?= $this->element('answer_modal') ?>

<!-- Answer Guidelines Modal Window -->

<script>
    $(document).ready(function() {
        $('.question_counts').text(<?= $total_questions_count ?>);
    });
</script>