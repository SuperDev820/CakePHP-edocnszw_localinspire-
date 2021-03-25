<?php $this->assign('title', "Community questions for " . $business->name . " - " . $business->city->name . ", " . strtoupper($business->city->state->code)); ?>
<style>
    .ungive_helpful_answer {
        color: #0073ca !important;
    }

    .ungive_helpful_answer span {
        color: #0073ca !important;
        font-weight: bold;
    }

    #answer_list .gave_helpful_answer {
        color: #0073ca !important;
        font-weight: bold;
    }

    #answer_list .gave_unhelpful_answer {
        color: #0073ca !important;
        font-weight: bold;
    }

    #answer_list .give_helpful_answer:hover,
    #answer_list .ungive_helpful_answer:hover {
        color: #0073ca;
    }

    .gave_helpful_answer span {
        color: #0073ca !important;
        font-weight: bold;
    }
</style>
<!-- ========== MAIN CONTENT ========== -->
<main class="gray-dark" id="content" role="main">

    <!-- Add Listing Section -->
    <div class="container pt-5 gray-darkspace-2">

        <div class="small mb-4">
            <a target="_blank" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>"><?= $business->name ?></a>
            &nbsp;&nbsp;
            <i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;&nbsp;
            <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'questions', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>">Ask the Community</a> &nbsp;&nbsp;
            <i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;&nbsp;
            <?= $this->Custom->truncate($question->question, 50, true) ?>
        </div>

        <div class="row">

            <div class="col-lg-4 order-lg-2 mb-9 mt-0 mb-lg-0">
                <!-- Title -->
                <div class="mb-4">
                    <div class="d-flex justify-content-end">
                        <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'questions', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>" class="btn btn-soft-facebook btn-sm ">See all questions</a>
                    </div>
                </div>
                <!-- End Title -->
                <!-- Input -->
                <form id="postquestionform" class="js-validate" method="POST" action="">
                    <div class="form-group pl-0 pr-0 mb-2 small">
                        <h6 class="bold">Ask a question</h6>
                        <label class="small" for="exampleSelect1">Get quick answers from <?= $business->name ?> staff and past visitors. </label>
                        <!-- Input -->
                        <div class="js-form-message">
                            <div class="input-group">
                                <textarea placeholder="Hi, <?php if (!empty($currentUser)) {
                                                                echo $currentUser->firstname . ", ";
                                                            } ?>what would you like to know about <?= $business->name ?>?" class="form-control" rows="3" name="question" aria-label="<b>What would you like to know about <?= $business->name ?>?</b>" data-msg="<div class='bold error-15'><i class='fas fa-exclamation-circle'></i> You must ask a question about <?= $business->name ?> to submit.</div>" data-error-class="u-has-error" data-success-class="u-has-success" required></textarea>

                            </div>
                            <input type="hidden" name="business_id" value="<?= $business->id ?>" />
                            <div class="pl-4 mt-2 mb-3 small" style="position: relative;">
                                <input type="checkbox" class="form-check-input" value="1" name="notify" id="notify" checked style="top:0;">
                                Get notified about new answers to your questions.
                            </div>
                            <!-- End Input -->
                        </div>
                        <!-- End Input -->
                    </div>
                    <!-- Buttons -->
                    <div class="d-flex">
                        <button type="submit" class="btn btn-sm btn-primary bold mr-1">Ask</button>
                        <button type="button" class="btn btn-sm btn-link" href="#questionModal" data-modal-target="#questionModal">Posting guidlines</button>
                    </div>

                    <!-- End Buttons -->
                </form>


            </div>

            <div class="col-lg-8 order-lg-1">
                <h4><?= $business->name ?> Questions & Answers</h4>

                <!-- Review Details -->
                <div class="card pt-3 pb-4 mt-4 px-4">
                    <div class="row">
                        <div class="col-9">
                            <!-- Card -->
                            <div class="media">
                                <div class="u-avatar mr-3">
                                    <a class="small mb-0 bold" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $question->user->username]); ?>">
                                        <img class="u-avatar border rounded-circle mr-3" src="<?= !empty($question->user) ?  $this->Custom->getDp($question->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h6 class="d-inline-block mb-1 font-weight-normal txt-sm">
                                        <a class="font-weight-bold txt-sm" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $question->user->username]); ?>">
                                            <?= ucfirst($question->user->firstname) . " " . ucfirst(substr($question->user->lastname, 0, 1)) ?>.</a> asked a question</b> <span class="text-dark small">on <?= $this->Custom->niceDateMonthDayYear($question->created) ?></span>
                                    </h6>
                                    <span class="d-block txt-12 text-body">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        <?= !empty($question->user->city) ? $question->user->city->name . ", " . strtoupper($question->user->city->state->code) : ""; ?> &bull; <?= $this->Custom->userContributions($question->user) ?> contributions
                                    </span>
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
                                        <a class="dropdown-item reportquestion" href="javascript:;" data-question_id="<?= $question->id ?>" data-b="<?= $business->id ?>">
                                            <i data-toggle="tooltip" data-placement="top" title="Problem with this question?" class="fas fa-flag"></i>
                                        </a>

                                    </div>
                                    <!-- End Settings Dropdown -->
                                </li>

                            </ul>
                            <!-- End Icons -->
                        </div>
                    </div>

                    <!-- End Header -->
                    <!-- End Author -->

                    <h5 style="line-height: 1.2;" class="mt-3" href=""><?= nl2br($question->question) ?></h5>


                    <?php if (!empty($currentUser) and $question->user_id == $currentUser->id) { ?>
                        <!-- Checkbox -->
                        <div class="js-form-message mb-0">
                            <div class="custom-control custom-checkbox d-flex align-items-center text-muted">
                                <input type="checkbox" class="custom-control-input" id="termsCheckbox" <?= $question->notify == 1 ? " checked" : "" ?>>
                                <label class="custom-control-label" for="termsCheckbox">
                                    <small>Notify me of new answers
                                    </small>
                                </label>
                            </div>
                        </div>
                        <!-- End Checkbox -->
                    <?php } ?>

                    <div class="d-flex justify-content-end">
                        <a href="javascript:;" class="btn btn-sm btn-primary bold mr-1" id="go_answer">Provide an answer</a>
                    </div>
                    <hr>
                    <span><span id="total_count"><?= $answers_total_count ?></span>&nbsp;Answers</span>
                    <div id="answer_list">
                        <?php if (!empty($answers)) { ?>
                            <?php foreach ($answers as $answer) { ?>
                                <?= $this->element('answer_block', ['answer' => $answer, 'question' => $question, 'business' => $business]) ?>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <?php $random_id_target_and_id =  "ajaxQuestion" . mt_rand(100000, 999999); ?>
                    <div id="<?= $random_id_target_and_id ?>"></div>
                </div>
                <?= $this->element('pagination_block', ['model' => 'Answers', 'showPageBool' => $showAnswersPagination]) ?>

                <div class="card pt-3 pb-4 mt-4 px-4">
                    <p class="bold small">Hi, <?php if (!empty($currentUser)) {
                                                    echo $currentUser->firstname . ", ";
                                                } ?>can you provide an answer for this traveler's question?</p>
                    <div class="media mb-3">
                        <div class="u-avatar mr-3">
                            <img class="after_login_img  u-sidebar--account__toggle-img mr-2" src="<?= !empty($currentUser) ?  $this->Custom->getDp($currentUser->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">

                        </div>
                        <div class="media-body">
                            <form action="" method="post" id="answerform" class="js-validate answer_form" data-response_target="<?= $random_id_target_and_id ?>">
                                <input type="hidden" name="question_id" value="<?= $question->id ?>" />
                                <div class="js-form-message">
                                    <div class="input-group">
                                        <textarea placeholder="Hi, <?php if (!empty($currentUser)) {
                                                                        echo $currentUser->firstname . ", ";
                                                                    } ?>can you answer this traveler's question?" aria-label="Hi, can you answer this traveler's question?" required="" data-msg="<div class='bold error-15'><i class='fas fa-exclamation-circle'></i> Please add an answer for this question to submit." data-error-class="u-has-error" data-success-class="u-has-success" class="form-control" rows="5" name="answer"></textarea>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <BR>
                    <div class="text-left">
                        <button class="btn btn-sm btn-primary bold mr-1" type="submit"> Answer</button>
                        <button type="button" class="btn btn-link btn-sm" href="#answerModal" data-modal-target="#answerModal">Posting guidelines</button></div>
                    </form>


                </div>

                <!-- End Answer Details -->
                <div class="m-4">
                    <div class="mb-4 mt-5">
                        <h2 class="h5">Popular questions for <b><?= $business->name ?></b></h2>
                    </div>
                    <?php if (!empty($popular_questions)) { ?>
                        <?php foreach ($popular_questions as $question) { ?>
                            <!-- Reviews -->
                            <div class="mb-5">
                                <!-- Author -->
                                <div class="media mb-2">
                                    <a class="bold text-dark" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $question->user->username]); ?>">
                                        <img class="u-sm-avatar rounded-circle border mr-3" src="<?= !empty($question->user) ?  $this->Custom->getDp($question->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="">
                                    </a>

                                    <div class="media-body align-self-center">
                                        <span class="d-inline-block txt-14 mb-0">
                                            Asked by <a class="txt-14 mb-0 bold" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $question->user->username]); ?>"><?= ucfirst($question->user->firstname) . " " . ucfirst(substr($question->user->lastname, 0, 1)) ?>.</a> <?= $this->Custom->niceDateMonthDayYear($question->created) ?>
                                            <br><?= !empty($question->user->city) ? $question->user->city->name . ", " . strtoupper($question->user->city->state->code) : ""; ?>
                                        </span>
                                    </div>

                                    <div class="media-body text-right">
                                        <small class="d-block text-muted txt-12lt"><a class="txt-14 " href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'singleQuestion', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($question->question)), 70), $question->id]); ?>">Answer</a></small>
                                    </div>
                                </div>
                                <!-- End Author -->

                                <div class="txt-14"><a class="txt-14 text-primary" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'singleQuestion', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($question->question)), 70), $question->id]); ?>">
                                        <?= $this->Custom->truncate($question->question, 70, true) ?> &nbsp;|&nbsp; View <?= $question->total_answers > 1 ? "all " . $question->total_answers . " answers" : $question->total_answers . " answer" ?></a></div>


                            </div>
                            <!-- End Reviews -->

                        <?php } ?>
                    <?php } ?>
                    <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'questions', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>">View all <span class="question_counts"><?= $question_counts ?></span> questions</a>

                    <hr class="mt-4 my-0">
                </div>
            </div>
        </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->



<?= $this->element('answer_modal') ?>

<!-- Answer Guidelines Modal Window -->

<!-- Question Guidelines Modal Window -->
<?= $this->element('question_modal') ?>
<!-- End Question Guidelines Modal Window -->

<!-- Report Review Modal Window -->
<?= $this->element('report_question_modal') ?>
<!-- End Report Review Modal Window -->

<!-- Post Question Success Modal Window -->
<?= $this->element("success_modal_question") ?>
<!-- Report Success Modal Window -->
<?= $this->element("success_modal") ?>
<?= $this->element("answer_success_modal") ?>

<?= $this->element('report_answer_modal') ?>

<script>
    $(document).ready(function() {
        // single_question_pagemove(single_question_page, false);
        $('#go_answer').click(function() {
            $('textarea[name=answer]').focus();
            var $scrollTo = $('#answerform');
            var scroll_top = $scrollTo.offset().top - 50;
            $("html, body").animate({
                scrollTop: scroll_top
            }, "slow");
        });


        $('input[id=termsCheckbox]').change(function() {

            alert('yeah');
            if ($(this).is(':checked')) {
                var notify = 1;
            } else {
                var notify = 0;
            }
            $.ajax({
                type: "POST",
                url: "<?= $this->Url->build('/', ['fullBase' => true]) ?>v/set_answer_notify",
                dataType: "json",
                data: {
                    notify: notify,
                    qid: $('input[id=qid]').val()
                },
                success: function(data) {
                    console.log(data);
                },
                error: function(error) {
                    console.log(error);
                }
            })
        })

    })
</script>