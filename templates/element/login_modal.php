<div id="loginModal" class="js-modal-window u-modal-window" style="width: 437px;">
    <div class="card">


        <!-- Login -->
        <div id="welcome" data-target-group="idForm">
            <!-- Header -->
            <header class="py-3 px-5">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="h6 mb-0 modal-title"></h3>

                    <button type="button" class="close" aria-label="Close" onclick="Custombox.modal.close();">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </header>
            <div style="position: absolute;right: 43%;top: -30px;">
                <div style="width:65px;height:65px;background-color: #48AAE6;border-radius:50%; border:4px solid #fff;padding-top:7px;padding-left:15px;font-size:30px;font-weight:bold;color:#fff;"><i class="fas fa-lock"></i></div>
            </div>
            <!-- End Header -->

            <div class="card-body pl-5 pr-5 pt-1">
                <header class="text-center mb-2">
                    <h2 class="h4 mb-0">Welcome!</h2>
                </header>
                <!-- End Title -->
                <!-- Login Buttons -->
                <div id="status"></div>
                <div id="userData"></div>
                <div class="mt-4">
                    <a onclick="fbLogin()" id="fbLink" class="btn btn-block btn-sm btn-soft-facebookreg mr-1" href="javascript:void(0);">
                        <span class="fab fa-facebook-f mr-1"></span>
                        Facebook
                    </a>


                    <!-- Facebook login or logout button -->
                    <!-- <a href="javascript:void(0);" onclick="fbLogin()" id="fbLink"><img src="fblogin.png"/></a> -->
                    <!-- Display user profile data -->


                    <br>
                    <p class="btn btn-block btn-sm btn-soft-googlereg" id="googlebuttonclick">
                        <span style="font-size:18px;float:left;" class="fab fa-google"></span>
                        <span class="mr-3">Continue with Google</span>
                    </p>

                </div>
                <!-- End Login Buttons -->
                <div class="text-center">
                    <span class="u-divider u-divider--xs u-divider--text mt-4 mb-4">OR</span>
                </div>

                <div class="text-center mb-4">

                    <a class="js-animation-link btn btn-block btn-primary loginhide" href="javascript:;" data-target="#login_modal" data-link-group="idForm" data-animation-in="fadeIn"> <i style="font-size:20px;float:left" class="far fa-envelope"></i> Continue with Email
                    </a>
                    <a class="js-animation-link btn btn-block btn-primary signuphide" href="javascript:;" data-target="#signup" data-link-group="idForm" data-animation-in="fadeIn"><i style="font-size:20px;float:left" class="far fa-envelope"></i> Continue with Email
                    </a>
                </div>


            </div>
        </div>
        <!-- Login -->
        <div id="login_modal" style="display: none; opacity: 0;" data-target-group="idForm">

            <!-- Header -->
            <form class="js-validate" method="post">
                <header class="py-3 px-5">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="h6 mb-0"></h3>

                        <button type="button" class="close" aria-label="Close" onclick="Custombox.modal.close();">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </header>
                <!-- End Header -->
                <div class="card-body pl-5 pr-5 pt-1">
                    <header class="text-center mb-2">
                        <h2 class="h4 mb-0">Welcome back ─ Log in!</h2>
                    </header>
                    <p style="line-height: 1.3;">Localinspire is a place for people to get new ideas and find great things to do in any city.</p>
                    <div id="error" style="text-align: center;padding: 0px 0px 8px;color: red;"></div>
                    <!-- End Title -->

                    <!-- Form Group -->
                    <div class="form-group">
                        <div class="js-form-message js-focus-state">
                            <label class="sr-only" for="signinEmail">Email</label>
                            <div class="input-group">

                                <input type="email" class="form-control" name="username_or_email" id="username_or_email" placeholder="Email" aria-label="Email" aria-describedby="signinEmailLabel" required data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
                            </div>
                        </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="form-group">
                        <div class="js-form-message js-focus-state">
                            <label class="sr-only" for="signinPassword">Password</label>
                            <div class="input-group">

                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" aria-label="Password" aria-describedby="signinPasswordLabel" required data-msg="Your password is invalid. Please try again." data-error-class="u-has-error" data-success-class="u-has-success">
                            </div>
                        </div>
                    </div>
                    <!-- End Form Group -->

                    <div class="d-flex justify-content-end mb-4">
                        <a class="js-animation-link small link-muted" href="javascript:;" data-target="#forgotPassword" data-link-group="idForm" data-animation-in="fadeIn">Forgot Password?</a>
                    </div>

                    <div class="mb-2">
                        <button type="button" name="login" id="login" onclick="userLogin()" class="sub btn btn-block btn-primary">Login</button>
                    </div>

                    <div class="text-center mb-4">
                        <span class="small text-dark">Don't have an account?</span>
                        <a class="js-animation-link small" href="javascript:;" data-target="#signup" data-link-group="idForm" data-animation-in="fadeIn">Signup
                        </a>
                    </div>

                    <div class="text-center mb-4">
                        <span class="small text-dark">Want to use Facebook or Google instead?</span>
                        <a class="js-animation-link small" href="javascript:;" data-target="#welcome" data-link-group="idForm" data-animation-in="fadeIn">Go back
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <!-- Signup -->
        <div id="signup" style="display: none; opacity: 0;" data-target-group="idForm">
            <!-- Header -->
            <form class="js-validate" method="post">
                <header class="py-3 px-5">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="h6 mb-0"></h3>

                        <button type="button" class="close" aria-label="Close" onclick="Custombox.modal.close();">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </header>
                <!-- End Header -->

                <div class="card-body pl-5 pr-5 pt-1">


                    <!-- Title -->
                    <header class="text-center mb-7">

                        <h2 class="h4 mb-0">Hey, traveler! </h2>
                        <p>Localinspire is a place for people to get new <br>ideas and find great things to do in any city. <br>Join now ─ it's free</p>
                    </header>
                    <!-- End Title -->



                    <!-- Form Group -->

                    <!-- Billing Form -->
                    <div class="row mb-0">
                        <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-3">
                                <label class="sr-only" for="FirstName">First Name
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text" class="form-control firstname" name="FirstName" id="FirstName" placeholder="First Name" aria-label="First Name" aria-describedby="FirstNameLabel" required data-msg="Please enter your first name." data-error-class="u-has-error" data-success-class="u-has-success">
                            </div>
                            <!-- End Input -->
                        </div>

                        <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-3">
                                <label class="sr-only" for="LastName">Last Name
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text" class="form-control lastname" name="LastName" id="LastName" placeholder="Last Name" aria-label="Last Name" aria-describedby="LastNameLabel" required data-msg="Please enter your last name." data-error-class="u-has-error" data-success-class="u-has-success">
                            </div>
                            <!-- End Input -->
                        </div>
                    </div>
                    <!-- Form Group -->
                    <div class="form-group">
                        <div class="js-form-message js-focus-state">
                            <label class="sr-only" for="signupEmail">Email</label>
                            <div class="input-group">

                                <input type="email" class="form-control email" name="Email" id="EmailUser" placeholder="Email" aria-label="Email" aria-describedby="signupEmailLabel" required data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
                            </div>
                        </div>
                        <div id="error-msg" class="alert alert-danger" style="display:none;">This email id already exists...</div>
                    </div>
                    <!-- End Input -->

                    <!-- Form Group -->
                    <div class="form-group">
                        <div class="js-form-message js-focus-state">
                            <label class="sr-only" for="signupPassword">Password</label>
                            <div class="input-group">

                                <input type="password" class="form-control password" name="password" id="signupPassword" placeholder="Password" aria-label="Password" aria-describedby="signupPasswordLabel" required data-msg="Your password is invalid. Please try again." data-error-class="u-has-error" data-success-class="u-has-success">
                            </div>
                        </div>
                    </div>
                    <!-- End Input -->

                    <input type="hidden" class="ref_id" name="ref_id" id="ref_id" value="<?= (isset($user)) ? $user->id : "" ?>" />
                    <input type="hidden" class="join_form" name="join_form" id="join_form" value="0" />

                    <!-- <div class="form-group">
                        <div class="js-form-message js-focus-state small">
                            <label for="month">Birthday: <span class="text-mute"> Optional</span></span></label>
                            <div class="input-group">
                                <div class="row">
                                    <div class="col-xs-4 ml-3 mr-2">
                                        <select class="form-control" id="month" name="Month">
                                            <option value="">Month</option>
                                            <option value="1">Jan</option>
                                            <option value="2">Feb</option>
                                            <option value="3">Mar</option>
                                            <option value="4">Apr</option>
                                            <option value="5">May</option>
                                            <option value="6">Jun</option>
                                            <option value="7">Jul</option>
                                            <option value="8">Aug</option>
                                            <option value="9">Sep</option>
                                            <option value="10">Oct</option>
                                            <option value="11">Nov</option>
                                            <option value="12">Dec</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-4 mr-2">
                                        <select class="form-control" id="day" name="Day">
                                            <option value="">Day</option>
                                            <?php
                                            for ($i = 1; $i <= 31; $i++) {
                                            ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-4">
                                        <select class="form-control" id="year" name="Year">
                                            <option value="">Year</option>
                                            <?php
                                            for ($i = 2025; $i >= 1901; $i--) {
                                            ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <span class="help" id="msg_dob"></span>
                        </div>
                    </div> -->

                    <div class="mb-2">
                        <button type="button" name="register" id="register" class="user_register btn btn-block btn-primary ">Next</button>
                    </div>

                    <div class="text-center mb-4">
                        <span class="small text-dark">Already have an account?</span>
                        <a class="js-animation-link small" href="javascript:;" data-target="#login_modal" data-link-group="idForm" data-animation-in="fadeIn">Login
                        </a>
                    </div>
                    <div class="text-center mb-4">
                        <span class="small text-dark">Want to use Facebook or Google instead?</span>
                        <a class="js-animation-link small" href="javascript:;" data-target="#welcome" data-link-group="idForm" data-animation-in="fadeIn">Go back
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <!-- End Signup -->

        <!-- Forgot Password -->
        <div id="forgotPassword" style="display: none; opacity: 0;" data-target-group="idForm">
            <!-- Header -->
            <form class="js-validate" method="post">
                <header class="py-3 px-5">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="h6 mb-0 modal-title"></h3>

                        <button type="button" class="close" aria-label="Close" onclick="Custombox.modal.close();">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </header>
                <!-- End Header -->

                <div class="card-body p-5">

                    <!-- Title -->
                    <header class="">
                        <h2 class="h4 mb-0">Forgot your password?</h2>
                        <p class="before">Please enter your email address below and we'll send you instructions on how to reset your password.</p>
                        <p class="resetmsg"></p>
                    </header>
                    <!-- End Title -->
                    <!-- Form Group -->
                    <div class="form-group">
                        <div class="js-form-message js-focus-state">
                            <label class="sr-only" for="recoverSrEmail">Your email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="recoverEmail">
                                        <span class="fas fa-user"></span>
                                    </span>
                                </div>
                                <input type="email" class="form-control" name="email" id="recoverSrEmail" placeholder="Your email" aria-label="Your email" aria-describedby="recoverEmail" required data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
                            </div>
                        </div>
                    </div>
                    <!-- End Form Group -->
                    <div class="mb-2">
                        <div onclick="RecoverPassword()" class="btn btn-block btn-primary ">Recover Password</div>
                    </div>

                    <div class="text-center mb-4">
                        <span class="small text-muted">Remember your password?</span>
                        <a class="js-animation-link small" href="javascript:;" data-target="#login_modal" data-link-group="idForm" data-animation-in="fadeIn">Login
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <!-- End Forgot Password -->

    </div>
</div>

<!-- Email Signup Modal Window -->
<div id="emailsignupModal" class="js-modal-window u-modal-window" style="width: 550px;">

    <div class="card mb-9 pl-8 pr-8 pt-5" id="fbdetail">
        <!-- <div id="userDatasf"><input type="text" name="" class="userDatasf"></div> -->
        <h2 class="h4 mb-0" id="signup_username">Welcome to localinspire, Dennis! </h2>
        <p style="line-height: 1.3;">Let others see who you are by completing the following...</p>
        <!-- Author -->
        <div class="media mt-3 mb-3">
            <div class="mr-3">
                <img style="width:115px;height:115px;" id="blah" class="img-fluid rounded-circle border mr-3 imagechange" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/images/noprofile.png" alt="Profile Picture">


                <!-- <img style="width:115px" id="blah" class="img-fluid rounded-circle border mr-3" src="#" alt="Profile Picture"> -->
            </div>

            <div class="media-body pl-4 pr-4">
                <div onclick="fbLoginpicture()" class="btn btn-block btn-sm btn-soft-facebookreg mr-1">
                    <span class="fab fa-facebook-f mr-5"></span>
                    Use Facebook Photo
                </div>
                <div class="text-center">
                    <span class="u-divider u-divider--xs u-divider--text mt-2 mb-2">OR</span>
                </div>

                <p class="btn btn-block btn-sm btn-soft-primary ml-1 mt-0 uploadpc" style="cursor: pointer;">
                    <span class="fas fa-laptop mr-5"></span>
                    Upload from Computer
                </p>

                <form id="msform" method="post" enctype="multipart/form-data">
                    <input style="display: none" type="file" name="picture" class="file" id="regUserImg" onchange="regUserImageUpload()">
                </form>
            </div>
        </div>
        <!-- End Author -->
        <div class="row">
            <div class="col-sm-12">
                <div class="js-form-message">
                    <label id="organizationLabel" class="">
                        Birthday
                    </label>
                    <div style="margin-bottom:8px">
                        <small class="form-text text-muted">Receive specials on your birthday</small>
                    </div>
                    <div class="form-group cakedate">
                        <?= $this->Form->date('dob', [
                            'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'minYear' => 1940, 'maxYear' => date('Y') - 5,
                            'empty' => [
                                'year' => "Year", // The year select control has no option for empty value
                                'month' => 'Month', // The month select control does, though
                                'day' => 'Day', // The month select control does, though
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="js-form-message">
                    <label id="organizationLabel" class="">
                        Gender
                    </label>
                    <div class="form-group" style="margin-top: -10px;">
                        <?= $this->Form->radio('gender', [['value' => 'Male', 'text' => '  Male &nbsp;&nbsp;&nbsp;', 'data-title' => 'Male', 'class' => 'option-input radio'], ['value' => 'Female', 'text' => 'Female', 'data-title' => 'Female', 'class' => 'option-input radio']], ['escape' => false]); ?>
                    </div>

                </div>
            </div>


        </div>

        <!-- Buttons -->
        <div class="d-flex mt-3 mb-3">
            <div onclick="savegender()" class="btn btn-sm btn-primary savegender mr-1" data-next-step="#paymentDetailsStep">Save and Continue</div>
            <button type="submit" class="btn btn-sm btn-soft-secondary " onclick="Custombox.modal.close();">Skip</button>
        </div>
        <!-- End Buttons -->
    </div>
</div>


<div class="modal" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="width: 550px;">
            <div class="">
                <div class="mb-9 pl-8 pr-8 pt-5">
                    <form id="msform" method="post" enctype="multipart/form-data">
                        <!-- Author -->
                        <div class="media mt-4 mb-3">
                            <div class="mr-2">
                                <img style="width:85px" class="img-fluid rounded-circle border mr-3" id="showImg" src="" alt="Profile Image">
                            </div>
                            <div class="media-body">
                                <h2 class="h4 mb-0">Nice to meet you, <span id="spanname"></span>!</h2>
                                <p style="line-height: 1.3;">Please complete this last step to create your localinspire account...</p>

                                <input type="hidden" name="GId" id="GId" value="">

                            </div>
                        </div>
                        <!-- End Author -->

                        <input type="hidden" name="Email" id="EmailGmail" class="col-md-12" placeholder="Email" value="" style="background: #c5c3c1;" readonly />
                        <!-- Form Group -->
                        <div class="js-form-message form-group mt-4">
                            <label class="bold" for="Password">Create a password</label>
                            <span style="font-size:12px">(Passwords must be atleast 6 characters in length.)</span>
                            <input type="password" name="Password" id="PasswordGmail" class="form-control" placeholder="Password" minlength="6" required />
                            <span id="showError" class="text-danger bold small mt-1"><i class="fas fa-exclamation-circle mr-1"></i> Please add a password to continue.</span>
                        </div>

                        <button type="button" name="updateRegisterUsers" id="updateRegisterUsers" onclick='updateRegisterUser()' class="btn btn-block btn-sm btn-primary mt-4">Save and Continue</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>