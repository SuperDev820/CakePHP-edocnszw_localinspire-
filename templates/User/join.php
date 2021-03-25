<?php $this->assign('title', "Join " . $user->name_desc . " on Local Inspire"); ?>

<?= $this->element('profilenav', ['user' => $user]) ?>
<main class="bg-light" id="content" role="main">
    <!-- Breadcrumb Section -->
    <div class="container">

      <BR>  <h3 class="bold">Hey, traveler! join <?php echo ucfirst($user->firstname) . " " . ucfirst(substr($user->lastname, 0, 1)) . "."; ?> on Localinspire</h3>
      
Localinspire is a place for people to get new
ideas and find great things to do in any city.
Join now ─ it's free
    </div> 
    <main class="bg-white mt-2 container borderlt" id="contenta" role="main">
        
        
      <div class="row">
  <div class="col-sm-8"><div class="pt-5 container">
            <form class="js-validate" method="post">
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
                    <div id="error-msg" class="alert alert-danger" style="display:none;">This email already exists...</div>
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
                <input type="hidden" class="join_form" name="join_form" id="join_form" value="1" />

                <div class="">
                    <button type="button" name="register" id="joinbutton" class="user_register mb-5 btn btn-primary btn-pill btn-wide transition-3d-hover">Join</button>
                </div>

            </form>

        </div></div>
  <div class="col-sm-4 pt-3"><b>We as a family owned business -</b><BR><BR>
  <span class="txt-14"> ─ Strive to promote upfront and honest reviews.<BR>
   ─ Seek to grow trust in our community and businesses.<BR>
   ─ Seek to inspire other local business review sites to be the best they can be.<BR>
   ─ Are putting others before ourself and loving our neighbors.</span></div>
  
</div>  
        
        
        
        
        
        
        
        
        
        

    </main> <BR><BR>

</main>