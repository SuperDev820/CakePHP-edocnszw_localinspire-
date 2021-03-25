<?php echo $this->element('messaging_css') ?>
<div class="container">
    <!-- <h3 class=" text-center">Messaging Center</h3> -->
    <div class="messaging row">
        <div class="inbox_msg col-md-12">
            <div class="row">
                <div class="col-md-5">

                    <div class="">
                        <div class="headind_srch">
                            <div class="recent_heading">
                                <h4>Messaging</h4>
                            </div>
                            <div class="srch_bar">
                                <?php echo $this->Form->create(null, ['class' => '', 'enctype' => 'multipart/form-data']) ?>
                                <div class="stylish-input-group">
                                    <?=$this->Form->control('search', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => '', 'placeholder' => 'Search'])?>
                                    <span class="input-group-addon">
                                        <?= $this->Form->button(__('<i class="fa fa-search" aria-hidden="true"></i>'), ['class' => 'btn btn-info btn-round'], ['escape' => false]); ?>
                                    </span>
                                </div>
                                <?= $this->Form->end() ?>
                            </div>
                        </div>

                        <?php if (!empty($conversations)) : ?>
                            <div class="inbox_chat">
                                <?php foreach ($conversations as $key => $conversation) : ?>
                                    <?php
                                    $user;
                                    if ($currentUser->id == $conversation->user->id) {
                                        $user = $conversation->receiver;
                                    } else {
                                        $user = $conversation->user;
                                    }
                                    ?>
                                    <div class="chat_list <?= $key == 0 ? 'active_chat' : '' ?>" data-user="<?= ucwords($this->Custom->getUserDisplayName($user)) ?>" data-userimage="<?= $this->Custom->dpUrl($user->image, 'users', '100x100') ?>" data-receiverid="<?= $user->id ?>" data-receiver_username="<?= $user->username ?>" data-receiver_full_name="<?= ucwords($user->name_desc) ?>">
                                        <div class="chat_people">
                                            <div class="chat_img">
                                                <img src="<?= $this->Custom->dpUrl($user->image, 'users', '50x50') ?>" alt="sunil">
                                            </div>
                                            <div class="chat_ib">
                                                <h5><?= $this->Custom->getUserDisplayName($user) ?>
                                                    <!-- <span class="chat_date">Dec 25</span> -->
                                                </h5>
                                                <div class="status">
                                                    <i class="fas fa-circle <?= $this->Custom->userIsOnline($user) ? 'online' : 'offline' ?>" aria-hidden="true"></i>
                                                    <?= $this->Custom->lastSeen($user) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <?= $this->element('pagination_block', ['model' => 'Conversations', 'showPageBool' => true, "recordname" => "conversation(s)"]) ?>
                            </div>
                        <?php else : ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>You have no conversations at this time</p>
                                    <!-- <p>Send a message to users and your conversation history will be shown here</p> -->
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="headind_srch">
                        <div class="recent_heading">
                            <h4 id="target_user"><a class="target_user_link" href="<?= $this->Url->build(['prefix'=>false,'controller' => 'user', 'action' => 'index', $first_conversation_user->username]); ?>"><span class="receievername"><?= ucwords($first_conversation_user->name_desc) ?></span></a></h4>
                        </div>
                        <div class="srch_bar" id="block_unblock_box">
                            <?= $this->element('report_and_block', ['targetUser' => $first_conversation_user, 'iblockedUser' => $first_conversation_user->blockedUser]) ?>
                        </div>
                    </div>

                    <div class="panel-body" id="message_panel">
                        <ul class="chat" id="chat-history-list">
                        </ul>
                    </div>

                    <div class=" chat-history">
                        <?= $this->element('chat_message_form', ['chat_receiver' => $first_conversation_user]) ?>
                    </div>
                </div>
            </div>
        </div>


        <!-- <p class="text-center top_spac"> Design by <a target="_blank" href="#">Sunil Rajput</a></p> -->

    </div>
</div>