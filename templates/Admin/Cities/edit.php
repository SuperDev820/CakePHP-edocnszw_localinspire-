<?php $this->assign('title', 'Edit City'); ?>
<section id="horizontal-form-layouts">
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header">Edit City</div>
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
                        <?php echo $this->Form->create($city, ['class' => 'form form-horizontal', 'enctype' => 'multipart/form-data']) ?>

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
                                <label class="col-md-3 label-control" for="price"> Price:
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-6">
                                    <div class="position-relative has-icon-left">
                                        <?= $this->Form->control('price', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'required']) ?>
                                        <div class="form-control-position">
                                            <i class="fa fa-usd"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="population"> Population:
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-6">
                                    <div class="position-relative has-icon-left">
                                        <?= $this->Form->control('population', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'required']) ?>
                                        <div class="form-control-position">
                                            <i class="fa fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="state_id">State
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-6">
                                    <?= $this->Form->control('state_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $states, 'empty' => true, 'label' => false, 'class' => 'form-control select2', "style" => "width: 100%"]); ?>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="description">Description:
                                </label>
                                <div class="col-md-6">
                                    <div class="position-relative has-icon-left">
                                        <?= $this->Form->control('description', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter text', 'autocomplete' => 'off']) ?>
                                        <div class="form-control-position">
                                            <i class="ft-file"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="img_upload1" style="margin-top: 20px;">Image
                                    <br>Image size: 350x405
                                </label>
                                <div class="col-md-6">
                                    <!-- data-max-image-height="550"  -->
                                    <!-- data-max-image-width="360" -->
                                    <input name="img_upload1" type="file" class="file" data-show-upload="false" data-allowed-file-extensions='["jpeg", "jpg","png","gif"]' data-min-image-height="400" data-min-image-width="300" data-showCaption="true" data-max-file-size="400" <?= $this->Custom->checkImagePreview($city->image, "cities") ?>>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="county">county:
                                </label>
                                <div class="col-md-6">
                                    <div class="position-relative has-icon-left">
                                        <?= $this->Form->control('county', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter text', 'autocomplete' => 'off']) ?>
                                        <div class="form-control-position">
                                            <i class="ft-file"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="latitude">latitude:
                                </label>
                                <div class="col-md-6">
                                    <div class="position-relative has-icon-left">
                                        <?= $this->Form->control('latitude', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter text', 'autocomplete' => 'off']) ?>
                                        <div class="form-control-position">
                                            <i class="ft-file"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="longitude">longitude:
                                </label>
                                <div class="col-md-6">
                                    <div class="position-relative has-icon-left">
                                        <?= $this->Form->control('longitude', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter text', 'autocomplete' => 'off']) ?>
                                        <div class="form-control-position">
                                            <i class="ft-file"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="featured" style="margin-top: 20px;">Featured
                                </label>
                                <div class="col-md-6">
                                    <?= $this->Form->checkbox('featured', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'option-input radio', isset($city->featured) && $city->featured == true ? 'checked="checked"' : '']) ?>
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