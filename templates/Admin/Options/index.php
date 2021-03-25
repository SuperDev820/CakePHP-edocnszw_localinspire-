<?php $this->assign('title', 'Edit Site Options'); ?>
<section id="horizontal-form-layouts">
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header">Edit Site Options</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h4 class="card-title" id="horz-layout-basic">Project Info</h4>
	                <p class="mb-0">This is the basic horizontal form with labels on left and form controls on right in one line. Edit <code>.form-horizontal</code> class to the form tag to have horizontal form styling. To define form sections use <code>form-section</code> class with any heading tags.</p> -->
                </div>
                <div class="card-body">
                    <div class="px-3">
                        <?php echo $this->Form->create($option, ['class' => 'form form-horizontal', 'enctype' => 'multipart/form-data']) ?>

                        <div class="form-body">
                            <!-- <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4> -->
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="city_discount"> City Discount:
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-6">
                                    <div class="position-relative has-icon-left">
                                        <?= $this->Form->control('city_discount', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter amount', 'autocomplete' => 'off', 'required', 'max' => 100]) ?>
                                        <div class="form-control-position">
                                            <i class="fa fa-usd"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="city_radius"> City Radius:
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-6">
                                    <div class="position-relative has-icon-left">
                                        <?= $this->Form->control('city_radius', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter amount', 'autocomplete' => 'off', 'required']) ?>
                                        <div class="form-control-position">
                                            <i class="fa fa-globe"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- 
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="featured" style="margin-top: 20px;">Featured
                                </label>
                                <div class="col-md-6">
                                    <?= $this->Form->checkbox('featured', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'option-input radio', isset($city->featured) && $city->featured == true ? 'checked="checked"' : '']) ?>
                                </div>
                            </div> -->

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