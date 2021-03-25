<?=$this->Form->create(null, ['class' => 'form', 'id' => 'chatform'])?>
<div class="type_msg">
    <div class="input_msg_write">
        <?=$this->Form->control('chat_message', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control chat_message write_msg', 'placeholder' => 'Type a message...', 'autocomplete' => 'off', 'type'=>'textarea', 'rows'=>'2'])?>
        <?=$this->Form->button(__('<i class="fas fa-paper-plane" aria-hidden="true"></i>'), ['class' => 'msg_send_btn', 'id' => 'chatSubmitBtn', 'style' => '']);?>
    </div>
</div>

<span>Ctrl + Enter to send </span>
<?=$this->Form->end()?>
