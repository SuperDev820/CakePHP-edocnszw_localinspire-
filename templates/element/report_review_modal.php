<div id="reportreviewModal" class="js-modal-window u-modal-window" style="width: 500px;">
    <div class="card mb-9">
        <!-- Header -->
        <header class="bg-white mt-3 py-3 px-5">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h5 bold mb-0">Report a problem</h3>

                <button type="button" class="close text-darker" aria-label="Close" onclick="Custombox.modal.close();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </header>
        <!-- End Header -->

        <div class="card-body">
            <form id="reportreviewform" class="js-validate" action="" method="POST">
                <div class="pl-3 pr-3 pb-3 small">
                    Please let us know why you think the content you're reporting violates our guidelines. Use the below forms to report any questionable or inappropriate reviews.

                    <div class="bold mt-2">Why do you want to report this review? </div>
                    <!-- Delivery -->
                    <div class="custom-control custom-radio d-flex align-items-center mt-1">
                        <input type="radio" class="custom-control-input border mr-2" id="deliveryRadio7" value="Review contains false information" name="why">
                        <label class="custom-control-label ml-1" for="deliveryRadio7">
                            <span class="d-block text-dark mt-1 ml-2">Review contains false information</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input mr-2" id="deliveryRadio8" value="Review violates guidelines" name="why">
                        <label class="custom-control-label ml-1" for="deliveryRadio8">
                            <span class="d-block text-dark mt-1 ml-2">Review violates guidelines</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input mr-2" id="deliveryRadio3" value="Contains threats, lewdness, or hate speach" name="why">
                        <label class="custom-control-label ml-1" for="deliveryRadio3">
                            <span class="d-block text-dark mt-1 ml-2">Contains threats, lewdness, or hate speach</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input mr-2" id="deliveryRadio4" value="Review posted to wrong location" name="why">
                        <label class="custom-control-label ml-1" for="deliveryRadio4">
                            <span class="d-block text-dark mt-1 ml-2">Review posted to wrong location</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input border mr-2" id="deliveryRadio5" value="Review is spam" name="why">
                        <label class="custom-control-label ml-1" for="deliveryRadio5">
                            <span class="d-block text-dark mt-1 ml-2">Review is spam</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input border mr-2" id="deliveryRadio6" value="I want to report something else" name="why">
                        <label class="custom-control-label ml-1" for="deliveryRadio6">
                            <span class="d-block text-dark mt-1 ml-2">I want to report something else</span>
                        </label>
                    </div>


                </div>

                <!-- Input -->
                <div class="form-group pl-4 pr-4 mb-4 bold small">
                    <label for="exampleSelect1">Please provide specific details below: </label>
                    <!-- Input -->
                    <div class="js-form-message">
                        <div class="input-group">
                            <textarea class="form-control" rows="4" name="specific_detail" placeholder="Please provide specific details." aria-label="Please provide specific details." required data-msg="Please provide specific details." data-error-class="u-has-error" data-success-class="u-has-success"></textarea>

                        </div>
                        <!-- End Input -->
                    </div>
                    <!-- End Input -->
                </div>

                <!-- End Report Review Form -->
                <input type="hidden" name="review_id" value="">
                <input type="hidden" name="business_id" value="">

                <!-- Buttons -->
                <div class="d-flex pl-4">
                    <button style="font-size:14px" type="submit" class="btn btn-primary mr-1 bold small" data-next-step="#paymentDetailsStep">Submit</button> <button type="button" class="btn btn-sm btn-soft-secondary" onclick="Custombox.modal.close();">Cancel</button>

                </div>
                <!-- End Buttons -->
            </form>
        </div>
    </div>
</div>