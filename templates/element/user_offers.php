<?php $showingOffer = false; ?>
<div class="offer_content">
    <?php if ($offers_total_count  > 0) { ?>
        <?php foreach ($offers as $key => $offer) { ?>
            <?php if ($this->Custom->canShow($offer, $offer->business)) { ?>
                <?php $showingOffer = true; ?>
                <!-- Owner Announcement -->
                <!-- <div class="card pt-3 pl-3 pr-3 pb-0 mb-4"> -->
                <?= $this->element('offers_block', ['business' => $offer->business, 'offer' => $offer]) ?>
                <!-- </div> -->
                <!-- End Owner Announcement -->
            <?php } ?>
        <?php } ?>
    <?php } ?>
    <?php if (!$showingOffer) { ?>
        <div class="card pt-3 mb-4 text-center pb-4 ">
            <i class="fas fa-images fa-3x"></i>
            <h5>
                <h4 class="bold">
                    No available business special offers yet</h4>
            </h5>
        </div>
    <?php } ?>
    <!-- End Review Details -->


    <script>
        $(document).ready(function() {
            //$('.show_more').css('display', "");
            // alert("yeah");

            $.SRCore.components.SRUnfold.init($('[data-unfold-target]'), {
                // afterOpen: function() {
                //     $(this).find('input[type="search"]').focus();
                // }
            });


        })
    </script>
</div>