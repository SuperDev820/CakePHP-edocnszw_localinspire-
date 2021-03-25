<div id="reportownerModal" class="js-modal-window u-modal-window" style="width: 575px;">
    <div class="card mb-9">
        <!-- Header -->
        <header class="bg-white mt-3 py-3 px-5">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h6 bold mb-0"><i class="fas fa-flag mr-1"></i> Report a problem</h3>

                <button type="button" class="close text-darker" aria-label="Close" onclick="Custombox.modal.close();">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </header>
        <!-- End Header -->

        <div class="card-body">
            <form id="reportownerform" class="js-validate" method="POST" action="">
                 <div class="pl-3 pr-3 pb-3 small">
                    Please let us know why you think the content you're reporting violates our guidelines. Use the below forms to report any questionable or inappropriate owner reply.
                </div>
                <!-- Input -->
                <div class="form-group pl-3 pr-3 mb-4 small">
                    <label for="exampleSelect1">Please provide specific details below: </label>
                    <!-- Input -->
                    <div class="js-form-message">
                        <div class="input-group">
                            <textarea class="form-control" rows="4" name="description" placeholder="Please provide specific details." aria-label="Please provide specific details." required data-msg="Please provide specific details." data-error-class="u-has-error" data-success-class="u-has-success"></textarea>

                        </div>
                        <!-- End Input -->
                    </div>
                    <!-- End Input -->
                </div>

                <!-- End Report Review Form -->
                <input type="hidden" name="review_id" value="">

                <!-- Buttons -->
                <div class="d-flex pl-4">
                    <button type="submit" class="btn btn-smsq bold btn-primary mr-1" data-next-step="#paymentDetailsStep">Submit</button>

                </div>
                <!-- End Buttons -->
            </form>
        </div>
    </div>
</div>