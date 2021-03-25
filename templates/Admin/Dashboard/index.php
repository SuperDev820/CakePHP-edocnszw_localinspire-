<?php $this->assign('title', 'Dashboard'); ?>


<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<!-- Minimal statistics section start -->
<section id="minimal-statistics">
    <!-- <div class="row">
		<div class="col-12 mt-3 mb-1">
			<div class="content-header">Minimal Statistics Cards</div>
			<p class="content-sub-header">Statistics on minimal cards.</p>
		</div>
    </div> -->

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <h4 class="card-title">Pending Reports</h4>
                        <!-- <p class="card-text">Some quick example text to build on the card.</p> -->
                    </div>
                    <ul class="list-group">

                        <li class="list-group-item">
                            <a href="<?= $this->Url->build(['controller' => 'reports', 'action' => 'answers']); ?>" class="menu-item"> Answers</a>
                            <span class="badge bg-warning float-right"><?php echo number_format($viewCounts['report_answers_untreated']) ?></span>
                        </li>

                        <li class="list-group-item">
                            <a href="<?= $this->Url->build(['controller' => 'reports', 'action' => 'reviews']); ?>" class="menu-item">Reviews</a>
                            <span class="badge bg-warning float-right"><?php echo number_format($viewCounts['report_reviews_untreated']) ?></span>
                        </li>

                        <li class="list-group-item">
                            <a href="<?= $this->Url->build(['controller' => 'reports', 'action' => 'reviewResponses']); ?>" class="menu-item">Review Responses</a>
                            <span class="badge bg-warning float-right"><?php echo number_format($viewCounts['report_review_responses_untreated']) ?></span>
                        </li>

                        <li class="list-group-item">
                            <a href="<?= $this->Url->build(['controller' => 'reports', 'action' => 'photos']); ?>" class="menu-item">Photos</a>
                            <span class="badge bg-warning float-right"><?php echo number_format($viewCounts['report_photos_untreated']) ?></span>
                        </li>

                        <li class="list-group-item">
                            <a href="<?= $this->Url->build(['controller' => 'reports', 'action' => 'questions']); ?>" class="menu-item">Questions</a>
                            <span class="badge bg-warning float-right"><?php echo number_format($viewCounts['report_questions_untreated']) ?></span>
                        </li>
                        <li class="list-group-item">
                            <a href="<?= $this->Url->build(['controller' => 'reports', 'action' => 'profiles']); ?>" class="menu-item">Profiles</a>
                            <span class="badge bg-warning float-right"><?php echo number_format($viewCounts['report_profiles_untreated']) ?></span>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">

            <div class="row">
                <div class="col-md-6 text-right">
                    <h3><?= !empty($label) ? $label : 'All Time' ?>:</h3>
                    <?= $this->Form->create(null, ['class' => 'form-horizontal', 'id' => 'momentForm']) ?>
                    <?= $this->Form->hidden('startDate', ['value' => !empty($startDate) ? $startDate : '']); ?>
                    <?= $this->Form->hidden('endDate', ['value' => !empty($endDate) ? $endDate : '']); ?>
                    <?= $this->Form->hidden('label', ['value' => !empty($label) ? $label : '']); ?>
                    <?= $this->Form->end() ?>
                </div>
                <div class="col-md-6">
                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>

                </div>
            </div>
            <div class="row" matchHeight="card">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?= $this->Url->build(['controller' => 'users', 'action' => 'index']); ?>">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body text-left">
                                            <h3 class="mb-1 success"><?= number_format($users_count) ?></h3>
                                            <span> Users</span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <i class="icon-users success font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?= $this->Url->build(['controller' => 'reviews', 'action' => 'index']); ?>">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body text-left">
                                            <h3 class="mb-1 success"><?= number_format($total_reviews) ?></h3>
                                            <span> Reviews</span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <!-- <i class="icon-user success font-large-2 float-right"></i> -->
                                            <i class="fa fa-star success font-large-2 float-right" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?= $this->Url->build(['controller' => 'questions', 'action' => 'index']); ?>">

                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body text-left">
                                            <h3 class="mb-1 success"><?= number_format($total_questions) ?></h3>
                                            <span> Questions</span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <!-- <i class="icon-user success font-large-2 float-right"></i> -->
                                            <i class="fa fa-question success font-large-2 float-right" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <!-- <a href="<?= $this->Url->build(['controller' => 'messages', 'action' => 'index']); ?>"> -->
                            <div class="px-3 py-3">
                                <div class="media">
                                    <div class="media-body text-left">
                                        <h3 class="mb-1 success"><?= number_format($total_answers) ?></h3>
                                        <span> Answers</span>
                                    </div>
                                    <div class="media-right align-self-center">
                                        <!-- <i class="icon-user success font-large-2 float-right"></i> -->
                                        <i class="fa fa-info success font-large-2 float-right" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- </a> -->
                        </div>
                    </div>
                </div>

            </div>
            <div class="row" matchHeight="card">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?= $this->Url->build(['controller' => 'businesses', 'action' => 'index']); ?>">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body text-left">
                                            <h3 class="mb-1 success"><?= number_format($businesses_count) ?></h3>
                                            <span> Businesses</span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <!-- <i class="icon-user success font-large-2 float-right"></i> -->
                                            <i class="ft-grid success font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <!-- <a href="<?= $this->Url->build(['controller' => 'messages', 'action' => 'index']); ?>"> -->
                            <div class="px-3 py-3">
                                <div class="media">
                                    <div class="media-body text-left">
                                        <h3 class="mb-1 success"><?= number_format($messages_count) ?></h3>
                                        <span>Messages</span>
                                    </div>
                                    <div class="media-right align-self-center">
                                        <!-- <i class="icon-user success font-large-2 float-right"></i> -->
                                        <i class="fa fa-comments success font-large-2 float-right" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- </a> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <!-- <a href="<?= $this->Url->build(['controller' => 'messages', 'action' => 'index']); ?>"> -->
                            <div class="px-3 py-3">
                                <div class="media">
                                    <div class="media-body text-left">
                                        <h3 class="mb-1 success"><?= number_format($helpful_reviews) ?></h3>
                                        <span>Helpful Reviews</span>
                                    </div>
                                    <div class="media-right align-self-center">
                                        <!-- <i class="icon-user success font-large-2 float-right"></i> -->
                                        <i class="fa fa-check success font-large-2 float-right" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- </a> -->
                        </div>
                    </div>
                </div>


            </div>
            <div class="row" matchHeight="card">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?= $this->Url->build(['controller' => 'subscriptions', 'action' => 'index']); ?>">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body text-left">
                                            <h3 class="mb-1 success">$<?= number_format($profit, 2) ?></h3>
                                            <span>Profit</span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <!-- <i class="icon-user success font-large-2 float-right"></i> -->
                                            <i class="fa fa-money success font-large-2 float-right" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?= $this->Url->build(['controller' => 'subscriptions', 'action' => 'index']); ?>">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body text-left">
                                            <h3 class="mb-1 success">$<?= number_format($subscription_payments, 2) ?></h3>
                                            <span> Payments Total</span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <!-- <i class="icon-user success font-large-2 float-right"></i> -->
                                            <i class="fa fa-money success font-large-2 float-right" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?= $this->Url->build(['controller' => 'subscriptions', 'action' => 'index']); ?>">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body text-left">
                                            <h3 class="mb-1 success">$<?= number_format($subscription_discounts, 2) ?></h3>
                                            <span>Discounts</span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <!-- <i class="icon-user success font-large-2 float-right"></i> -->
                                            <i class="fa fa-money success font-large-2 float-right" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>



</section>



<!-- BEGIN PAGE VENDOR JS-->
<!-- <script src="<?= $this->Url->build('/assets/', ['fullBase' => true]); ?>vendors/js/chartist.min.js" type="text/javascript"></script> -->
<!-- END PAGE VENDOR JS-->
<!-- BEGIN PAGE LEVEL JS-->
<!-- <script src="<?= $this->Url->build('/assets/', ['fullBase' => true]); ?>js/dashboard1.js" type="text/javascript"></script> -->
<!-- <script src="<?= $this->Url->build('/assets/', ['fullBase' => true]); ?>js/dashboard2.js" type="text/javascript"></script> -->
<!-- END PAGE LEVEL JS-->




<script type="text/javascript">
    $(function() {


        //"Y-m-d H:i:s"

        // var start = moment().subtract(29, 'days');
        // var end = moment();
        var label = "<?= !empty($label) ? $label : '' ?>";

        function getDateToShow(type) {

            if (type == "start") {
                if (label == "Today") {
                    return moment();
                }
                if (label == "Yesterday") {
                    return moment().subtract('days', 1);
                }
                if (label == "Last 7 Days") {
                    return moment().subtract('days', 6);
                }
                if (label == "Last 30 Days") {
                    return moment().subtract('days', 29);
                }
                if (label == "This Month") {
                    return moment().startOf('month');
                }
                if (label == "Last Month") {
                    return moment().subtract('month', 1).startOf('month');
                }
                <?php if (!empty($startDate)) : ?>
                    if (label == "Custom Range") {
                        var sDate = moment("<?= $startDate ?>");
                        return sDate;
                        // return sDate.format('MM/DD/YYYY');
                    }
                    if (label == "All Time") {
                        var sDate = moment("<?= $startDate ?>");
                        return sDate;
                        // return sDate.format('MM/DD/YYYY');
                    }
                <?php endif; ?>
                return moment("01/01/2017");
            }
            if (type == "end") {
                if (label == "Today") {
                    return moment();
                }
                if (label == "Yesterday") {
                    return moment().subtract('days', 1);
                }
                if (label == "Last 7 Days") {
                    return moment();
                }
                if (label == "Last 30 Days") {
                    return moment();
                }
                if (label == "This Month") {
                    return moment().endOf('month');
                }
                if (label == "Last Month") {
                    return moment().subtract('month', 1).endOf('month');
                }
                <?php if (!empty($endDate)) : ?>
                    if (label == "Custom Range") {
                        var eDate = moment("<?= $endDate ?>");
                        return eDate;
                        // return eDate.format('MM/DD/YYYY');
                    }
                    if (label == "All Time") {
                        var eDate = moment("<?= $endDate ?>");
                        return eDate;
                        // return eDate.format('MM/DD/YYYY');
                    }
                <?php endif; ?>
                return moment("01/01/2050");
            }
        }

        // var start = moment("<?= $startDate ?>").format('MM/DD/YYYY');
        // var end = moment("<?= $endDate ?>").format('MM/DD/YYYY');

        function cb(start, end, label) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $("input[name=startDate]").val(start.format("YYYY-MM-DD HH:mm:ss"));
            $("input[name=endDate]").val(end.format("YYYY-MM-DD HH:mm:ss"));
            $("input[name=label]").val(label);
            $("#momentForm").submit();
        }

        $('#reportrange').daterangepicker({
            startDate: getDateToShow("start"),
            endDate: getDateToShow("end"),
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);
        $('#reportrange span').html(getDateToShow("start").format('MMMM D, YYYY') + ' - ' + getDateToShow("end").format('MMMM D, YYYY'));

        // cb(getDateToShow("start"), getDateToShow("end"));

    });
</script>