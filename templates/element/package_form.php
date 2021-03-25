<!-- <script src="<?= $this->Url->build('/plugins/ckeditor5/ckeditor.js', ['fullBase' => true]); ?>"></script> -->
<?php echo $this->Form->create($package, ['class' => 'form form-horizontal', 'enctype' => 'multipart/form-data']) ?>

<div class="form-body">
    <!-- <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4> -->
    <div class="form-group row">
        <label class="col-md-3 label-control" for="name"> Name:
            <span class="required" aria-required="true"> * </span>
        </label>
        <div class="col-md-6">
            <div class="position-relative has-icon-left">
                <?= $this->Form->control('name', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'required']) ?>
                <div class="form-control-position">
                    <i class="fa fa-briefcase"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-3 label-control">Monthly Price:
            <span class="required" aria-required="true"> * </span>
        </label>
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-usd"></i>
                    </span>
                </div>
                <?= $this->Form->control('price_per_month', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'aria-label' => "Amount", 'placeholder' => 'enter amount', 'autocomplete' => 'off', 'required', 'max' => 9999999, 'min' => 0, 'step' => 0.01]) ?>
                <!-- <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                </div> -->
            </div>
        </div>
    </div>

    <!-- <div class="form-group row">
        <label class="col-md-3 label-control">Yearly Price:
            <span class="required" aria-required="true"> * </span>
        </label>
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-usd"></i>
                    </span>
                </div> -->
                <?php //echo $this->Form->control('price_per_year', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'aria-label' => "Amount", 'placeholder' => 'enter amount', 'autocomplete' => 'off', 'required', 'max' => 9999999, 'min' => 0, 'step' => 0.01]) ?>
                <!-- <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                </div> -->
            <!-- </div>
        </div>
    </div> -->


    <!-- <div class="form-group row">
        <label class="col-md-3 label-control" for="description">Description:
        </label> -->
        <!-- <div class="col-md-6"> -->
            <!-- <div class="position-relative has-icon-left"> -->
            <?php //echo $this->Form->control('description', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'id' => 'description']) 
            ?>
            <!-- https://github.com/CakeCoded/CkEditor -->
            <?php //echo $this->Ck->input('description',  ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'id' => 'description', 'required'], []); ?>
            <!-- <div class="form-control-position"> -->
            <!-- <i class="ft-file"></i> -->
            <!-- </div> -->
            <!-- </div> -->
        <!-- </div>
    </div> -->



    <div class="form-group row">
        <label class="col-md-3 label-control" for="percentage">City Owners Percentage:
        </label>
        <div class="col-md-6">
            <?= $this->Form->control('percentage', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter percent', 'autocomplete' => 'off', 'max' => 100, 'min' => 0, 'step' => 0.1]) ?>
        </div>
    </div>


    <div class="form-group row">
        <label class="col-md-3 label-control" for="stripe_productid"> Stripe Product ID:
            <span class="required" aria-required="true"> * </span>
        </label>
        <div class="col-md-6">
            <div class="position-relative has-icon-left">
                <?= $this->Form->control('stripe_productid', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'required']) ?>
                <div class="form-control-position">
                    <i class="fa fa-file"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-3 label-control" for="stripe_monthly_plan"> Stripe Monthly Plan ID:
            <span class="required" aria-required="true"> * </span>
        </label>
        <div class="col-md-6">
            <div class="position-relative has-icon-left">
                <?= $this->Form->control('stripe_monthly_plan', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'required']) ?>
                <div class="form-control-position">
                    <i class="fa fa-file"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-3 label-control" for="stripe_yearly_plan"> Stripe Yearly Plan ID:
            <span class="required" aria-required="true"> * </span>
        </label>
        <div class="col-md-6">
            <div class="position-relative has-icon-left">
                <?= $this->Form->control('stripe_yearly_plan', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'required']) ?>
                <div class="form-control-position">
                    <i class="fa fa-file"></i>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="form-actions">
    <div class="row clearfix">
        <div class="col-sm-9 offset-3">
            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-raised btn-primary']); ?>
        </div>
    </div>

</div>
<?= $this->Form->end() ?>

<script>
    $(document).ready(function() {
        // ClassicEditor
        //     .create(document.querySelector('#description'))
        //     .then(editor => {
        //         console.log(editor);
        //     })
        //     .catch(error => {
        //         console.error(error);
        //     });
    });
</script>