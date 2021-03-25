<div class="col-md-12 col-12">

    <!-- Range Slider -->
    <input class="js-range-slider" type="text" data-extra-classes="u-range-slider u-range-slider-indicator u-range-slider-grid" data-type="double" data-grid="true" filtername="<?= $filter->name ?>" data-prefix="$" data-hide-from-to="false" data-min="<?= $filter->form_type->min ?>" data-max="<?= $filter->form_type->max ?>" data-from="<?= !empty($this->Custom->getSliderValue((!empty($business) ? $business : null), $filter)) ? $this->Custom->getSliderValue((!empty($business) ? $business : null), $filter) : $filter->form_type->min ?>" data-to="<?= !empty($this->Custom->getSliderValue((!empty($business) ? $business : null), $filter, true)) ? $this->Custom->getSliderValue((!empty($business) ? $business : null), $filter, true) : $filter->form_type->max ?>" data-step="<?= $filter->form_type->step ?>" data-result-min="#<?= "min_" . $filter->id . "_" . $key ?>" data-result-max="#<?= "max_" . $filter->id . "_" . $key ?>">

    <div class="d-flex justify-content-between mt-4">
        <input name="additionals[<?= $filter->id ?>][value]" type="text" class="form-control max-width-12 filtercontrol" id="<?= "min_" . $filter->id . "_" . $key ?>" value="<?= $this->Custom->getSliderValue((!empty($business) ? $business : null), $filter) ?>">
        <input name="additionals[<?= $filter->id ?>][value2]" type="text" class="form-control max-width-12 mt-0 filtercontrol" id="<?= "max_" . $filter->id . "_" . $key ?>" value="<?= $this->Custom->getSliderValue((!empty($business) ? $business : null), $filter, true) ?>">
    </div>
</div>
<!-- End Range Slider -->