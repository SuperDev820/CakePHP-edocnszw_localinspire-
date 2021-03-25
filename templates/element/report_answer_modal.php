<div id="reportanswerModal" class="js-modal-window u-modal-window" style="width: 500px;">
    <div class="card mb-9">
        <!-- Header -->
        <header class="bg-white mt-3 py-3 px-5">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h5 mb-0 bold">Report answer</h3>

                <button type="button" class="close text-dark" aria-label="Close" onclick="Custombox.modal.close();">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </header>
        <!-- End Header -->

        <div class="card-body">
            <form id="reportanswerform" class="js-validate" action="" method="POST">
                <div>

                    <div class="pl-3 pr-3 pb-3 small">
                        Please let us know why you think the content you're reporting violates our guidelines. Use the below forms to report any questionable or inappropriate answers.


                        <div class="bold mt-2">Why do you want to report this answer? </div>

                        <!-- Report Answer form -->

                        <div class="custom-control custom-radio d-flex align-items-center mt-1">
                            <input type="radio" class="custom-control-input mr-2" id="deliveryRadio11" value="It doesn’t answer the question asked" name="why">
                            <label class="custom-control-label ml-1" for="deliveryRadio11">
                                <span class="d-block mt-1 text-dark ml-2">It doesn’t answer the question asked</span>
                            </label>
                        </div>
                        <div class="custom-control custom-radio d-flex align-items-center">
                            <input type="radio" class="custom-control-input mr-2" id="deliveryRadio22" value="It contains threats, lewdness or hate speech" name="why">
                            <label class="custom-control-label ml-1" for="deliveryRadio22">
                                <span class="d-block text-dark mt-1 ml-2">It contains threats, lewdness or hate speech</span>
                            </label>
                        </div>
                        <div class="custom-control custom-radio d-flex align-items-center">
                            <input type="radio" class="custom-control-input mr-2" id="deliveryRadio33" value="It violates Local Inspire's privacy standards" name="why">
                            <label class="custom-control-label ml-1" for="deliveryRadio33">
                                <span class="d-block text-dark mt-1 ml-2">It violates Local Inspire's privacy standards</span>
                            </label>
                        </div>
                        <div class="custom-control custom-radio d-flex align-items-center">
                            <input type="radio" class="custom-control-input mr-2" id="deliveryRadio44" value="It contains promotional material" name="why">
                            <label class="custom-control-label ml-1" for="deliveryRadio44">
                                <span class="d-block text-dark mt-1 ml-2">It contains promotional material</span>
                            </label>
                        </div>
                        <div class="custom-control custom-radio d-flex align-items-center">
                            <input type="radio" class="custom-control-input border mr-2" id="deliveryRadio55" value="It is spam" name="why">
                            <label class="custom-control-label ml-1" for="deliveryRadio55">
                                <span class="d-block text-dark mt-1 ml-2">It is spam</span>
                            </label>
                        </div>
                        <div class="custom-control custom-radio d-flex align-items-center">
                            <input type="radio" class="custom-control-input border mr-2" id="deliveryRadio66" value="I want to report something else" name="why">
                            <label class="custom-control-label ml-1" for="deliveryRadio66">
                                <span class="d-block text-dark mt-1 ml-2">I want to report something else</span>
                            </label>
                        </div>
                    </div>

                    <!-- Input -->
                    <div class="form-group pl-4 pr-4 mb-4 small">
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

                    <!-- End Report Answer Form -->
                    <input type="hidden" name="answer_id" value="">

                </div>

                <!-- Buttons -->
                <div class="d-flex pl-4">
                    <button type="submit" class="btn btn-sm btn-primary mr-1" data-next-step="#paymentDetailsStep">Report</button>
                    <button type="button" class="btn btn-sm btn-soft-secondary" onclick="Custombox.modal.close();">Cancel</button>
                </div>
                <!-- End Buttons -->
            </form>
        </div>
    </div>
</div>