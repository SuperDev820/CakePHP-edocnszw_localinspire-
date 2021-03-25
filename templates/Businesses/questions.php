<?php $this->assign('title', "Community questions for " . $business->name . " - " . $business->city->name . ", " . $business->city->state->code); ?>
<style>
    .question_sort.active {
        font-weight: bold;
    }
</style>
<!-- ========== MAIN CONTENT ========== -->
<main class="gray-dark" id="content" role="main">

    <!-- Add Listing Section -->
    <div class="container pt-5 gray-darkspace-2">

        <div class="small mb-4">
            <a target="_blank" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>">
                <?= $business->name ?>
            </a>
            &nbsp;&nbsp;<i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;&nbsp; Ask the Community
        </div>

        <div class="row">

            <div class="col-lg-4 order-lg-2 mb-9 mt-4 mb-lg-0">
                <!-- Title -->
                <div class="mb-4">
                    <h2 class="h5">Popular questions for <b><?= $business->name ?></b></h2>
                </div>
                <!-- End Title -->
                <?php if (!empty($popular_questions)) { ?>
                    <?php foreach ($popular_questions as $question) { ?>
                        <?= $this->element('popular_questions', ['question' => $question]) ?>
                    <?php } ?>
                <?php } ?>


            </div>

            <div class="col-lg-8 order-lg-1">
                <h4><?= $business->name ?> Questions & Answers</h4>
                <div class="card pt-3 mt-4 px-4">
                    <div class="row">
                        <div class="col-12">
                            <!-- Card -->
                            Below are the questions that previous visitors have asked, with answers from representatives of <strong><?= $business->name ?>'s</strong> and other visitors.
                        </div>
                    </div>

                    <hr>
                    <div class="col-12 small">
                        <span class="question_counts"><?= $question_counts ?></span> questions sorted by:
                        &nbsp;&nbsp; <a href="<?= $this->Custom->getfilterUrl('sort', 'top', 'addQueryKey') ?>" class="question_sort <?= $this->Custom->queryHasKey('sort', 'top') ? 'active' : '' ?>">Most Answered</a>
                        &nbsp;&nbsp; | &nbsp;&nbsp;<a href="<?= $this->Custom->getfilterUrl('sort', 'recent', 'addQueryKey') ?>" class="question_sort <?= $this->Custom->queryHasKey('sort', 'recent') ? 'active' : '' ?>">Most Recent</a>
                        &nbsp;&nbsp; | &nbsp;&nbsp;<a href="<?= $this->Custom->getfilterUrl('sort', 'oldest', 'addQueryKey') ?>" class="question_sort <?= $this->Custom->queryHasKey('sort', 'oldest') ? 'active' : '' ?>">Oldest</a>
                    </div>
                    <hr>
                    <!-- Question -->
                    <div id="questions">
                        <?php echo $this->element('business_questions_mini', ['business_questions' => $business_questions]) ?>

                    </div>
                    <!-- End Question -->
                    <!-- <div id="qa_for_business"> -->
                    <?php //echo $this->element('business_questions') 
                    ?>
                    <!-- </div> -->

                </div>
                <!-- <nav class="card d-flex justify-content-center pt-3 mt-3 mb-3">
                    <ul id="pagination"></ul>

                </nav> -->

                <?= $this->element('pagination_block') ?>

                <div class="card pt-3 mt-2 px-4">
                    <!-- Input -->
                    <form id="postquestionform" class="js-validate" method="POST" action="">

                        <label class="small">
                            Questions? Get answers from <b><?= $business->name ?></b> staff and past visitors.

                        </label>
                        <div class="form-group">
                            <div class="js-form-message mb-6">


                                <div class="media mb-3">
                                    <div class="u-avatar mr-3">
                                        <img class="after_login_img  u-sidebar--account__toggle-img mr-2" src="<?= !empty($currentUser) ?  $this->Custom->getDp($currentUser->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">

                                    </div>
                                    <div class="media-body">
                                        <textarea placeholder="Hi, <?php if (!empty($currentUser)) {
                                                                        echo $currentUser->name_desc . ", ";
                                                                    } ?>what would you like to know about <?= $business->name ?>?" class="form-control" rows="3" name="question" aria-label="<b>What would you like to know about <?= $business->name ?>?</b>" data-msg="<div class='bold error-15'><i class='fas fa-exclamation-circle'></i> You must ask a question about <?= $business->name ?> to submit.</div>" data-error-class="u-has-error" data-success-class="u-has-success" required></textarea>

                                        <small>Note: your question will be posted publicly on the Questions & Answers page. </small>
                                        <a class="btn btn-sm btn-link" href="#questionModal" data-modal-target="#questionModal">
                                            <i data-toggle="tooltip" data-placement="top" title="Question Guidelines" class="fas fa-info-circle"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="business_id" value="<?= $business->id ?>" />
                            <div class="pl-4 mb-2 small">
                                <input type="checkbox" class="form-check-input" value="1" name="notify" id="notify" checked>
                                Get notified about new answers to your questions.
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm bold mt-2" id="questionsformsubmit">Post Question</button>
                        </div>
                </div>
            </div>
            </form>
            <!-- End Input -->

        </div>
        <!-- End Answer Details -->

        <?php if (!empty($most_popular_question)) { ?>
            <!-- Reviews -->
            <!-- End Reviews -->
            <!-- Hot Question Section -->
            <div class="container space-2">
                <!-- SVG Quote -->
                <figure class="mx-auto text-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="48px" height="48px" viewBox="0 0 8 8" style="enable-background:new 0 0 8 8;" xml:space="preserve">
                        <path class="fill-gray-400" d="M3,1.3C2,1.7,1.2,2.7,1.2,3.6c0,0.2,0,0.4,0.1,0.5c0.2-0.2,0.5-0.3,0.9-0.3c0.8,0,1.5,0.6,1.5,1.5c0,0.9-0.7,1.5-1.5,1.5
							C1.4,6.9,1,6.6,0.7,6.1C0.4,5.6,0.3,4.9,0.3,4.5c0-1.6,0.8-2.9,2.5-3.7L3,1.3z M7.1,1.3c-1,0.4-1.8,1.4-1.8,2.3
							c0,0.2,0,0.4,0.1,0.5c0.2-0.2,0.5-0.3,0.9-0.3c0.8,0,1.5,0.6,1.5,1.5c0,0.9-0.7,1.5-1.5,1.5c-0.7,0-1.1-0.3-1.4-0.8
							C4.4,5.6,4.4,4.9,4.4,4.5c0-1.6,0.8-2.9,2.5-3.7L7.1,1.3z" />
                    </svg>
                </figure>
                <!-- End SVG Quote -->

                <!-- Blockquote -->
                <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-6">
                    <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'singleQuestion', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($question->question)), 70), $most_popular_question->id]); ?>">
                        <blockquote class="lead text-secondary font-weight-normal"><?= $this->Custom->truncate($most_popular_question->question, 70, true) ?> </blockquote>
                    </a>
                </div>
                <!-- End Blockquote -->

                <!-- Asker -->
                <div class="d-flex justify-content-center align-items-center w-lg-50 mx-auto">
                    <div class="u-avatar">
                        <img class="img-fluid rounded-circle border" src="<?= !empty($most_popular_question->user) ?  $this->Custom->getDp($most_popular_question->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">
                    </div>
                    <div class="ml-3 small">
                        <h4 class="h6 mb-0">
                            <a class="d-block h6 bold mb-0" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $most_popular_question->user->username]); ?>"><?= ucfirst($most_popular_question->user->firstname) . " " . ucfirst(substr($most_popular_question->user->lastname, 0, 1)) ?>.</a> <small class="d-block text-graylt small"><?= $this->Custom->niceDateMonthDayYear($most_popular_question->created) ?></small>
                        </h4>
                    </div>
                </div>
                <!-- End Asker -->
            </div>
            <!-- End Hot Question Section -->
        <?php } ?>

        <hr class="my-0">

</main>
<!-- ========== END MAIN CONTENT ========== -->


<!-- Answer Guidelines Modal Window -->


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

<script>
    $(document).ready(function() {
        // question_pagemove(question_page, false);



        // $('.question_sort').click(function(){
        // 	var href = $(this).attr('href');
        // 	$('.question_sort').removeClass('active');
        // 	$(this).addClass('active');
        // 	question_page = 1;
        // 	question_order = href;
        // 	load_questions(1, href, true);
        // 	console.log(href);
        // })
    })
</script>