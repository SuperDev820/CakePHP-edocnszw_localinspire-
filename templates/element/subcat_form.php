<div class="form-body">
    <div class="form-group row">
        <label class="col-md-3 label-control" for="name"> Name:
            <span class="required" aria-required="true"> * </span>
        </label>
        <div class="col-md-6">
            <div class="position-relative has-icon-left">
                <?= $this->Form->control('name', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control name', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'required']) ?>
                <div class="form-control-position">
                    <i class="fa fa-briefcase"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-3 label-control" for="category_id">Category
            <span class="required" aria-required="true"> * </span>
        </label>
        <div class="col-md-6">
            <?= $this->Form->control('category_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $categories, 'empty' => true, 'label' => false, 'class' => 'form-control select2 category_id', "style" => "width: 100%"]); ?>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-3 label-control" for="sic4category_id">Sic4Category
            <span class="required" aria-required="true"> * </span>
        </label>
        <div class="col-md-6">
            <?= $this->Form->control('sic4category_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $sic4categories, 'empty' => true, 'label' => false, 'class' => 'form-control select2', "style" => "width: 100%"]); ?>
        </div>
    </div>

</div>