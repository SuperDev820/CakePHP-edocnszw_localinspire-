<?php $this->assign('title', 'Edit Subscription Info'); ?>
<section id="horizontal-form-layouts">
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header">Edit Subscription Info for <?= $subscription->business->name ?></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h4 class="card-title" id="horz-layout-basic">Project Info</h4>
	                <p class="mb-0">This is the basic horizontal form with labels on left and form controls on right in one line. Add <code>.form-horizontal</code> class to the form tag to have horizontal form styling. To define form sections use <code>form-section</code> class with any heading tags.</p> -->
                </div>
                <div class="card-body">
                    <div class="px-3">
                        <?php echo $this->Form->create($subscription, ['class' => 'form form-horizontal', 'enctype' => 'multipart/form-data']) ?>

                        <!-- <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4> -->
                        <div class="form-body">

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="package_id">Package
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-6">
                                    <?= $this->Form->control('package_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $packages, 'empty' => true, 'label' => false, 'class' => 'form-control select2 category_id', "style" => "width: 100%"]); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="coupon_id">Coupon
                                </label>
                                <div class="col-md-6">
                                    <?= $this->Form->control('coupon_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $coupons, 'empty' => true, 'label' => false, 'class' => 'form-control select2 category_id', "style" => "width: 100%"]); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control">Amount:
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-usd"></i>
                                            </span>
                                        </div>
                                        <?= $this->Form->control('amount', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'aria-label' => "Amount", 'placeholder' => 'enter amount', 'autocomplete' => 'off', 'required', 'max' => 9999999, 'min' => 0, 'step' => 0.01]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Discount:
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-usd"></i>
                                            </span>
                                        </div>
                                        <?= $this->Form->control('discount', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'aria-label' => "Discount", 'placeholder' => 'enter amount', 'autocomplete' => 'off', 'required', 'max' => 9999999, 'min' => 0, 'step' => 0.01]) ?>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="sa" style="margin-top: 20px;">Active
                                </label>
                                <div class="col-md-6">
                                    <?= $this->Form->checkbox('active', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'option-input radio', $subscription->active == false ? '' : 'checked' => "checked"]) ?>
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
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>