<?php $this->assign('title', 'Change Password'); ?>
<!-- Content Section -->
<div class="bg-light">
  <main>
    <div class="container space-2">
      <?= $this->element('accountsidenav') ?>

      <div class="card p-5">
          
          
          <!-- My Network -->
                <div class="mb-3">
                    <!-- Title -->
                    <div class="row mb-4 border-bottom justify-content-between align-items-end">
                        <div class="col-6 txt-14">
                            <h2 class="h5 bold mb-0">Change Password</h2>
                        </div>
                        <div class="col-6 text-right">
                          
                        </div>
                    </div>
          
          
          
          
          
          
         
          
        <?php //echo $this->Form->create($user, ['class' => 'js-validate', 'enctype' => 'multipart/form-data']) 
        ?>
        <?= $this->Form->create($user, ['class' => '', 'enctype' => 'multipart/form-data']) ?>
        <!-- Input -->
        
        

        <div class="js-form-message mb-6">
          <h2 class="txt-14 bold mb-0">Current password</h2>
                    <span class="txt-12lt text-grey">Enter your existing password.</span>

          <div class="form-group">
            <?= $this->Form->control('old_password', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control w-lg-65', 'required', 'type' => 'password', "placeholder" => "Enter your current password"]); ?>
          </div>
        </div>
        <!-- End Input -->

        <!-- Input -->
        <div class="mb-6">
          <div class="js-form-message">
            <h2 class="txt-14 bold mb-0">New password</h2>
                    <span class="txt-12lt text-grey">Enter the new password you would like to use.</span>

            <div class="form-group">
              <?= $this->Form->control('password1', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control w-lg-65', 'required', 'type' => 'password', "placeholder" => "Enter your new password"]); ?>

            </div>
          </div>
        </div>
        <!-- End Input -->

        <!-- Input -->
        <div class="js-form-message mb-6">
         <h2 class="txt-14 bold mb-0">Confirm password</h2>
                    <span class="txt-12lt text-grey">Reenter your password to verify.</span>

          <div class="form-group">
            <?= $this->Form->control('password2', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control w-lg-65', 'required', 'type' => 'password', "placeholder" => "Reenter your password to verify"]); ?>
          </div>
        </div>
        <!-- End Input -->

        <div class="w-lg-50">

          <!-- Buttons -->
          <?= $this->Form->button(__('Save New Password'), ['type' => 'submit', 'value' => "Save Password", 'class' => 'btn bold btn-sm btn-primary mr-1', 'style' => '']); ?>

          <!-- End Buttons -->
        </div>


        <?= $this->Form->end() ?>
      </div>
    </div>
  </main>
</div>