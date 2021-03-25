<?php $this->assign('title', 'Earnings - City Manager'); ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<!-- Content Section -->
<div class="bg-light">
    <main>
        <div class="container space-2">
            <!-- Sidebar Info -->
            <div class="row">
                <div class="col-lg-3 mb-9 mb-lg-0">
                    <?= $this->element('city_sidebar'); ?>
                </div>
                <!-- End Sidebar Info -->
                <div class="col-lg-9 mb-9 mb-lg-0">

                    <div class="card p-5">

                        <?= $this->element('city_title', ['city_title' => 'Earnings']) ?>
                        <!-- Project Title -->

                        <p class="">You have access to simple, yet powerful tools and insights that can help you manage your city, analyze your city performance, monitor income and much more.

                        </p>

                        <hr>


                        <!-- Features Section -->
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-md-4 text-right">
                                    <h3><?= !empty($label) ? $label : 'All Time' ?>:</h3>
                                    <?= $this->Form->create(null, ['class' => 'form-horizontal', 'id' => 'momentForm']) ?>
                                    <?= $this->Form->hidden('startDate', ['value' => !empty($startDate) ? $startDate : '']); ?>
                                    <?= $this->Form->hidden('endDate', ['value' => !empty($endDate) ? $endDate : '']); ?>
                                    <?= $this->Form->hidden('label', ['value' => !empty($label) ? $label : '']); ?>
                                    <?= $this->Form->end() ?>
                                </div>
                                <div class="col-md-7">
                                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <span></span> <i class="fa fa-caret-down"></i>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <h4>Current City</h4>
                                <div class="col-md-12">
                                    <div class="card-deck d-block d-lg-flex card-lg-gutters-3 mb-6">
                                        <!-- Card -->
                                        <div class="card mb-3 mb-lg-0">
                                            <div class="card-body p-5">
                                                <div class="media align-items-center">
                                                    <span class="btn btn-lg btn-icon btn-soft-primary rounded-circle mr-4">
                                                        <span class="fas fa-dollar-sign btn-icon__inner"></span>
                                                    </span>
                                                    <div class="media-body">
                                                        <span class="d-block font-size-3">$<?= number_format($earnings, 2) ?></span>
                                                        <!-- <h2 class="h6 text-secondary font-weight-normal mb-0">Available balance</h2> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Card -->

                                         <!-- Card -->
                                        <div class="card mb-3 mb-lg-0">
                                            <div class="card-body p-5">
                                                <div class="media align-items-center">
                                                    <span class="btn btn-lg btn-icon btn-soft-success rounded-circle mr-4">
                                                       <i class="fas fa-building btn-icon__inner"></i>
                                                    </span>
                                                    <div class="media-body">
                                                        <span class="d-block font-size-3"><?= number_format($businesses_count) ?></span>
                                                        <h3 class="txt-12 text-secondary font-weight-normal mb-0">New Business(es)</span>
                                                        <!-- <h2 class="h6 text-secondary font-weight-normal mb-0">Available balance</h2> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Card -->

                                        <!-- Card -->
                                        <div class="card">
                                            <div class="card-body p-5">
                                                <div class="media align-items-center">
                                                    <span class="btn btn-lg btn-icon btn-soft-warning rounded-circle mr-4"><i class="far fa-address-card btn-icon__inner"></i>
                                                        
                                                    </span>
                                                    <div class="media-body">
                                                        <span class="d-block font-size-3"><?= number_format($subscription_count) ?></span>
                                                        <h3 class="txt-12 text-secondary font-weight-normal mb-0">Subscriptions</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Card -->
                                    </div>
                                </div>
                                <h4>All cities you manage</h4>
                                <div class="col-md-12">
                                    <!-- Stats -->
                                    <div class="card-deck d-block d-lg-flex card-lg-gutters-3 mb-6">
                                        <!-- Card -->
                                        <div class="card mb-3 mb-lg-0">
                                            <div class="card-body p-5">
                                                <div class="media align-items-center">
                                                    <span class="btn btn-lg btn-icon btn-soft-primary rounded-circle mr-4">
                                                        <span class="fas fa-dollar-sign btn-icon__inner"></span>
                                                    </span>
                                                    <div class="media-body">
                                                        <span class="d-block font-size-3">$<?= number_format($earnings_user_cities, 2) ?></span>
                                                        <!-- <h2 class="h6 text-secondary font-weight-normal mb-0">Available balance</h2> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Card -->

                                        <!-- Card -->
                                        <div class="card mb-3 mb-lg-0">
                                            <div class="card-body p-5">
                                                <div class="media align-items-center">
                                                    <span class="btn btn-lg btn-icon btn-soft-success rounded-circle mr-4">
                                                        <i class="fas fa-building btn-icon__inner"></i>
                                                    </span>
                                                    <div class="media-body">
                                                        <span class="d-block font-size-3"><?= number_format($biz_count_user_cities) ?></span>
                                                        <h3 class="txt-12 text-secondary font-weight-normal mb-0">New Business(es)</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Card -->

                                        <!-- Card -->
                                        <div class="card">
                                            <div class="card-body p-5">
                                                <div class="media align-items-center">
                                                    <span class="btn btn-lg btn-icon btn-soft-warning rounded-circle mr-4">
                                                        <i class="far fa-address-card btn-icon__inner"></i>
                                                    </span>
                                                    <div class="media-body">
                                                        <span class="d-block font-size-3"><?= number_format($sub_count_user_cities) ?></span>
                                                        <h3 class="txt-12 text-secondary font-weight-normal mb-0">Subscription(s)</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Card -->
                                    </div>
                                    <!-- End Stats -->
                                </div>
                            </div>
                        </div>
                        <!-- End Features Section -->

                    </div>
                </div>
            </div>
        </div>
        <!-- End Content Section -->
    </main>
    <!-- ========== END MAIN ========== -->

    <!-- ========== SECONDARY CONTENTS ========== -->


    <!-- Request Payment Modal Window -->

    <?= $this->element('request_payment_modal') ?>
    <!-- End Request Payment Modal Window -->

</div>
<script>
    $(document).ready(function() {

        // jQuery(document).on('change', '#active_city_select', function(e) {
        //     var city_id = $(this).select2('val');
        //     url = "<?= $this->Url->build(['controller' => 'manager', 'action' => 'switch']); ?>";
        //     url = updateQueryString('city_id', city_id, url);
        //     window.location.href = url;

        // });


    });
</script>

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