<?php if (!empty($filter->subcategories)) : ?>
    <?php foreach ($filter->subcategories as $subcat) : ?>

        <?php if (isset($searchPage) and $searchPage == true) : ?>
            <div class="custom-control custom-checkbox">
                <?= $this->Form->control('subcategories._ids[]', ['templates' => ['inputContainer' => '{{content}}'], 'name' => 'subcategories[_ids][]', 'label' => false, 'type' => 'checkbox', 'class' => 'custom-control-input filtercontrol', 'value' => $subcat->id, 'id' => 'subcategories-ids-' . $subcat->id, 'hiddenField' => false, "data-filtername" => $subcat->name]) ?>
                <label class="custom-control-label" for="<?= 'subcategories-ids-' . $subcat->id ?>" style="line-height: 2;">
                    <?= !empty($subcat) ? $subcat->name : "" ?>
                </label>
            </div>
        <?php else : ?>
            <div class="col-md-4 col-6 mb-0">
                <?= $this->Form->control('subcategories._ids[]', [
                                'templates' => ['inputContainer' => '{{content}}'], 'name' => 'subcategories[_ids][]', 'label' => false, 'type' => 'checkbox', 'class' => 'mr-1 checkmark radio', 'value' => $subcat->id,
                                (!empty($business) ? $this->Custom->getSelectedSubcats($business, $subcat)  : ''), 'id' => 'subcategories-ids-' . $subcat->id, 'hiddenField' => false
                            ]) ?>
                <label style="cursor:pointer"  class="font-size-1" for="<?= 'subcategories-ids-' . $subcat->id ?>">
                    <?= $subcat->name ?>
                </label>
            </div>

        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>


<style>


/* Create a custom checkbox */
.checkmark {
  
  height: 18px;
  width: 18px;
  background-color: #eee !important;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;

</style>