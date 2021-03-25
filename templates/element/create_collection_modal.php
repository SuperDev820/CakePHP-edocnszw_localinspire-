<div id="createModal" class="js-modal-window u-modal-window" style="width: 600px;">
    <div class="card pt-3 mb-9">
        <!-- Header -->
        <header class="bg-white py-3 px-5">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h5 mb-0 bold"><i class="fas fa-plus mr-2"></i>New Collection</h3>

                <button type="button" class="close" aria-label="Close" onclick="Custombox.modal.close();">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </header>
        <!-- End Header -->

        <div class="card-body bg-white">

            <!-- Content Step Form -->
            <div id="contentStepForm" class="p-5">
                <div id="selectPlayerStep" class="active">
                    <!-- Recent Payers List -->
                    <div id="recentPayersList" data-target-group="idAddNewPayer">

                        <!-- List Name -->
                        <?php echo $this->Form->create($collection, ['id' => 'new_collection', 'class' => 'js-validate form form-horizontal', 'enctype' => 'multipart/form-data']) ?>
                        <div class="js-form-message">
                            <label id="title" class="bold">
                                Collection Name
                            </label>
                            <div class="form-group">
                                <?= $this->Form->control('name', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control',  'id' => 'collectionName', 'placeholder' =>  "Collection Name", 'autocomplete' => 'off', "required"]) ?>
                            </div>
                        </div>
                        <!-- End List Name -->
                        <div class="">
                            <label id="description" class="bold">
                                Description
                            </label>
                            <div class="form-group">
                                <?= $this->Form->control('description', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'id' => 'collectionDescription', 'placeholder' =>  "Collection Description", 'autocomplete' => 'off', "required"]) ?>
                            </div>
                        </div>








<div class="row">
    <!-- Input -->
    <div class="col-sm-12 mb-4">
        <div class="js-form-message">
            <label id="organizationLabel" class="bold">
                Privacy Settings

            </label>

            <div class="col-sm-12">
                <div class="form-group">
                    <div data-toggle="tooltip" data-placement="top" title="The public cannot see this." class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="private" name="private" value="1" class="custom-control-input" <?= ($collection->private) ? " checked" : "" ?> />
                        <label class="custom-control-label" for="private">Private</label>
                    </div>
                    <div data-toggle="tooltip" data-placement="top" title="The public can see this." class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="public" name="private" value="0" class="custom-control-input" <?= (!$collection->private) ? " checked" : "" ?> />
                        <label class="custom-control-label" for="public">Public</label>
                    </div>
                </div>
                A public Collection can be seen by others. A private Collection is not visible to others.

            </div>
        </div>
    </div>
    <!-- End Input -->





                      
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-primary mr-1" data-next-step="#paymentDetailsStep">Create & Save</button>

                        </div>
                        <?= $this->Form->end() ?>
                        <!-- End Buttons -->
                    </div>
                </div>
            </div>
            <!-- End Form -->
        </div>
    </div>
</div>