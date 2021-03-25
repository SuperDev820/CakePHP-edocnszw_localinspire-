<div class="row">
    <!-- Input -->
    <div class="col-sm-12 mb-3">
        <div class="js-form-message">
            <label id="title" class="bold">
                Collection Name
            </label>
            <div style="margin-bottom:8px">
                <small class="form-text text-muted">Name your collection, be creative (e.g. Favorite restaurants in Texas).</small>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="name" name="name" value="<?= isset($collection['name']) ? $collection['name'] : "" ?>" placeholder="Collection Name" required>
            </div>
        </div>
    </div>
    <!-- End Input -->

    <!-- Input -->
    <div class="col-sm-12 mb-3">
        <div class="js-form-message">
            <label id="description" class="bold">
                Description
            </label>
            <div style="margin-bottom:8px">
                <small class="form-text text-muted">Enter the description you would like for this collection.</small>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="description" name="description" value="<?= isset($collection['description']) ? $collection['description'] : "" ?>" placeholder="Collection Description">
            </div>
        </div>
    </div>
    <!-- End Input -->

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

    <!-- Input -->

    <!-- End Input -->
</div>