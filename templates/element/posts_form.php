<!-- <link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/taginput/bootstrap-tagsinput.css">
<script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/taginput/bootstrap-tagsinput.js"></script> -->
<script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/ckeditor4/ckeditor.js"></script>
<div class="px-3">
    <?php echo $this->Form->create($post, ['class' => 'form form-horizontal', 'enctype' => 'multipart/form-data', 'id' => "studentsform"]) ?>

    <div class="form-body">
        <!-- <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4> -->


        <div class="form-group row">
            <label class="col-md-3 label-control text-right" for="title"> Title:
                <span class="required" aria-required="true"> * </span>
            </label>
            <div class="col-md-6">
                <div class="position-relative has-icon-left">
                    <?= $this->Form->control('title', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'id' => 'title', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'required']) ?>
                    <!-- <div class="form-control-position">
                        <i class="fa fa-user"></i>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control text-right" for="excerpt"> Excerpt:
                <span class="required" aria-required="true"> * </span>
            </label>
            <div class="col-md-6">
                <div class="position-relative has-icon-left">
                    <?= $this->Form->control('excerpt', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'id' => 'excerpt', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'required']) ?>

                    <!-- <div class="form-control-position">
                        <i class="fa fa-user"></i>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control text-right" for="tags._ids">Tags
                <!-- <span class="required" aria-required="true"> * </span> -->
            </label>
            <div class="col-md-6">
                <?= $this->Form->control('tags._ids', ['templates' => ['inputContainer' => '{{content}}'], 'options' => ((isset($empty_tags) and $empty_tags == true) ? [] : $tags), 'empty' => false, 'label' => false, 'class' => 'form-control ' . ((isset($tagoptions) and $tagoptions == true) ? '' : 'select2_multiple'), "id" => 'cat_id', "style" => "width: 100%", "multiple"]); ?>
            </div>
            <?php if (isset($tagoptions) and $tagoptions == true) { ?>
                <div class="col-md-3">
                    <button class="btn btn-dark btn-default waves-effect btn-round swal" onclick="return false;" data-type="add-tag">New Tag</button>
                </div>
            <?php } ?>
        </div>



        <div class="form-group row mt-5">
            <label class="col-md-12 label-control text-center" for="content"> Content:
                <span class="required" aria-required="true"> * </span>
            </label>
            <div class="col-md-10 offset-1">
                <div class="position-relative has-icon-left">
                    <?php //echo $this->Ck->input('content',  ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control CKEDITOR', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'id' => 'postcontent', 'required'], ['height' => 500]);
                    ?>
                    <?php echo $this->Form->control('content', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'hiddenField' => false, 'class' => 'form-control CKEDITOR', 'id' => 'content', 'required'])
                    ?>
                    <!-- <div class="form-control-position">
                        <i class="fa fa-user"></i>
                    </div> -->
                </div>
            </div>
        </div>


        <div class="form-group row">
            <label class="col-md-3 label-control text-right" for="img_upload1" style="margin-top: 20px;">Featured Image
                <br>Image size: 500x280
            </label>
            <!-- data-min-image-height="400" -->
            <!-- data-min-image-width="300"  -->
            <div class="col-md-6">
                <input name="img_upload1" type="file" class="file" data-show-upload="false" data-allowed-file-extensions='["jpeg", "jpg","png","gif"]' data-max-image-height="15000" data-max-image-width="12000" data-showCaption="true" data-max-file-size="20000" <?= $this->Custom->checkImagePreview((!empty($post->image) ? $post->image : ''), "posts") ?>>
            </div>
        </div>




    </div>

    <div class="form-actions" style="margin-top: 100px">
        <div class="row clearfix">
            <div class="col-sm-9 offset-3">
                <?= $this->Form->button(__('Save'), ['class' => 'btn btn-raised btn-primary']); ?>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>
<?php if (isset($tagoptions) and $tagoptions == true) { ?>


    <?= $this->element('ajax_dropdown', [
        'ajax_url' => $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'getTagsJson']),
        'ajax_placeholder' => 'Select one or more tags',
        'select_id' => 'cat_id',
        'minimumInputLength' => 0,
        'multiple' => true
    ]) ?>
    <?php echo $this->element('add_tag_swal', ['select_id' => 'cat_id']) ?>
<?php } ?>

<?php echo $this->element('init_ckeditor', ['text' => $post->content, 'ckid' => 'content']) ?>

<script>
    $(document).ready(function() {
        // $("input").keydown(function() {
        //     $("input").css("background-color", "green");
        // });
        $("#title").keyup(function() {
            $("#excerpt").val($(this).val());
        });
    });
</script>