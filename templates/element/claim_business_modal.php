<div id="claimBusinessModal" class="js-modal-window u-modal-window" style="width: 500px;">
    <div class="card mb-9">
        <!-- Header -->
        <header class="card-header bg-light py-3 px-5">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h6 bold mb-0">Claim your free listing</h3>

                <button type="button" class="close" aria-label="Close" onclick="Custombox.modal.close();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </header>
        <!-- End Header -->

        <div class="card-body bg-white p-5">

            <!-- <form id="claimBusinessform" class="js-validate" action="" method="POST"> -->
            <?php echo $this->Form->create($business, ['class' => 'form form-horizontal', 'id' => 'claimBusinessform', 'enctype' => 'multipart/form-data', 'url' => ['action' => 'claimBusiness', $business->id]]) ?>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <!-- <input type="phone" class="form-control" id="claimphone" placeholder="Enter business contact number" , required> -->
                <?= $this->Form->control('phone', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'type' => 'text', "pattern" => "\d*", 'id' => 'claimPhone', 'placeholder' => 'Enter business contact number', 'autocomplete' => 'off', 'required']) ?>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <?= $this->Form->control('business_role_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $busines_roles, 'empty' => false, 'label' => false, 'class' => 'form-control', "style" => "width: 100%", 'required']); ?>
            </div>
            <!-- Buttons -->
            <div class="d-flex pl-4">
                <!-- <button style="font-size:14px" type="submit" class="btn btn-primary mr-1 bold small" data-next-step="#paymentDetailsStep">Submit</button> -->
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary mr-1 bold small']); ?>

            </div>
            <!-- End Buttons -->
            <!-- </form> -->
            <?= $this->Form->end() ?>

        </div>
    </div>
</div>