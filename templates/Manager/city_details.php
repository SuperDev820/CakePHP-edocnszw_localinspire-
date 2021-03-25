<?php $this->assign('title', 'Update City'); ?>

<!-- Content Section -->
<div class="bg-light">
    <main>
        <div class="container space-2">
            <!-- Sidebar Info -->
            <div class="row">
                <!-- End Sidebar Info -->
                <div class="col-md-12 mb-9 mb-lg-0">

                    <div class="card p-5">
                        <!-- Project Title -->
                        <?= $this->element('city_title', ['city_title' => 'Update']) ?>
                        <hr>
                        <!-- Features Section -->
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="px-3">
                                        <?php echo $this->Form->create($city, ['class' => 'form form-horizontal', 'enctype' => 'multipart/form-data', 'id' => "cityform"]) ?>

                                        <div class="form-body">
                                            <!-- <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4> -->


                                            <div class="form-group row">
                                                <label class="col-md-3 label-control text-right" for="description"> Description:
                                                    <span class="required danger" aria-required="true"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="position-relative has-icon-left">
                                                        <?= $this->Form->control('description', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'id' => 'description', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'required']) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-bottom: 130px;">
                                                <label class="col-md-3 label-control text-right" for="img_upload1" style="margin-top: 20px;">City Image
                                                    <br>Image size: 500x280
                                                </label>
                                                <!-- data-min-image-height="400" -->
                                                <!-- data-min-image-width="300"  -->
                                                <div class="col-md-6">
                                                    <input name="img_upload1" type="file" class="file" data-show-upload="false" data-allowed-file-extensions='["jpeg", "jpg","png","gif"]' data-max-image-height="10000" data-max-image-width="12500" data-showCaption="true" data-max-file-size="20000" <?= $this->Custom->checkImagePreview((!empty($city->image) ? $city->image : ''), "cities") ?>>
                                                </div>


                                            </div>
                                            <!-- <div class="form-actions"> -->
                                            <div class="row clearfix">
                                                <div class="col-sm-8 offset-3">
                                                    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-raised btn-primary']); ?>
                                                </div>
                                            </div>
                                            <!-- </div> -->
                                        </div>

                                        <?= $this->Form->end() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Features Section -->

                    </div>
                </div>
            </div>
        </div>
        <!-- End Content Section -->
    </main>
    <!-- ========== END MAIN ========== -->


</div>
<script>
    $(document).ready(function() {

        // jQuery(document).on('change', '#active_city_select', function(e) {
        //     var city_id = $(this).select2('val');
        //     url = "<?= $this->Url->build(['controller' => 'manager', 'action' => 'switch']); ?>";
        //     url = updateQueryString('city_id', city_id, url);
        //     window.location.href = url;

        // });


    });
</script>