<div id="reportquestionModal" class="js-modal-window u-modal-window" style="width: 500px;">
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
            <form id="reportquestionform" class="js-validate" action="" method="POST">
                <div class="pl-3 pr-3 pb-3 small">
                    Please let us know why you think the content you're reporting violates our guidelines. Use the below forms to report any questionable or inappropriate questions.

                    <div class="bold mt-2">Why do you want to report this question? </div>
                    <!-- Delivery -->
                    <div class="custom-control custom-radio d-flex align-items-center mt-1">
                        <input type="radio" class="custom-control-input border mr-2" id="questionRadio1" value="It's not a question" name="why">
                        <label class="custom-control-label ml-1" for="questionRadio1">
                            <span class="d-block text-dark mt-1 ml-2">It's not a question</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input mr-2" id="questionRadio2" value="It's a duplicate" name="why">
                        <label class="custom-control-label ml-1" for="questionRadio2">
                            <span class="d-block text-dark mt-1 ml-2">It's a duplicate</span>
                        </label>
                    </div>

                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input mr-2" id="questionRadio3" value="It isn't helpful" name="why">
                        <label class="custom-control-label ml-1" for="questionRadio3">
                            <span class="d-block text-dark mt-1 ml-2">It isn't helpful</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input mr-2" id="questionRadio4" value="Contains threats, lewdness, or hate speach" name="why">
                        <label class="custom-control-label ml-1" for="questionRadio4">
                            <span class="d-block text-dark mt-1 ml-2">Contains threats, lewdness, or hate speach</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input border mr-2" id="questionRadio5" value="Review is spam" name="why">
                        <label class="custom-control-label ml-1" for="questionRadio5">
                            <span class="d-block text-dark mt-1 ml-2">It's not specific to this business</span>
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
                <input type="hidden" name="question_id" value="">
                <!-- Buttons -->
                <div class="d-flex pl-4">
                    <button style="font-size:14px" type="submit" class="btn btn-primary mr-1 bold small" data-next-step="#paymentDetailsStep">Submit</button> <button type="button" class="btn btn-sm btn-soft-secondary" onclick="Custombox.modal.close();">Cancel</button>

                </div>
                <!-- End Buttons -->
            </form>
        </div>
    </div>
</div>