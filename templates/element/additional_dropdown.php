<?= $this->Form->control('additionals[' . $filter->id . '][value]', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $this->Custom->getFilterDropdownOptions($filter), 'empty' => (isset($emptyOption) and $emptyOption == true ? true : false), 'label' => false, 'id' => '', 'required', 'data-type' => $filter->input_type,'class' => 'form-control filtercontrol', "style" => "width: 100%", "data-filtername" => $filter->name]); ?>