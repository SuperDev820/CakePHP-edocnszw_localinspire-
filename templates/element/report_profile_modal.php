<div id="reportprofileModal" class="js-modal-window u-modal-window" style="width: 600px;">
    <div class="card">
        <form class="js-validate" id="reportprofile" action="" method="post">
            <!-- Login -->
            <div data-target-group="idForm">
                <!-- Header -->
                <header class="bg-white mt-3 py-3 px-5">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="h5 mb-0 bold"><i class="fas fa-flag mr-1"></i> Report a problem</h3>

                        <button type="button" class="close text-darker" aria-label="Close" onclick="Custombox.modal.close();">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </header>
                <!-- End Header -->
                <input type="hidden" name="profile_id" value="" />
                <div class="card-body p-5">
                    <div class="js-form-message mb-4">
                        <label class="bold small">
                            Please let us know what's inappropriate about this profile:
                        </label> <br><span class="text-secondary font-weight-normal font-size-10">(e.g. headline, about me, profile photo, spammer, etc.) </span>

                        <textarea class="form-control" rows="4" name="description" placeholder="" aria-label="" required data-msg="Please enter a message." data-error-class="u-has-error" data-success-class="u-has-success"></textarea>
                    </div>
                    <!-- End Input -->

                    <div class="text-center">
                        <div class="mb-2">
                            <button type="submit" class="btn btn-smsq bold btn-primary">Report Profile</button> <button type="button" class="btn btn-sm btn-soft-secondary" onclick="Custombox.modal.close();">Cancel</button>
                        </div>
                        <p class="small">We will examine this report as quickly as possible..</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>