<?= $this->Form->create(null, ['class' => 'login-form']) ?>
<div class="form-group">
    <?= $this->Form->control('username_or_email', ['label' => false, 'placeholder' => 'Email or Username', 'id' => 'inputEmail', 'class' => 'form-control placeholder-no-fix', 'autocomplete' => 'off', 'required']) ?>
</div>
<div class="form-group">
    <?= $this->Form->control('password', ['label' => false, "placeholder" => "Password", 'id' => 'inputPass', 'class' => 'form-control placeholder-no-fix', 'autocomplete' => 'off', 'required']) ?>
</div>

<?= $this->Form->hidden('query_params_json', ['value' => !empty($query_params_json) ? $query_params_json : '']) ?>

<div class="row">
    <div class="col-sm-6">
    </div>
    <div class="col-sm-6 text-right">
        <a href="<?=$this->Url->build(['prefix' => false, 'controller' => 'resetPassword', 'action' => 'index']);?>" class="link">Forgot Password?</a>
    </div>
</div>

<!-- <button type="submit" class="btn btn-secondary">Login </button> -->
<?= $this->Form->button(__('Login <i class="m-icon-swapright m-icon-white"></i>'), ['class' => 'button mt-2 mb-2 w-100']) ?>
<div class="text-center">
    <div class="small-text mt-1 link">Don't Have an Account? <a href="<?= $this->Url->build('/register', ['fullBase' => true]); ?>">Register Now</a></div>
</div>
<?= $this->Form->end() ?>