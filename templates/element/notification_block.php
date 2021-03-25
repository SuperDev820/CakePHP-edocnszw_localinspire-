<?php if ($notifications_total_count  > 0) { ?>
    <?php foreach ($notifications as $key => $notification) { ?>
        <?php $url = json_decode($notification->url, true); ?>
        <div class="media align-items-center notification_content mb-3 mt-1 <?= $notification->viewed ? '' : 'unread' ?>">
            <div class="mr-3">
                <span class="" data-toggle="tooltip" data-placement="right" title="<?= $notification->message ?>">
                    <?= $this->Custom->getNotificationIcon($notification->notification_type_id) ?>
                </span>
            </div>
            <?php if (!empty($url)) : ?>
                <a href="<?= $this->Url->build(['prefix' => $url['prefix'], 'controller' => $url['controller'], 'action' => $url['action'], (!empty($url[0]) ? $url[0] : ''), (!empty($url[1]) ? $url[1] : ''), (!empty($url[2]) ? $url[2] : '')]) ?>" class="notification_link" data-notificationid="<?= $notification->id ?>">
                    <span class="d-block text-dark"> <?= $notification->message ?></span>
                    <small class="d-block"> <?= $notification->description ?></small>
                </a>
            <?php else : ?>
                <span class="d-block text-dark"> <?= $notification->message ?></span>
                <small class="d-block"> <?= $notification->description ?></small>
            <?php endif; ?>
        </div>
    <?php } ?>

<?php } else { ?>
    <div class="card pt-3 mb-4 text-center pb-4 notification_content">
        <i class="fas fa-images fa-3x"></i>
        <h5>
            <h4 class="bold">No Notifications at the moment</h4>
            <!-- hasn't posted any photos and reviews yet. -->
        </h5>
    </div>

<?php } ?>