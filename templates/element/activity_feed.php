<div class="card">
    <div class="card-body pt-4 pb-5 px-5 mb-3 mb-md-0">

        <h3 class="h5 font-weight-semi-bold">Activity Feed <span style="float:right;font-size: .7em;"><a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'account', 'action' => 'notifications']); ?>">View all</a></span></h3>
        <hr class="mt-3 mb-4">

        <div class="overflow-hidden">
            <div class="js-scrollbar pr-3" style="max-height: 300px;">
                <!-- Activity Feed -->
                <?php if ($notifications_total_count  > 0) { ?>
                    <ul class="list-unstyled u-indicator-vertical-dashed">
                        <?php $showNotificationCount = 1; ?>
                        <?php foreach ($notifications as $key => $notification) { ?>
                            <?php if ($showNotificationCount <= 5) { ?>
                                <?php $url = json_decode($notification->url, true); ?>
                                <li class="media u-indicator-vertical-dashed-item">
                                    <span class="btn btn-xs btn-icon btn-primary rounded-circle mr-3">
                                        <span class="btn-icon__inner"> <?= $this->Custom->getNotificationIcon($notification->notification_type_id) ?></span>
                                    </span>
                                    <div class="media-body">
                                        <?php if (!empty($url)) : ?>
                                            <a href="<?= $this->Url->build(['prefix' => $url['prefix'], 'controller' => $url['controller'], 'action' => $url['action'], (!empty($url[0]) ? $url[0] : ''), (!empty($url[1]) ? $url[1] : ''), (!empty($url[2]) ? $url[2] : '')]) ?>" class="notification_link" data-notificationid="<?= $notification->id ?>">
                                                <h5 class="font-size-1 mb-1"><span class="bold"><?= $notification->message ?></span></h5>
                                                <!-- <small class="d-block"> <?= $notification->description ?></small> -->
                                            </a>
                                        <?php else : ?>
                                            <h5 class="font-size-1 mb-1"><span class="bold"><?= $notification->message ?></span></h5>
                                        <?php endif; ?>

                                        <small class="d-block text-muted mb-2"> <?= $this->Time->timeAgoInWords($notification->created) ?></small>
                                    </div>
                                </li>
                            <?php } ?>
                            <?php $showNotificationCount++; ?>
                        <?php } ?>

                    </ul>
                    <!-- End Activity Feed -->

                <?php } else { ?>
                    <div class="card pt-3 mb-4 text-center pb-4 notification_content">
                        <i class="fas fa-images fa-3x"></i>
                        <h5>
                            <h4 class="bold">No Notifications at the moment</h4>
                            <!-- hasn't posted any photos and reviews yet. -->
                        </h5>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>
</div>