<?php if (empty($notifications_values)) { ?>
    <?php if (isset($message_notification) and $message_notification == true) { ?>

        <div class="empty_unread_message" style="display: block">
            <div class="u-header__promo-item">
                <!-- SVG Icon -->
                <figure class="ie-chatting-girl after_login">
                    <img class="js-svg-injector" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/chatting-girl.svg" alt="Image Description" data-parent="#SVGchattingGirl">
                </figure>
                <!-- End SVG Icon -->
            </div>
            <!-- End Promo Item -->

            <!-- Promo Item -->
            <div class="after_login p-3 text-center u-header__promo-item unread_messages">
                <h6>No messages at this time...</h6>
            </div>
            <!-- End Promo Item -->
        </div>


        <script>
            $(function() {
                $('.new_message_dot').hide();
            });
        </script>

    <?php } else { ?>
        <!-- Promo Item -->
        <div class="u-header__promo-item">
            <!-- SVG Icon -->
            <figure class="ie-chatting-girl">
                <img class="js-svg-injector" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/pushing-boundaries.svg" alt="SVG Illustration" data-parent="#SVGcontactsSection">
            </figure>
            <!-- End SVG Icon -->
        </div>
        <!-- End Promo Item -->

        <!-- notifications Item -->
        <div class="p-3 text-center u-header__promo-item">
            <h6>No alerts at this time...</h6>
        </div>
        <!-- End notifications Item -->


        <script>
            $(function() {
                $('.new_notification_dot').hide();
            });
        </script>
    <?php } ?>



<?php } else { ?>
    <!-- Contacts  -->
    <div class="mb-2">
        <div class="pt-3 pb-2 px-2">
            <?php //echo json_encode($notifications_values) 
            ?>
            <?php foreach ($notifications_values as $key => $notification) { ?>
                <?php $url = json_decode($notification->url, true);
                $href = !empty($url) ?  $this->Url->build(['prefix' => $url['prefix'], 'controller' => $url['controller'], 'action' => $url['action'], (!empty($url[0]) ? $url[0] : ''), (!empty($url[1]) ? $url[1] : ''), (!empty($url[2]) ? $url[2] : '')]) : '#';
                ?>
                <!-- User -->
                <a class="d-flex align-items-start mb-3 notification_link" href="<?= $href ?>" data-notificationid="<?= $notification->id ?>">
                    <?php if (!empty($notification->message_user)) { ?>
                        <div class="position-relative u-avatar">
                            <img style="width:45px;height:45px" class="u-avatar border rounded-circle" src="<?= $this->Custom->getDp($notification->message_user->image, 'users', '350x250') ?>" alt="<?= $notification->message_user->name_desc ?>">
                        </div>
                     <?php } else { ?><i class="fas fa-3x text-dark fa-exclamation-circle"></i><?php } ?>

                    <div class="ml-3">
                        <span class="text-dark txt-12"> <?= $notification->message ?></span>
                        <small class="text-secondary"> on <?= $this->Custom->niceDateMonthDayYear($notification->created) ?></small>
                    </div>
                </a>
                <!-- End User -->
            <?php } ?>
        </div>

    </div>
    <!-- End Contacts  -->
    <div class="row pb-3 pt-2 border-top">
        <div class="col-md-6 txt-12 text-center">
            <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'Account', 'action' => 'notifications']); ?>">View all</a>
        </div>
        <div class="col-md-6 txt-12 text-center">
            <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'markAllAsRead']); ?>">Mark all as read</a>
        </div>
    </div>


    <?php if (isset($message_notification) and $message_notification == true) { ?>
        <script>
            $(function() {
                $('.new_message_dot').show();
            });
        </script>
    <?php } else { ?>

        <script>
            $(function() {
                $('.new_notification_dot').show();
            });
        </script>
    <?php } ?>
<?php } ?>