<div class="px-3">
    <?php echo $this->Form->create($user, ['class' => 'form form-horizontal', 'enctype' => 'multipart/form-data']) ?>

    <div class="form-body">
        <!-- <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4> -->

        <div class="form-group row">
            <label class="col-md-3 label-control" for="username"> Username:
                <span class="required" aria-required="true"> * </span>
            </label>
            <div class="col-md-6">
                <div class="position-relative has-icon-left">
                    <?=$this->Form->control('username', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'required'])?>
                        <div class="form-control-position">
                            <i class="fa fa-user"></i>
                        </div>
                </div>
            </div>
        </div>

        <?php if (isset($show_fullname) && $show_fullname == false): ?>
        <?php else: ?>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="name"> Full Name:
                <span class="required" aria-required="true"> * </span>
            </label>
            <div class="col-md-6">
                <div class="position-relative has-icon-left">
                    <?=$this->Form->control('name', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'required'])?>
                        <div class="form-control-position">
                            <i class="fa fa-user"></i>
                        </div>
                </div>
            </div>
        </div>
        <?php endif;?>


        <?php if (isset($show_othernames) && $show_othernames == false): ?>
        <?php else: ?>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="name"> First Name:
                <span class="required" aria-required="true"> * </span>
            </label>
            <div class="col-md-6">
                <div class="position-relative has-icon-left">
                    <?=$this->Form->control('firstname', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'required'])?>
                        <div class="form-control-position">
                            <i class="fa fa-user"></i>
                        </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="name"> Last Name:
                <span class="required" aria-required="true"> * </span>
            </label>
            <div class="col-md-6">
                <div class="position-relative has-icon-left">
                    <?=$this->Form->control('lastname', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'required'])?>
                        <div class="form-control-position">
                            <i class="fa fa-user"></i>
                        </div>
                </div>
            </div>
        </div>
        <?php endif;?>

        <!-- <div class="form-group row">
            <label class="col-md-3 label-control" for="name"> Email:
                <span class="required" aria-required="true"> * </span>
            </label>
            <div class="col-md-6">
                <div class="position-relative has-icon-left">
                    <?=$this->Form->control('email', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'required'])?>
                        <div class="form-control-position">
                            <i class="fa fa-envelope"></i>
                        </div>
                </div>
            </div>
        </div> -->
        <div class="form-group row">
            <label class="col-md-3 label-control" for="name"> Phone:
                <span class="required" aria-required="true"> * </span>
            </label>
            <div class="col-md-6">
                <div class="position-relative has-icon-left">
                    <?=$this->Form->control('phone', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter phone number', 'autocomplete' => 'off', 'maxLength' => 11, 'minLength' => 10, 'pattern' => "\d*"])?>
                        <div class="form-control-position">
                            <i class="fa fa-phone"></i>
                        </div>
                </div>
            </div>
        </div>


        <div class="form-group row">
            <label class="col-md-3 label-control" for="sa" style="margin-top: 20px;">Super Admin
            </label>
            <div class="col-md-6">
                <?=$this->Form->checkbox('sa', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'option-input radio', $user->sa == false ? '' : 'checked' => "checked"])?>
            </div>
        </div>
        
        <div class="form-group row">
            <label class="col-md-3 label-control" for="admin" style="margin-top: 20px;"> Admin
            </label>
            <div class="col-md-6">
                <?=$this->Form->checkbox('admin', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'option-input radio', $user->admin == false ? '' : 'checked' => "checked"])?>
            </div>
        </div>
        

        <?php if (isset($show_password) && $show_password == false): ?>
        <?php else: ?>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="description">Password:
                <span class="required" aria-required="true"> * </span>
            </label>
            <div class="col-md-6">
                <div class="position-relative has-icon-left">
                    <p>The default password is
                        <strong>abcdef</strong>
                    </p>
                    <p>User will be required to change their password</p>
                </div>
            </div>
        </div>
        <?php endif;?>



    </div>

    <div class="form-actions">


        <div class="row clearfix">
            <div class="col-sm-9 offset-3">
                <?=$this->Form->button(__(' <i class="fa fa-check-square-o"></i> Save'), ['class' => 'btn btn-raised btn-primary']);?>
            </div>
        </div>

    </div>
    <?=$this->Form->end()?>
</div>

<script>
    jQuery(document).ready(function () {

       
    });

</script>
