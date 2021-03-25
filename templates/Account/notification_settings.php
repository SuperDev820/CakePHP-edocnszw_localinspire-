<?php $this->assign('title', 'Notification'); ?>
<!-- Content Section -->
<div class="bg-light">
    <main>
        <div class="container space-2">
            <?= $this->element('accountsidenav') ?>

            <div class="card p-5">

                <!-- My Network -->
                <div class="mb-3">
                    <!-- Title -->
                    <div class="row justify-content-between align-items-end">
                        <div class="col-6 txt-14">
                            <h2 class="h5 bold mb-0">Email Accounts</h2> Merge accounts, remove accounts, and change your primary account.
                        </div>
                        <div class="col-6 text-right">
                            <a class="btn btn-primary btn-sm" href="#addemailModal" data-modal-target="#addemailModal">Add Email</a>
                        </div>
                    </div>
                    <!-- End Title -->
                    <!-- Request Add Email Modal Window -->
                    <div id="addemailModal" class="js-modal-window u-modal-window" style="width: 500px;">
                        <?php echo $this->Form->create(null, ['class' => '', 'enctype' => 'multipart/form-data', 'url' => ['prefix'=>false,'controller' => 'account', 'action' => 'addEmail']]) ?>
                        <div class="card mb-9">
                            <!-- Header -->
                            <header class="bg-white mt-3 py-3 px-5">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="h5 bold mb-0">Add a new email account</h3>

                                    <button type="button" class="close text-dark" aria-label="Close" onclick="Custombox.modal.close();">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            </header>
                            <!-- End Header -->

                            <div class="card-body p-5 txt-14 bg-white">

                                Please enter the email below that you wish to add. An email will be sent to confirm this email.
                                <!-- Add Members -->
                                <div class="mt-3 mb-4">
                                    <!-- <input class="form-control" type="email" placeholder="Current localinspire password" aria-label="Current password"> -->
                                    <?= $this->Form->control('password', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Current localinspire password', "type" => "password", "required"]) ?>
                                </div>
                                <!-- End Add Members -->
                                <!-- Add Members -->
                                <div class="mt-3 mb-4">
                                    <!-- <input class="form-control" type="email" placeholder="Enter email" aria-label="Enter email"> -->
                                    <?= $this->Form->control('email', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Enter email', "type" => "email", "required"]) ?>
                                </div>
                                <!-- End Add Members -->


                                <!-- Buttons -->
                                <div class="d-flex justify-content-end">
                                    <!-- <button type="submit" class="btn btn-sm btn-primary mr-1">Add email</button> -->
                                    <?= $this->Form->button(__('Add email'), ['class' => 'btn btn-sm btn-primary mr-1'], ['escape' => false]); ?>
                                    <button type="button" class="btn btn-sm btn-soft-secondary mr-1" aria-label="Close" onclick="Custombox.modal.close();">Cancel</button>
                                </div>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>

                <!-- End Add Email Form -->



                <hr class="mt-2 mb-4">

                <div class="mb-3">
                    <h6 class="text-dark bold">Email addresses</h6>
                </div>

                <!-- Checkbox Switch -->
                <div class="media align-items-center mb-3">

                    <label class="media-body text-muted mb-0">
                        <span class="d-block text-dark txt-14"><?= $currentUser->email ?> - Primary email</span>
                        <small class="d-block">Primary email for your account.</small>
                    </label>
                </div>
                <!-- End Checkbox Switch -->

                <!-- Checkbox Switch -->
                <?php foreach ($userEmails as $key => $userEmail) { ?>
                    <?php if ($userEmail->email != $currentUser->email) { ?>
                        <div class="media align-items-center mb-2">
                            <label class="media-body text-muted mb-0" for="checkboxSwitch1">
                                <span class="d-block txt-14 text-dark"><?= $userEmail->email ?>
                                    <!-- <a href="javascript:;" class="resend_confirmation_email" data-id="<?= $userEmail->id ?>">Resend confirmation email</a> -->
                                </span>
                                <small class="d-block">Secondary email for your account.</small>
                            </label>
                            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                <button type="button" class="btn btn-sm btn-secondary secondary_email_action resend_confirmation_email" data-id="<?= $userEmail->id ?>">Resend confirmation email</button>
                                <a class="btn btn-sm btn-primary secondary_email_action" href="<?= $this->Url->build(['action' => 'setPrimaryEmail', $userEmail->id]); ?>"><i class="far fa-check-circle"></i> Make Primary</a>

                                <a href="<?= $this->Url->build(['action' => 'deleteEmail', $userEmail->id]); ?>" onclick="return confirm('Are you sure?')" class="btn-danger btn-sm btn btn-secondary secondary_email_action"><i class="far fa-trash-alt"></i> Delete Email</a>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
                <!-- End Checkbox Switch -->



                <!-- Personal Info Form -->
                <form class="js-validate">
                    <div class="row">
                        <!-- Input -->
                        <div class="col-sm-8 mt-6 mb-0">
                            <div class="js-form-message">
                                <div class="form-group txt-14">
                                    If you signed up with either facebook or Google you may have two accounts? You can merge any accounts you have so that you can sign in from any email you have and will only have one account.
                                </div>
                            </div>
                        </div>
                        <!-- End Input -->

                        <!-- Input -->
                        <div class="col-sm-4 mt-6 mb-0">
                            <div class="js-form-message">
                                <div class="form-group">
                                    <span class="d-block text-dark">
                                        <a class="btn btn-light btn-sm" href="#mergeaccountsModal" data-modal-target="#mergeaccountsModal">
                                            <i class="fas fa-sync"></i> &nbsp; Merge Accounts
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End Input -->
                    </div>

                </form>
                <!-- Request Merge Account Modal Window -->
                <div id="mergeaccountsModal" class="js-modal-window u-modal-window" style="width: 500px;">
                    <?php echo $this->Form->create(null, ['class' => '', 'enctype' => 'multipart/form-data', 'url' => ['prefix'=>false,'controller' => 'account', 'action' => 'requestMerge']]) ?>
                    <div class="card mb-9">
                        <!-- Header -->
                        <header class="bg-white mt-3 py-3 px-5">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="h5 bold mb-0">Merge accounts</h3>

                                <button type="button" class="close text-darker" aria-label="Close" onclick="Custombox.modal.close();">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        </header>
                        <!-- End Header -->

                        <div class="card-body p-5 txt-14 bg-white">
                            <!-- Merge Account Form -->
                            <!-- <form class="js-validate js-step-form" data-progress-id="#progressStepForm" data-steps-id="#contentStepForm" novalidate="novalidate"> -->

                            <div id="recentPayersList" data-target-group="idAddNewPayer">
                                Your email for this account is: <b><?= $currentUser->email ?></b><br><br>

                                Please enter the email below that you wish to merge with this account. An email will be sent to confirm this merge.

                                <!-- Add Members -->
                                <div class="mt-3 mb-4">
                                    <?= $this->Form->control('email', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Enter email', "type" => "email", "required"]) ?>
                                </div>
                                <!-- End Add Members -->


                            </div>
                            <!-- Buttons -->
                            <div class="d-flex justify-content-end">
                                <?= $this->Form->button(__('Request Merge'), ['class' => 'btn btn-sm btn-primary mr-1'], ['escape' => false]); ?>
                                <button type="button" class="btn btn-sm btn-soft-secondary mr-1" aria-label="Close" onclick="Custombox.modal.close();">Cancel</button>
                            </div>
                            <!-- End Buttons -->

                        </div>
                        <!-- End Merge Accounts Form -->


                    </div>
                    <?= $this->Form->end() ?>

                </div>
                <!-- End Add Email Modal Window -->


                <!-- End My Network -->
                <hr class="mb-3">

                <!-- Account Activity -->
                <div class="mb-4">
                    <!-- Title -->
                    <div class="row justify-content-between align-items-end">
                        <div class="col-6 txt-14">
                            <h2 class="h5 bold mb-0">Notification Settings</h2>
                            Manage what emails are sent to <?= $currentUser->email ?>
                        </div>
                        <div class="col-6 text-right">
                            <!-- <a id="toggleAll2" class="js-toggle-state link-muted" href="javascript:;" data-target="#checkboxSwitch5, #checkboxSwitch6, #checkboxSwitch7, #checkboxSwitch8, #checkboxSwitch9">
                                <span class="link-muted__toggle-default">Toggle all</span>
                                <span class="link-muted__toggle-toggled">Untoggle all</span>
                            </a> -->

                            <!-- <a class="js-toggle-state btn btn-sm btn-soft-white transition-3d-hover" href="javascript:;" data-target="#messages_notification, #follows_notification, #answers_notification">
                                <span class="btn__toggle-default">Toggle all</span>
                                <span class="btn__toggle-toggled">Untoggle all</span>
                            </a> -->
                        </div>
                    </div>
                    <!-- End Title -->

                    <hr class="mb-3">

                    <div class="mb-3">
                        <h3 class="small text-muted">Email me when:</h3>
                    </div>

                    <!-- Checkbox Switch -->
                    <div class="media align-items-center mb-3">
                        <label class="checkbox-switch mb-0 mr-3">
                            <input type="checkbox" class="checkbox-switch__input" id="messages_notification" <?= $notification_settings->messages ? " checked" : "" ?>>
                            <span class="checkbox-switch__slider"></span>
                        </label>
                        <label class="media-body text-muted mb-0" for="messages_notification">
                            <span class="d-block text-dark txt-14">Someone messages me</span>
                        </label>
                    </div>
                    <!-- End Checkbox Switch -->

                    <!-- Checkbox Switch -->
                    <div class="media align-items-center mb-3">
                        <label class="checkbox-switch mb-0 mr-3">
                            <input type="checkbox" class="checkbox-switch__input" id="follows_notification" <?= $notification_settings->follows ? " checked" : "" ?>>
                            <span class="checkbox-switch__slider"></span>
                        </label>
                        <label class="media-body text-muted mb-0" for="follows_notification">
                            <span class="d-block text-dark txt-14">Someone follows me</span>
                        </label>
                    </div>
                    <!-- End Checkbox Switch -->

                    <!-- Checkbox Switch -->
                    <div class="media align-items-center mb-3">
                        <label class="checkbox-switch mb-0 mr-3">
                            <input type="checkbox" class="checkbox-switch__input" id="answers_notification" <?= $notification_settings->answers ? " checked" : "" ?>>
                            <span class="checkbox-switch__slider"></span>
                        </label>
                        <label class="media-body text-muted mb-0" for="answers_notification">
                            <span class="d-block text-dark txt-14">My questions receive answers</span>
                        </label>
                    </div>
                    <!-- End Checkbox Switch -->

                    <!-- Checkbox Switch -->
                    <div class="media align-items-center mb-3">
                        <label class="checkbox-switch mb-0 mr-3">
                            <input type="checkbox" class="checkbox-switch__input" id="photo_activity_notification" <?= $notification_settings->photo_activity ? " checked" : "" ?>>
                            <span class="checkbox-switch__slider"></span>
                        </label>
                        <label class="media-body text-muted mb-0" for="photo_activity_notification">
                            <span class="d-block text-dark txt-14">Activity on my photos</span>
                        </label>
                    </div>
                    <!-- End Checkbox Switch -->

                    <!-- Checkbox Switch -->
                    <div class="media align-items-center mb-3">
                        <label class="checkbox-switch mb-0 mr-3">
                            <input type="checkbox" class="checkbox-switch__input" id="review_activity_notification" <?= $notification_settings->review_activity ? " checked" : "" ?>>
                            <span class="checkbox-switch__slider"></span>
                        </label>
                        <label class="media-body text-muted mb-0" for="review_activity_notification">
                            <span class="d-block text-dark txt-14">Activity on my reviews</span>
                        </label>
                    </div>
                    <!-- End Checkbox Switch -->

                    <!-- Checkbox Switch -->
                    <!-- <div class="media align-items-center mb-3">
                        <label class="checkbox-switch mb-0 mr-3">
                            <input type="checkbox" class="checkbox-switch__input" id="checkboxSwitch8" checked>
                            <span class="checkbox-switch__slider"></span>
                        </label>
                        <label class="media-body text-muted mb-0" for="checkboxSwitch8">
                            <span class="d-block text-dark">Public replies to my reviews by the business owner</span>
                        </label>
                    </div> -->
                    <!-- End Checkbox Switch -->

                    <!-- Checkbox Switch -->
                    <!-- <div class="media align-items-center mb-3">
                        <label class="checkbox-switch mb-0 mr-3">
                            <input type="checkbox" class="checkbox-switch__input" id="checkboxSwitch9">
                            <span class="checkbox-switch__slider"></span>
                        </label>
                        <label class="media-body text-muted mb-0" for="checkboxSwitch9">
                            <span class="d-block text-dark">Private messages from a business owner about my review</span>
                        </label>
                    </div> -->
                    <!-- End Checkbox Switch -->

                    <!-- Checkbox Switch -->
                    <div class="media align-items-center mb-3">
                        <label class="checkbox-switch mb-0 mr-3">
                            <input type="checkbox" class="checkbox-switch__input" id="business_edits_notification" <?= $notification_settings->business_edits ? " checked" : "" ?>>
                            <span class="checkbox-switch__slider"></span>
                        </label>
                        <label class="media-body text-muted mb-0" for="business_edits_notification">
                            <span class="d-block text-dark txt-14">Status of business info edits</span>
                        </label>
                    </div>
                    <!-- End Checkbox Switch -->



                    <!-- <button type="submit" class="btn btn-primary ">Update Email Notifications</button> -->

                </div>
                <!-- End Account Activity -->

            </div>
        </div>
    </main>
</div>
<!-- End Merge Accounts Modal Window -->
<script>
    $(document).ready(function() {

        // $.SRCore.components.SRToggleState.init('.js-toggle-state');

        jQuery(document).on('change', 'input[id=messages_notification]', function() {
            if ($(this).is(':checked')) {
                var status = 1;
            } else {
                var status = 0;
            }

            updateNotificationOptions({
                messages: status
            });

        })

        jQuery(document).on('change', 'input[id=follows_notification]', function() {
            if ($(this).is(':checked')) {
                var status = 1;
            } else {
                var status = 0;
            }

            updateNotificationOptions({
                follows: status
            });

        })

        jQuery(document).on('change', 'input[id=answers_notification]', function() {
            if ($(this).is(':checked')) {
                var status = 1;
            } else {
                var status = 0;
            }

            updateNotificationOptions({
                answers: status
            });
        })

        jQuery(document).on('change', 'input[id=photo_activity_notification]', function() {
            if ($(this).is(':checked')) {
                var status = 1;
            } else {
                var status = 0;
            }

            updateNotificationOptions({
                photo_activity: status
            });
        })

        jQuery(document).on('change', 'input[id=review_activity_notification]', function() {
            if ($(this).is(':checked')) {
                var status = 1;
            } else {
                var status = 0;
            }
            updateNotificationOptions({
                review_activity: status
            });
        })

        jQuery(document).on('change', 'input[id=business_edits_notification]', function() {
            if ($(this).is(':checked')) {
                var status = 1;
            } else {
                var status = 0;
            }
            updateNotificationOptions({
                business_edits: status
            });
        })



    })
</script>