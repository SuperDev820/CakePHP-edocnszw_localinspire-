<div class="card">
    <div class="card-body pt-4 pb-5 px-5 mb-3 mb-md-0">
 <div class="customer-ratingbig mr-3"><i class="fas fa-store mt-1 mb-1"></i></div>
        <h3 class="h6 font-weight-semi-bold">Business Announcements <span style="float:right;font-size: .7em;"></span></h3>
        <hr class="mt-3 mb-5">


        <?php if (!empty($announcements)) { ?>
            <?php foreach ($announcements as $key => $annnouncement) { ?>
                <?php if ($this->Custom->canShow($annnouncement, $annnouncement->business)) { ?>
                    <!-- Owner Announcement -->
                    <div class="card pt-3 pl-3 pr-3 pb-0 mb-4">
                        <?= $this->element('business_announcement', ['annnouncement' => $annnouncement]) ?>
                    </div>
                    <!-- End Owner Announcement -->
                <?php } ?>
            <?php } ?>
        <?php } else { ?>
            <div class="card pt-3 mb-4 text-center pb-4 notification_content">
                <i class="fas fa-images fa-3x"></i>
                <h5>
                    <h4 class="bold">No announcements from businesses in your city at the moment</h4>
                    <!-- hasn't posted any photos and reviews yet. -->
                </h5>
            </div>
        <?php } ?>

    </div>
</div>