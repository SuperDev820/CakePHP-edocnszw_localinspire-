<?php $this->assign('title', 'User Settings'); ?>
<style>
    
</style>
<!-- Content Section -->
<div class="bg-light">
    <main>
        <div class="container space-2">
            <?= $this->element('accountsidenav') ?>
            <div class="card p-5">
                <div class="alert txt-14 alert-primary alert-dismissible fade show"> <strong>Get Connected!</strong> Connecting to facebook and Twitter increases your experiences <a href="connections">Learn more</a> . </div>
                <!-- Update Avatar Form -->
                <?= $this->Form->create($user, ['class' => 'js-validate', 'enctype' => 'multipart/form-data']) ?>
                <div class="row">

                    <div class=" mr-3">
                        <img style="height:125px;width:125px" class="img-fluid border rounded-circle profile_image" src="<?= !empty($currentUser->image) ?  $this->Custom->getDp($currentUser->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">

                    </div>

                    <div class="media-body">

                        <label for="image" class="btn bold btn-sm btn-primary upload_new_pic">Upload New Picture</label>
                        <!--<input type="hidden" id="image" name="image" value="<?php //if (!empty($image)) {
                                                                                //echo $image;
                                                                                //} 
                                                                                ?>" style="display:none;">-->

                        <!-- End Modal Window Trigger -->

                        <!-- Upload Photo Modal Window -->
                        <div id="uploadphoto_modal" class="js-modal-window u-modal-window" style="width: 470px;">
                            <div class="card">
                                <!-- Header -->
                                <header class="bg-white mt-3 py-3 px-5">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h3 class="h5 bold mb-0">Select profile photo</h3>

                                        <button type="button" class="close" aria-label="Close" onclick="Custombox.modal.close();">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                </header>
                                <!-- End Header -->
                                <!-- Body -->
                                <div class="card-body text-center p-5">
                                    <div class="profile_photos">
                                        <img data-toggle="tooltip" title="Uploaded Pic" style="height:90px;width:90px;cursor:pointer" class="img-fluid border rounded-circle preview_image social-images-profile <?= empty($currentUser->image) ? 'selectimage' : '' ?>" src="<?= !empty($currentUser) ?  $this->Custom->getDp($currentUser->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">

                                        <?php
                                        if ($user['google_image'] != "") {
                                        ?>
                                            <img data-toggle="tooltip" title="Google Profile Pic" style="height:90px;width:90px;cursor:pointer" class="img-fluid border rounded-circle google_image social-images-profile <?= ($select_image == 'google') ? 'selectimage' : '' ?>" src="<?= $user['google_image'] ?>" alt="Image Description">
                                        <?php
                                        }
                                        if ($user['face_image'] != "") {
                                        ?>
                                            <img data-toggle="tooltip" title="FaceBook Profile Pic" style="height:90px;width:90px;cursor:pointer" class="img-fluid border rounded-circle facebook_image social-images-profile <?= ($select_image == 'facebook') ? 'selectimage' : '' ?>" src="<?= $user['face_image'] ?>" alt="Image Description">
                                        <?php
                                        }
                                        if ($user['twitter_image'] != "") {
                                        ?>
                                            <img data-toggle="tooltip" title="Twitter Profile Pic" style="height:90px;width:90px;cursor:pointer" class="img-fluid border rounded-circle twitter_image social-images-profile <?= ($select_image == 'twitter') ? 'selectimage' : '' ?>" src="<?= $user['twitter_image'] ?>" alt="Image Description">
                                        <?php
                                        }
                                        ?>


                                    </div>
                                    <div class="text-center">
                                        <span class="u-divider u-divider--xs u-divider--text mt-3">Or</span>
                                    </div>

                                    <?= $this->Form->control('uploadphoto', ["type" => "file", "id" => "uploadphoto", 'value' => "", "onchange" => "previewImage();", "style" => "display:none"]) ?>
                                    <?= $this->Form->hidden('profile_withsocial', ["id" => "profile_withsocial", 'value' => $user->image]) ?>
                                    <?= $this->Form->hidden('select_photo', ["id" => "select_photo", 'value' => $user->select_photo]) ?>

                                    <div style="display:flex;flex-direction:column; max-width:252px; margin:auto;">
                                        <button type="button" class="btn btn-soft-facebook mb-1 mt-3 filedialog_open">Browse files from your computer</button>
                                        <?php
                                        if (empty($user->google_image)) {
                                        ?>
                                            <button type="button" class="btn btn-google mb-1 google_profile" onclick="google_for_profile();" style="border-radius:50px;"><i class="fab fa-google"></i>&nbsp;Use Google Photo</button>
                                        <?php
                                        }
                                        if (empty($user->facebook_image)) {
                                        ?>
                                            <button type="button" class="btn btn-facebook mb-1 facebook_profile" onclick="fblogin_for_profile();" style="border-radius:50px;"><i class="fab fa-facebook-f"></i>&nbsp;Use Facebook Photo</button>
                                        <?php
                                        }
                                        if (empty($user->twitter_image)) {
                                        ?>
                                            <button type="button" class="btn btn-twitter mb-1 twitter_profile" onclick="twitter_for_profile();" style="border-radius:50px;"><i class="fab fa-twitter"></i> &nbsp;Use Twitter Photo</button>
                                        <?php
                                        }
                                        ?>

                                    </div>


                                </div>
                                <!-- End Body -->

                                <!-- Footer -->
                                <div class="card-footer text-center p-5">
                                    <div class="mb-3">
                                        <center>
                                            <p class="text-left txt-14">Add a photo and capture the attention of family and friends, photos can speak volumes about you - show the world what you're all about! </p>
                                            <br>
                                        </center>
                                    </div>
                                    <div class="mb-2">
                                        <a class="btn btn-primary btn-sm" href="javascript:accountImageUpload();">Save</a> &nbsp;&nbsp; or &nbsp;&nbsp; <button type="button" class="btn btn-sm btn btn-light" aria-label="Close" onclick="Custombox.modal.close();">Cancel</button>
                                    </div>
                                </div>
                                <!-- End Footer -->
                            </div>
                        </div>
                        <!-- End Upload Photo Modal Window -->


                        <!-- <button type="submit" class="btn btn-sm btn-soft-secondary  mb-1 mb-sm-0">Delete</button> -->
                    </div>
                </div>
                <!-- End Update Avatar Form -->
                <br><br>
                <!-- Personal Info Form -->
                <div class="row">
                    <!-- Input -->
                    <div class="col-sm-6 mb-6">
                        <div class="js-form-message">
                            
                            
                             <h2 class="txt-14 bold mb-0">First Name <span class="text-danger">*</span></h2>
                    

                            <div class="form-group">
                                <?= $this->Form->control('firstname', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Enter your firstname']) ?>
                                <small class="form-text text-muted">Displayed on your public profile, notifications and other places (e.g. John D.).</small>
                            </div>
                        </div>
                    </div>
                    <!-- End Input -->

                    <!-- Input -->
                    <div class="col-sm-6 mb-6">
                        <div class="js-form-message">
                             <h2 class="txt-14 bold mb-0">Last Name <span class="text-danger">*</span></h2>

                            <div class="form-group">
                                <?= $this->Form->control('lastname', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Enter your lastname']) ?>
                            </div>
                        </div>
                    </div>
                    <!-- End Input -->
                </div>

                <div class="row">

                    <div class="col-sm-6 mb-6">
                        <div class="js-form-message">
                            <label id="phone" class="txt-14 bold mb-0">
                                Phone Number <span class="text-danger">*</span>
                            </label>
                            <div class="form-group">
                                <?= $this->Form->control('phone', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Enter your phone number', "pattern" => "\d*", 'required']) ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-6">
                        <div class="js-form-message">
                            <label id="organizationLabel" class="txt-14 bold mb-0">
                                Gender
                            </label>
                            <div class="form-group" style="margin-top: -10px;">
                                <?= $this->Form->radio('gender', [['value' => 'Male', 'text' => '  Male &nbsp;&nbsp;&nbsp;', 'data-title' => 'Male', 'class' => 'option-input radio'], ['value' => 'Female', 'text' => 'Female', 'data-title' => 'Female', 'class' => 'option-input radio']], ['escape' => false]); ?>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="row">
                    <!-- Input -->
                    <div class="col-sm-6 mb-6">
                        <div class="js-form-message">
                            <label id="websiteLabel" class="txt-14 bold mb-0">
                                State/Province
                            </label>

                            <div class="form-group">
                                <?= $this->Form->control('state_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $states, 'empty' => true, 'label' => false, "id" => "state_id", 'class' => 'select2 state_select', "style" => "width: 100%", 'required', 'default' => !empty($user->city) ? $user->city->state_id : '']); ?>
                            </div>
                        </div>
                    </div>
                    <!-- End Input -->

                    <!-- Input -->
                    <div class="col-sm-6 mb-6">

                        <div id="citydiv"></div>

                    </div>
                    <!-- End Input -->


                </div>
                <div class="row">

                    <div class="col-sm-12 mb-6">
                        <div class="js-form-message">
                            <label id="emailLabel" class="txt-14 bold mb-0">
                                Home Town
                            </label>
                            <div class="form-group">
                                <?= $this->Form->control('hometown', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Enter your home town']) ?>
                            </div>
                        </div>
                    </div>

                </div>

                <hr class="mt-1 mb-7">

                <h3 class="h5 mb-3">Personal Details</h3>
                <div class="row">
                    <!-- Input -->
                    <div class="col-sm-6 mb-6">
                        <div class="js-form-message">
                            <label id="organizationLabel" class="txt-14 bold mb-0">
                                Birthday
                            </label>
                            <div style="margin-bottom:8px">
                                <small class="form-text text-muted">Receive specials on your birthday</small>
                            </div>
                            <div class="form-group cakedate">
                                <?= $this->Form->control('dob', [
                                    'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'minYear' => 1920, 'maxYear' => date('Y') - 5,
                                    'empty' => [
                                        'year' => "Year", // The year select control has no option for empty value
                                        'month' => 'Month', // The month select control does, though
                                        'day' => 'Day', // The month select control does, though
                                    ],
                                ]) ?>
                            </div>
                        </div>
                    </div>
                    <!-- End Input -->

                    <!-- Input -->
                    <div class="col-sm-6 mb-6">
                        <div class="js-form-message">
                            <label id="websiteLabel" class="txt-14 bold mb-0">
                                Anniversary
                            </label>
                            <div style="margin-bottom:8px"> <small class="form-text text-muted">Receive specials on your anniversary</small></div>
                            <div class="form-group cakedate">                                
                                <?= $this->Form->control('anniversary', [
                                    'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'minYear' => 1920, 'maxYear' => date('Y') - 5,
                                    'empty' => [
                                        'year' => "Year", // The year select control has no option for empty value
                                        'month' => 'Month', // The month select control does, though
                                        'day' => 'Day', // The month select control does, though
                                    ],
                                ]) ?>
                            </div>
                        </div>
                    </div>
                    <!-- End Input -->
                </div>



                <hr class="mt-1 mb-7">

                <!-- Title -->
                <div class="mb-3">
                    <h2 class="h5 bold mb-0">A little about you</h2>
                    <p class="txt-14">Write a little about yourself, likes, dislikes, what you like to do.</p>
                </div>
                <!-- End Title -->

                <div class="mb-6">
                    <!-- Text Editor Input -->
                    <div class="u-summernote-editor">
                        <?= $this->Form->control('about_me', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control']) ?>
                    </div>
                    <!-- End Text Editor Input -->
                </div>

                <hr class="mt-1 mb-7">

                <!-- Title -->
                <div class="mb-3">
                    <h2 class="h5 bold mb-0">Your quote or saying</h2>
                    <p class="txt-14">Add your favorite saying or quote. (40 characters)</p>
                </div>
                <!-- End Title -->

                <div class="mb-6">
                    <!-- Text Editor Input -->
                    <div class="u-summernote-editor">
                        <?= $this->Form->control('sayings', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control']) ?>
                    </div>
                    <!-- End Text Editor Input -->
                </div>

                <hr class="my-5">

                <!-- Title -->
                <div class="mb-5">
                    <h3 class="h5 bold mb-1">Social profiles</h3>
                    <p class="txt-14">Add links to your profile.</p>
                </div>
                <!-- End Title -->

                <!-- Social Profiles Form -->
                <!-- Input Group -->
                <div class="mb-6">
                    <div class="js-focus-state form-group">
                        <div class="input-group">
                            <div id="dribbleProfileLabel" class="input-group-prepend">
                                <span class="input-group-text">https://facebook.com/</span>
                            </div>
                            <?= $this->Form->control('facebook_link', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Facebook profile']) ?>
                        </div>
                        <small class="form-text text-14 text-muted">Add your Facebook user name (e.g. johndoe)</small>
                    </div>
                </div>
                <!-- End Input Group -->

                <!-- Input Group -->
                <div class="mb-6">
                    <div class="js-focus-state form-group">
                        <div class="input-group">
                            <div id="twitterProfileLabel" class="input-group-prepend">
                                <span class="input-group-text pr-7">https://twitter.com/</span>
                            </div>
                            <?= $this->Form->control('twitter_link', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Twitter profile']) ?>
                        </div>
                        <small class="form-text text-muted">Add your Twitter username (e.g. johndoe)</small>
                    </div>
                </div>
                <!-- End Input Group -->

                <!-- Input Group -->
                <div class="mb-6">
                    <div class="js-focus-state form-group">
                        <div class="input-group">
                            <div id="facebookProfileLabel" class="input-group-prepend">
                                <span class="input-group-text">https://www.instagram.com/</span>
                            </div>
                            <?= $this->Form->control('instagram_link', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Instagram profile']) ?>
                        </div>
                        <small class="form-text text-muted">Input your Instagram username (e.g. johndoe)</small>
                    </div>
                </div>
                <!-- End Input Group -->



                <!-- <button type="submit" class="btn btn-sm btn-primary mr-1">Update Settings</button> -->
                <!-- <button type="submit" class="btn btn-sm btn-soft-secondary border">Cancel</button> -->

                <div class="row">
                    <div class="input-field col s6 v2-mar-top-40 m6">
                        <?= $this->Form->button(__('Save Settings'), ['type' => 'submit', 'value' => "Update Settings", 'class' => 'btn btn-sm bold btn-primary mr-1', 'style' => '']); ?>

                    </div>

                </div>

                <?= $this->Form->end() ?>
                <!-- End Social Profiles Form -->
            </div>
        </div>
    </main>
</div>
<?php //echo $this->element('ajax_dropdown', [
//    'ajax_url' => $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'getCitiesSelect']),
//  'ajax_placeholder' => 'Choose a city',
//'select_id' => 'city_id',
//'minimumInputLength' => 1,
//]) 
?>

<script>
    $(document).on('ready', function() {
        // https://bootstrap-datepicker.readthedocs.io/en/latest/options.html#format
        $(".account_datepicker").datepicker({
            format: 'DD dd MM yyyy',
            endDate: '+0d',
            autoclose: true
            // format: 'yyyy/mm/dd',
        });
    });
</script>