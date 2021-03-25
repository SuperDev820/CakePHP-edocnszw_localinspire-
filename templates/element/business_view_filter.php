<?php $subcatStr = ""; ?>
<?php if ($filter->form_type_id == 3) : /*dropdown*/ ?>
    <?php $subcatStr .=  $this->Custom->getAdditionalValue($business, $filter); ?>
<?php elseif ($filter->form_type_id == 1) : /*input*/ ?>
    <?php $subcatStr .=  $this->Custom->getAdditionalValue($business, $filter); ?>
<?php elseif ($filter->form_type_id == 2) : /*checkbox*/ ?>
    <?php foreach ($filter->subcategories as $subcat) {
            $subcatStr .=  $this->Custom->getSelectedSubcats($business, $subcat, true);
        }
        ?>
<?php elseif ($filter->form_type_id == 5) : /*slider*/ ?>
    <?php $subcatStr .=  $this->Custom->getSliderValue($business, $filter, false, true) . " - " . $this->Custom->getSliderValue($business, $filter, true, true); ?>
<?php else : ?>

<?php endif; ?>
<?php if (!empty($subcatStr)) : ?>
    <h6 class="mb-1 font-size-1 bold"><?= $filter->name ?></h6>
    <p class="mb-3 text-graylt">
        <?= $this->Custom->str_lreplace(",", "", $subcatStr) ?>
    </p>
<?php endif; ?>