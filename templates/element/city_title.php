<div class="d-sm-flex justify-content-sm-between align-items-sm-center no-gutters mb-3">

    <div class="col-sm-9 ">
        <h4><?= $city_title ?> for <strong><?= $active_city->name . ', ' . strtoupper($active_city->state->code) ?></strong></h4>
    </div>

    <?php if (isset($switch) and $switch == false) { ?>
    <?php } else { ?>
        <div class="col-sm-3 ">
            <label class="bold">
                Correct city?
            </label>
            <?= $this->Form->control('active_city', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $userCitiesList, 'empty' => true, 'label' => false, "id" => "active_city_select", 'class' => 'select2 custom-select', "style" => "width: 100%", 'required', 'default' =>  $currentUser->active_city]); ?>
            <!-- Locations -->
        </div>
    <?php } ?>

</div>

<script>
    $(document).ready(function() {

        jQuery(document).on('change', '#active_city_select', function(e) {
            var city_id = $(this).select2('val');
            url = "<?= $this->Url->build(['controller' => 'manager', 'action' => 'switch']); ?>";
            url = updateQueryString('city_id', city_id, url);
            window.location.href = url;

        });


    });
</script>