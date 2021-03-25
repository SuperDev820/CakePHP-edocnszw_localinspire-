<div id="reportphotoModal" class="js-modal-window u-modal-window" style="width: 500px;">
    <div class="card mt-3 ">
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
            <form id="reportphotoform" class="js-validate" action="" method="POST">
                <div class="pl-3 pr-3 pb-3 small">
                    Please let us know why you think the content you're reporting violates our guidelines. Use the below forms to report any questionable or inappropriate photos.

                    <div class="bold mt-2">Why do you want to report this photo? </div>
                    <!-- Delivery -->
                    <div class="custom-control custom-radio d-flex align-items-center mt-1">
                        <input type="radio" class="custom-control-input border mr-2" id="photoreportRadio1" value="It's inappropriate, sexually explicit or contains violent imagery" name="why">
                        <label class="custom-control-label ml-1" for="photoreportRadio1">
                            <span class="d-block text-dark mt-1 ml-2">It's inappropriate, sexually explicit or contains violent imagery</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input mr-2" id="photoreportRadio2" value="Low quality" name="why">
                        <label class="custom-control-label ml-1" for="photoreportRadio2">
                            <span class="d-block text-dark mt-1 ml-2">Low quality</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input border mr-2" id="photoreportRadio3" value="Duplicate" name="why">
                        <label class="custom-control-label ml-1" for="photoreportRadio3">
                            <span class="d-block text-dark mt-1 ml-2">Duplicate</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input mr-2" id="photoreportRadio4" value="It's posted to the wrong business" name="why">
                        <label class="custom-control-label ml-1" for="photoreportRadio4">
                            <span class="d-block text-dark mt-1 ml-2">It's posted to the wrong business</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input mr-2" id="photoreportRadio5" value="It's a violation of copyright" name="why">
                        <label class="custom-control-label ml-1" for="photoreportRadio5">
                            <span class="d-block text-dark mt-1 ml-2">It's a violation of copyright</span>
                        </label>
                    </div>

                    <div class="custom-control custom-radio d-flex align-items-center">
                        <input type="radio" class="custom-control-input border mr-2" id="photoreportRadio6" value="I want to report something else" name="why">
                        <label class="custom-control-label ml-1" for="photoreportRadio6">
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
                            <textarea class="form-control" rows="4" name="specific_detail" placeholder="Please provide specific details." aria-label="Please provide specific details." required data-msg="Please provide specific details." specific_detail data-error-class="u-has-error" data-success-class="u-has-success"></textarea>

                        </div>
                        <!-- End Input -->
                    </div>
                    <!-- End Input -->
                </div>

                <!-- End Report Review Form -->
                <input type="hidden" name="photo_id" value="">
                <input type="hidden" name="is_review_photo" value="">

                <!-- Buttons -->
                <div class="d-flex pl-4">
                    <button style="font-size:14px" type="submit" class="btn btn-primary mr-1 bold small" data-next-step="#paymentDetailsStep">Submit</button> <button type="button" class="btn btn-sm btn-soft-secondary" onclick="Custombox.modal.close();">Cancel</button>

                </div>
                <!-- End Buttons -->
            </form>
        </div>
    </div>
</div>