<?php $this->assign('title', 'Email reminder schedule for ' . ucwords($reminder->business->name)); ?>
<script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/ckeditor4/ckeditor.js"></script>
<section id="horizontal-form-layouts">
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header">Email reminder schedule for <?= ucwords($reminder->business->name) ?></div>
            <?php if (!empty($sendCount)) { ?>
                <p>Reminder has been sent <?= $sendCount ?> time(s)</p>
            <?php } ?>
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
                        <?php echo $this->Form->create($reminder, ['class' => 'form form-horizontal', 'enctype' => 'multipart/form-data']) ?>

                        <div class="form-body">
                            <!-- <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4> -->

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="number_of_times"> Number of times to send email:
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-6">
                                    <div class="position-relative has-icon-left">
                                        <?= $this->Form->control('number_of_times', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'required', 'min' => 0]) ?>
                                        <div class="form-control-position">
                                            <i class="fas fa-file"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="sa" style="margin-top: 20px;">Active
                                </label>
                                <div class="col-md-6">
                                    <?= $this->Form->checkbox('active', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'option-input radio', $reminder->active == false ? '' : 'checked' => "checked"]) ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="reminder_status_id">Reminder Status
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-6">
                                    <?= $this->Form->control('reminder_status_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $reminderStatuses, 'empty' => true, 'label' => false, 'class' => 'form-control select2', "style" => "width: 100%"]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="reminder_schedule_id">Schedule Option
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-6">
                                    <?= $this->Form->control('reminder_schedule_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $reminderSchedules, 'empty' => true, 'label' => false, 'class' => 'form-control select2', "style" => "width: 100%"]); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="content"> Content:
                                    <span class="required" aria-required="true"> * </span>
                                </label>
                                <div class="col-md-6">
                                    <div class="position-relative has-icon-left">
                                        <?php //echo $this->Form->control('content', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter message', 'autocomplete' => 'off', 'required', 'type' => "textarea"]) 
                                        ?>
                                        <?php //echo $this->Ck->input('content',  ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'id' => 'content', 'required'], []); 
                                        ?>
                                        <?php echo $this->Form->control('content', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'hiddenField' => false, 'class' => 'form-control CKEDITOR', 'id' => 'content', 'required'])
                                        ?>

                                        <div class="form-control-position">
                                            <i class="fas fa-envelope"></i>
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

                </div>
            </div>
        </div>
    </div>

</section>
<?php echo $this->element('init_ckeditor', ['text' => $reminder->content, 'ckid' => 'content']) ?>