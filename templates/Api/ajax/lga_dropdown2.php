<?php $this->disableAutoLayout();?>  
<label class="col-md-2 control-label" for="lga_id">LGA</label>
<div class="col-md-6">
	<?=$this->Form->control('lga_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $lgas, 'empty' => true, 'label' => false, 'class' => 'form-control lga_select', "required", "default" => $lga_id]);?>
	<div class="form-control-focus"></div>
</div>
