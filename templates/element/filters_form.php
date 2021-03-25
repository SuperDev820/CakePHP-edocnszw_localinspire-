<?php echo $this->Form->create($filter, ['class' => 'form form-horizontal', 'enctype' => 'multipart/form-data']) ?>

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
        <label class="col-md-3 label-control" for="active" style="margin-top: 20px;">Active
        </label>
        <div class="col-md-6">
            <?= $this->Form->checkbox('active', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'option-input radio', $filter->active == false ? '' : 'checked' => "checked"]) ?>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-3 label-control" for="description">Add and Edit Description:
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
        <label class="col-md-3 label-control" for="show_business" style="margin-top: 20px;">Show for Business
        </label>
        <div class="col-md-6">
            <?= $this->Form->checkbox('show_business', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'option-input radio', $filter->show_business == false ? '' : 'checked' => "checked"]) ?>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-3 label-control" for="show_filter" style="margin-top: 20px;">Show for Filter
        </label>
        <div class="col-md-6">
            <?= $this->Form->checkbox('show_filter', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'option-input radio', $filter->show_filter == false ? '' : 'checked' => "checked"]) ?>
        </div>
    </div>


    <div class="form-group row">
        <label class="col-md-3 label-control" for="category_id">Category
            <span class="required" aria-required="true"> * </span>
        </label>
        <div class="col-md-6">
            <?= $this->Form->control('category_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $categories, 'empty' => true, 'label' => false, 'class' => 'form-control select2', "style" => "width: 100%"]); ?>
        </div>
    </div>



    <div class="form-group row">
        <label class="col-md-3 label-control" for="search_keyword_id">Search Keyword
            <span class="required" aria-required="true"> * </span>
        </label>
        <div class="col-md-6">
            <?= $this->Form->control('search_keyword_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $searchKeywords, 'empty' => true, 'label' => false, 'class' => 'form-control select2', "style" => "width: 100%"]); ?>
        </div>
    </div>


    <div class="form-group row">
        <label class="col-md-3 label-control" for="sic2categories._ids">Sic2Categories
        </label>
        <div class="col-md-6">
            <?= $this->Form->control('sic2categories._ids', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $sic2categories, 'empty' => true, 'label' => false, 'class' => 'form-control filters_subcat_select', "style" => "width: 100%"]); ?>
        </div>
    </div>


    <div class="form-group row">
        <label class="col-md-3 label-control" for="sic4categories._ids">Sic4Categories
        </label>
        <div class="col-md-6">
            <?= $this->Form->control('sic4categories._ids', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $sic4categories, 'empty' => true, 'label' => false, 'class' => 'form-control filters_subcat_select', "style" => "width: 100%"]); ?>
        </div>
    </div>


    <div class="form-group row">
        <label class="col-md-3 label-control" for="sic8categories._ids">Sic8Categories
        </label>
        <div class="col-md-6">
            <?= $this->Form->control('sic8categories._ids', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $sic8categories, 'empty' => true, 'label' => false, 'class' => 'form-control filters_subcat_select', "style" => "width: 100%"]); ?>
        </div>
    </div>


    <div class="form-group row">
        <label class="col-md-3 label-control" for="key_order">Key Order:
        </label>
        <div class="col-md-6">
            <div class="position-relative has-icon-left">
                <?= $this->Form->control('key_order', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter text', 'autocomplete' => 'off']) ?>
                <div class="form-control-position">
                    <i class="ft-file"></i>
                </div>
            </div>
        </div>
    </div>


    <div class="form-group row">
        <label class="col-md-3 label-control" for="subcategories._ids">Subcategories (Tags)
        </label>
        <div class="col-md-6">
            <?= $this->Form->control('subcategories._ids', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $subcategories, 'empty' => true, 'label' => false, 'class' => 'form-control filters_subcat_select', "id" => "choose_subcat", "style" => "width: 100%"]); ?>
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary btn-default waves-effect btn-round swal add_subcat" onclick="return false;" data-type="add-subreddit">New Tag</button>
        </div>
    </div>


    <div class="form-group row">
        <label class="col-md-3 label-control" for="form_type_id">Form Type
            <span class="required" aria-required="true"> * </span>
        </label>
        <div class="col-md-6">
            <?= $this->Form->control('form_type_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $formTypes, 'empty' => true, 'label' => false, "id" => 'form_typeid', 'class' => 'form-control select2', "style" => "width: 100%"]); ?>
        </div>
    </div>

    <div id="input_options" style="display:none;">

        <div class="form-group row">
            <label class="col-md-3 label-control" for="input_type">Input Type
            </label>
            <div class="col-md-6">
                <div class="position-relative has-icon-left">
                    <?= $this->Form->control('input_type', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'autocomplete' => 'off', 'options' => ["number" => "Number Field", "text" => "Text Field"]]) ?>
                    <div class="form-control-position">
                        <i class="ft-file"></i>
                    </div>
                </div>
            </div>
        </div>


        <div class="form-group row">
            <label class="col-md-3 label-control" for="input_class">Input HTML Classes
            </label>
            <div class="col-md-6">
                <div class="position-relative has-icon-left">
                    <?= $this->Form->control('input_class', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'autocomplete' => 'off']) ?>
                    <div class="form-control-position">
                        <i class="ft-file"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 label-control" for="placeholder">Input Placeholder
            </label>
            <div class="col-md-6">
                <div class="position-relative has-icon-left">
                    <?= $this->Form->control('placeholder', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'autocomplete' => 'off']) ?>
                    <div class="form-control-position">
                        <i class="ft-file"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row" id="dropdownoption" style="display:none;">
        <label class="col-md-3 label-control" for="options">Dropdown Options
        </label>
        <div class="col-md-6">
            <div class="position-relative has-icon-left">
                <?= $this->Form->control('options', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'autocomplete' => 'off']) ?>
                <div class="form-control-position">
                    <i class="ft-file"></i>
                </div>
            </div>
            <span> e.g ["a","b","c","d"]</span>
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


<?php
// echo $this->element('ajax_dropdown', [
//     'ajax_url' => $this->Url->build(['prefix' => false, 'controller' => 'GeneralActions', 'action' => 'getSubcatsJson']),
//     'ajax_placeholder' => 'Choose one or more options',
//     'select_id' => 'choose_subcat',
//     'allowClear' => "false",
//     'minimumInputLength' => 0
// ]);
?>
<?php echo $this->element('add_tag_swal', ['select_id' => 'choose_subcat']) ?>

<script>
    function checkFilterOptions() {
        var selected_value = $('#form_typeid').select2('val');

        if (selected_value == 1) {
            $('#input_options').fadeIn();
            $('#dropdownoption').fadeOut();
        } else if (selected_value == 3) {
            $('#dropdownoption').fadeIn();
            $('#input_options').fadeOut();
        } else {
            $('#input_options').fadeOut();
            $('#dropdownoption').fadeOut();
        }
    }
    $(document).ready(function() {
        checkFilterOptions();
        jQuery(document).on('change', '#form_typeid', function(e) {
            checkFilterOptions();
        });
    });
</script>