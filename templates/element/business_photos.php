<?php if (!empty($all_business_photos)) : ?>

    <div class="row no-gutters" id="aniimated-thumbnials">
        <?php
        $show_count = count($all_business_photos) > 4 ? 4 : count($all_business_photos);
        $div = $show_count == 0 ? 12 : 12 / $show_count; ?>
        <?php 
        for ($i = 0; $i < $show_count; $i++) {
            $photo = $all_business_photos[$i];
        ?>

            <?= $this->element('photo_block', ['photo' => $photo, 'show_count' => $show_count, 'div' => $div, 'i' => $i]) ?>

        <?php } ?>
        <?php if (count($all_business_photos) > 4) { ?>
            <?php for ($i = 4; $i < count($all_business_photos); $i++) {
                $photo = $all_business_photos[$i]; ?>
                <div style="display:none">
                    <?= $this->element('photo_block', ['photo' => $photo, 'show_count' => $show_count, 'div' => $div, 'i' => $i]) ?>
                </div>

            <?php } ?>
        <?php } ?>




    </div>


    <script>
        $(document).ready(function() {


            var $imagegallery = $('#aniimated-thumbnials');
            // $('#aniimated-thumbnials').html(data);
            $imagegallery.lightGallery({
                thumbnail: true,
                selector: 'a.gallery',
                appendSubHtmlTo: '.md-item',
                addClass: 'fb-comments',
                mode: 'lg-fade',
                download: false,
                enableDrag: false,
                enableSwipe: false,
                mousewheel: false,
                zoom: false,
                fullScreen: false,
                galleryId: 1
            });

            $('#aniimated-thumbnials').on('onAfterSlide.lg', function(event, prevIndex, index) {
                if (!$('.lg-outer .lg-item').eq(index).attr('data-fb')) {
                    try {
                        $('.lg-outer .lg-item').eq(index).attr('data-fb', 'loaded');
                        FB.XFBML.parse();
                    } catch (err) {
                        $(window).on('fbAsyncInit', function() {
                            $('.lg-outer .lg-item').eq(index).attr('data-fb', 'loaded');
                            FB.XFBML.parse();
                        });
                    }
                }
            });
            $('[data-toggle="tooltip"]').tooltip();

        });
    </script>

<?php endif; ?>