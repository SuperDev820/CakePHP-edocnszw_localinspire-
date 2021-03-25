<div id="sendmessageModal" class="js-modal-window u-modal-window" style="width: 575px;">
    <div class="card mb-9">
        <!-- Header -->
         <header class="bg-white mt-3 py-3 px-5">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h5 mb-0 bold"><i class="fas fa-envelope mr-1"></i> Send <span class="messagereceiver"></span> a message</h3>

                <button type="button" class="close text-darker" aria-label="Close" onclick="Custombox.modal.close();">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </header>
        <!-- End Header -->

        <div class="card-body">
            <form class="js-validate" id="sendmessageform" action="" method="post">
                <!-- Input -->
                <!-- <div class="js-form-message mb-4">
                    <label class="bold small">
                        Subject
                        <span class="text-danger">*</span>
                    </label>

                    <input type="text" class="form-control" name="subject" placeholder="Enter subject" aria-label="Enter subject" required data-msg="Please enter a subject." data-error-class="u-has-error" data-success-class="u-has-success">
                </div> -->
                <!-- End Input -->
                <input type="hidden" id="messagereceiverid" name="receiver_id">
                <!-- Input -->
                <div class="js-form-message mb-4">
                    <label class="bold small">
                        Message
                        <span class="text-danger">*</span>
                    </label>

                    <textarea class="form-control" rows="4" name="body" placeholder="Hi there, what is the ..." aria-label="Hi there, what is the ..." required data-msg="Please enter a message." data-error-class="u-has-error" data-success-class="u-has-success"></textarea>
                </div>
                <!-- End Input -->

                <div class="text-center">
                    <div class="mb-2">
                        <button type="submit" class="btn btn-smsq bold btn-primary">Send Message</button>
                    </div>
                    <p class="small">Please give <span class="messagereceiver"></span> some time to get back to you.</p>
                </div>
                <!-- End Hire Us Form -->

            </form>
        </div>
    </div>
</div>