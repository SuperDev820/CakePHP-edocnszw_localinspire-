<div class="px-3">
    <?php echo $this->Form->create($searchKeyword, ['class' => 'form form-horizontal', 'enctype' => 'multipart/form-data']) ?>

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
            <label class="col-md-3 label-control" for="sic4category_id">Sic4Category
                <span class="required" aria-required="true"> * </span>
            </label>
            <div class="col-md-6">
                <?= $this->Form->control('sic4category_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $sic4categories, 'empty' => true, 'label' => false, 'class' => 'form-control select2', "style" => "width: 100%", 'required']); ?>
            </div>
        </div>



        <div class="form-group row">
            <label class="col-md-3 label-control" for="enable_business" style="margin-top: 20px;">Enable for Business
            </label>
            <div class="col-md-6">
                <?= $this->Form->checkbox('enable_business', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'option-input radio', $searchKeyword->enable_business == false ? '' : 'checked' => "checked"]) ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 label-control" for="enable_filter" style="margin-top: 20px;">Enable for Filter
            </label>
            <div class="col-md-6">
                <?= $this->Form->checkbox('enable_filter', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'option-input radio', $searchKeyword->enable_filter == false ? '' : 'checked' => "checked"]) ?>
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