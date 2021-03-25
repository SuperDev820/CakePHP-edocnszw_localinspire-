<?php $this->disableAutoLayout(); ?>
<?php foreach ($collections as $collection) : ?>
    <div class="mb-1">
        <div class="card-body">
            <div class="media d-block d-sm-flex justify-content-sm-between align-items-sm-center"><a href="#">
                    <div class="u-avatar mr-3">
                        <img class="img-fluid square-img55 mb-2 mb-sm-0" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/img/defauls_buisness_image.png" alt="Image Description">
                    </div>
                </a>
                <div class="media-body mb-2 mb-sm-0">
                    <a class="media" href="#">
                        <?php
                            if (!$collection->private) : ?>
                            <div class="mr-1">
                                <span class="badge badge-lg badge-light border rounded-circle mr-2 p-1" data-toggle="tooltip" data-html="true" data-placement="top" title="" data-original-title="<span class='font-size-10'>Public</span>"><i class="fas fa-unlock font-size-10"></i>
                                </span>
                            </div>
                        <?php else : ?>
                            <div class="mr-1">
                                <span class="badge badge-lg badge-success rounded-circle mr-2 p-1" data-toggle="tooltip" data-html="true" data-placement="top" title="" data-original-title="<span class='font-size-10'>Private</span>"><i class="fas fa-lock font-size-10"></i>
                                </span>
                            </div>
                        <?php endif; ?>
                        <div class="media-body mt-1 mb-2">
                            <span class="d-block text-dark"><?= $collection->name ?></span>
                        </div>
                    </a>
                    <!-- End Bookmark -->

                </div>
                <div class="media-body text-sm-right">
                    <?php
                        if ($this->Custom->businessInCollection($collection, $business)) : ?>

                        <button class="btn btn-light btn-sm borderlt mr-1 remove_list" data-value="<?= $collection->id ?>" data-business_id="<?= $business->id ?>" style="cursor:pointer;"><i class="fas text-danger fa-bookmark mr-1"></i> Remove</button>
                        <button class="btn btn-light btn-sm borderlt mr-1 save_list " data-value="<?= $collection->id ?>" data-business_id="<?= $business->id ?>" style="cursor:pointer;display:none;"><i class="fas text-primary fa-bookmark mr-1"></i> &nbsp; Save &nbsp;&nbsp;</button>
                    <?php else : ?>
                        <button class="btn btn-light btn-sm borderlt mr-1 remove_list" data-value="<?= $collection->id ?>" data-business_id="<?= $business->id ?>" style="cursor:pointer;display:none;"><i class="fas text-danger fa-bookmark mr-1"></i> Remove</button>
                        <button class="btn btn-light btn-sm borderlt mr-1 save_list " data-value="<?= $collection->id ?>" data-business_id="<?= $business->id ?>" style="cursor:pointer;"><i class="fas text-primary fa-bookmark mr-1"></i> &nbsp; Save &nbsp;&nbsp;</button>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Full Bookmark -->

<!-- End Full Bookmark -->
<script>
    $(document).ready(function() {

        $('[data-toggle="tooltip"]').tooltip();
    })
</script>