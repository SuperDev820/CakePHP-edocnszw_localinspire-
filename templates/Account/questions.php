<?php $this->assign('title', 'My Questions'); ?>
<div class="bg-light">
    <main>
        <div class="container space-2">
            <?= $this->element('accountsidenav') ?>

            <div class="card p-4">
                <div class="row">
                    <div class="col-9">
                        <h4><b>Your Questions & Answers</b></h4>
                    </div>
                </div>

                <?php if (!$empty_result) { ?>



                    <div class="pt-1 pb-1 mt-1 px-1">
                        <hr>
                        Here are questions you've asked.
                        <hr>
                        <!-- Filters -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container_nav2">
                                    <div class="dropdown2">
                                        <button class="dropbtn2">Sort by: <b><?= $this->Custom->getQuestionsSortText() ?></b> <i class="fa fa-caret-down" aria-hidden="true"></i></button>
                                        <div class="dropdown-content2">
                                            <div class="triangle-border top">
                                                <a href="<?= $this->Custom->getfilterUrl('sort', 'recently-answered', 'addQueryKey') ?>"><span title="Recent Answered">Recently Answered</span></a>
                                                <a href="<?= $this->Custom->getfilterUrl('sort', 'recent', 'addQueryKey') ?>"><span title="Newest First">Newest First</span></a>
                                                <a href="<?= $this->Custom->getfilterUrl('sort', 'oldest', 'addQueryKey') ?>"><span title="Oldest First">Oldest First</span></a>
                                                <a href="<?= $this->Custom->getfilterUrl('sort', 'top', 'addQueryKey') ?>"><span title="Most Answered">Most Answers</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="dropdown2">
                                    <button class="dropbtn2">Places <i class="fa fa-caret-down" aria-hidden="true"></i> </button>
                                    <div class="dropdown-content2">
                                        <div class="triangle-border top"> <a href=""><span title="All Categories">Panda Express</span></a> <a href=""><span title="Restaurants">The Steak House</span></a> <a href=""> <span title="lodging">Carmonas</span> </a> </div>
                                    </div>
                                </div>
                                <div class="dropdown2">
                                    <button class="dropbtn2">Terrell, Tx <i class="fa fa-caret-down" aria-hidden="true"></i></button>
                                    <div class="dropdown-content2">
                                        <div class="triangle-border top"> <a href=""> <span title="Kansas City, MO">Kansas City, MO</span> <span title="(161)">(11)</span></a> <a href=""> <span title="Kansas City, KS">Kansas City, KS</span> <span title="(19)">(9)</span></a> <a href=""> <span title="Overland Park">Overland Park</span> <span title="(16)">(1)</span></a> </div>
                                    </div>
                                </div> -->
                                </div>
                                <div style="clear: both;"></div>

                                <!-- End Filters -->

                                <?php foreach ($business_questions as $question) { ?>
                                    <?php
                                    $view_text = "View ";
                                    if ($question->total_answers > 0) {
                                        $view_text .= $question->total_answers . " ";
                                        $view_text .= ($question->total_answers > 1 ? 'answers' : 'answer');
                                    } else {
                                        $view_text .= "Question";
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="bold"><?= $question->question ?></div>
                                            <span class="small">Asked on <?= $this->Custom->niceDateMonthDayYear($question->created) ?>
                                                <!-- in <span class="">Dallas, Tx</span>  -->
                                                for
                                                <!-- the location  -->
                                                <a class="bold" href="<?= $this->Url->build(['prefix'=>false,'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($question->business->name)), $question->business->city->state->code, $question->business->id]); ?>"> <?= $question->business->name ?></a> in <?= $question->business->city->name . ", " . strtoupper($question->business->city->state->code) ?>
                                                <!-- <a class="bold" href="">Los Dos Hermanos</a>. -->
                                            </span>
                                            <div style="margin-top:15px" class="row">
                                                <div class="col-md-8"><a class="btn btn-link" href="<?= $this->Url->build(['prefix'=>false,'controller' => 'businesses', 'action' => 'singleQuestion', \Cake\Utility\Text::slug(strtolower($question->business->name)), $question->business->city->state->code, $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($question->question)), 70), $question->id]); ?>"> <?= $view_text ?></a> </div>
                                                <!--<?= $this->Url->build(['prefix'=>false,'controller' => 'businesses', 'action' => 'singleQuestion', \Cake\Utility\Text::slug(strtolower($question->business->name)), $question->business->city->state->code, $this->Custom->truncate(\Cake\Utility\Text::slug(strtolower($question->question)), 70), $question->id]); ?>-->
                                                <div class="col-md-4 text-right">
                                                    <!-- <button data-toggle="tooltip" title="Edit question" class="btn btn-soft-facebook btn-sm" type="button"><i class="fas fa-pencil-alt"></i></button>
                                                <button data-container="body" data-toggle="tooltip" title="Remove question" class="btn btn-soft-facebook btn-sm" type="button"><i class="fa fa-trash" aria-hidden="true"></i></button> -->
                                                </div>
                                            </div>
                                            <div style="clear: both;"></div>
                                        </div>
                                    </div>

                                    <hr>
                                <?php } ?>

                                <?= $this->element('pagination_block') ?>

                            </div>
                        </div>
                    </div>

                <?php } else { ?>
                    <div class="row">
                        <div class="col-9">
                            <h3><b>You haven't asked any questions yet</b></h3>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>
</div>

<script>
    $(document).ready(function() {


        $('select[name=filters]').change(function() {
            var sort = $(this).val();
            var hrefUrl = "<?= $this->Url->build($this->request->getRequestTarget(), ['fullBase' => true]); ?>";
            // var page = getParameterByName('page', hrefUrl);
            hrefUrl = updateQueryString('sort', sort, hrefUrl);
            window.location.href = hrefUrl;

            // $('.followers_following_list').html("");
            // $("#view_more_link").data('more', 1);
            // console.log(order);
            // load_followers_following_list(MID, order, 0);
        });
    })
</script>