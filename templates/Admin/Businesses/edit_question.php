<?php $this->assign('title', 'Edit Question'); ?>
<section id="horizontal-form-layouts">
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header">Edit Question</div>
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
                        <?php echo $this->Form->create($question, ['class' => 'form form-horizontal', 'enctype' => 'multipart/form-data']) ?>

                        <div class="form-body">
                            <!-- <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4> -->

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="question"> Question:
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-6">
                                    <div class="position-relative has-icon-left">
                                        <?= $this->Form->control('question', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'required']) ?>
                                        <div class="form-control-position">
                                            <!-- <i class="fa fa-user"></i> -->
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
                    </div>

                    <script>
                        jQuery(document).ready(function() {


                        });
                    </script>

                </div>
            </div>
        </div>
    </div>

</section>