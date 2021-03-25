<div id="claimBusinessModal2" class="js-modal-window u-modal-window" style="width: 650px;">
    <div class="card">
        <?php echo $this->Form->create($business, ['class' => 'form form-horizontal', 'id' => 'claimBusinessform', 'enctype' => 'multipart/form-data', 'type' => 'put', 'url' => ['action' => 'claimSuccess', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]]) ?>
        <!-- <form class="js-validate"> -->
        <!-- Login -->
        <div id="">
            <!-- Header -->
            <header class="card-header  py-3 px-5">
                <div> <button type="button" class="close" aria-label="Close" onclick="Custombox.modal.close();">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h3 class="h3 text-center bold mb-0">Claim Your FREE Listing</h3>
                    <h5 class="h6 text-center bold mb-0"><?= $business->name ?></h5>
                    <h6 class="text-center txt-12 mb-0"><span class="d-block"><?= $business->address ?>, <?= $business->city->name ?>, <?= strtoupper($business->city->state->code) ?> <?= $business->zip ?> </span></h6>
                </div>
            </header>
            <!-- End Header -->

            <div class="card-body bg-light p-5">
                <div class="row">
                    <div class="col-md-6"><label class="bold txt-14" for="bphone">Business Phone <font color=#9b0000>*</font></label><BR>
                        <!-- <input type="text" class="form-control" name="biz_phone" id="biz_phone" placeholder="Business Phone" value="(972) 563-9511" required> -->
                        <?= $this->Form->control('phone', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'type' => 'text', "pattern" => "\d*", 'id' => 'claimPhone', 'placeholder' => 'Enter business contact number', 'autocomplete' => 'off', 'required']) ?>
                    </div>
                    <div class="col-md-6"><label class="bold txt-14" for="bemail">Business Email <font color=#9b0000>*</font></label><BR>
                        <!-- <input type="email" class="form-control" name="biz_email" id="biz_email" placeholder="Business Email" value="joel@carmonastexmex.com" required> -->
                        <?= $this->Form->control('email', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Please enter your business email', 'autocomplete' => 'off', 'required']) ?>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label class="bold txt-14" for="last">
                        How do you represent this business? <font color=#9b0000>*</font></label><br>
                    <?= $this->Form->control('business_role_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $busines_roles, 'empty' => false, 'label' => false, 'class' => 'form-control', "style" => "width: 100%", 'required']); ?>
                    <!-- <select name="represent" id="represent" class="form-control" required>
                        <option value="" selected>Select One</option>
                        <option style="width:250px;" value="I m the owner">I'm the owner</option>
                        <option value="I m the manager">I'm the manager</option>
                        <option value="I handle the marketing">I handle the marketing</option>
                        <option value="I work here & have permission to claim">I work here & have permission to claim</option>
                        <option value="Other">Other</option>
                    </select> -->
                </div>

                <small>


                    <div class="mb-2 custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input checkbox" id="certifyCheckbox" required>
                        <label class="custom-control-label" for="certifyCheckbox">I certify that I am an authorized representative of this business and have the authority to claim and represent this business, and agree to localinspire’s <a href="<?= $this->Url->build(['controller' => 'terms', 'action' => 'index']); ?>">Terms of Service</a> and <a href="<?= $this->Url->build(['controller' => 'policy', 'action' => 'index']); ?>">Privacy Policy</a>.
                        </label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input checkbox" id="tos" required>
                        <label class="pt-1 custom-control-label" for="tos">I have read and agree to localinspire’s <a href="<?= $this->Url->build(['controller' => 'terms', 'action' => 'index']); ?>">Terms of Service</a> and <a href="<?= $this->Url->build(['controller' => 'policy', 'action' => 'index']); ?>">Privacy Policy</a>.
                        </label>
                    </div>

                </small>
            </div>
        </div>
        <!-- </form> -->
        <div class="mb-2 mt-3 text-center">
            <?= $this->Form->button(__('Continue'), ['class' => 'pl-6 pr-6 btn btn-primary ']); ?>

            <!-- <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'claimSuccess', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>" class="pl-6 pr-6 btn btn-primary ">Continue</a> -->
        </div>

        <?= $this->Form->end() ?>
    </div>
</div>