<?php $this->assign('title', "Photos for "  . $business->name . " - " . $business->city->name . ", " . $business->city->state->code); ?>

<!-- ========== MAIN CONTENT ========== -->

<main class="gray-dark" id="content" role="main">

    <!-- Add Listing Section -->
    <div class="container pt-5 gray-darkspace-2">

        <div class="row no-gutters" id="aniimated-thumbnials">

        </div>
        <!-- Page Content -->
        <div class="container">


            <div class="row mb-0">
                <div class="col-10">

                    <h3 class="font-weight-light text-center text-lg-left mt-3">Photos for <a href="<?= $this->Url->build(['prefix'=>false,'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>"><?= $business->name ?></a></h3>

                </div>
                <div class="col-lg-2">
                    <a href="<?= $this->Url->build(['prefix'=>false,'controller' => 'businesses', 'action' => 'addPhotos', $business->id, \Cake\Utility\Text::slug(strtolower($business->name))]); ?>" class="btn btn-primary bold btn-sm  mt-3"><i class="fas fa-camera mr-1"></i> Add photos
                    </a></div>



            </div>


            <hr class="mt-2 mb-5">

            <div class="text-center" id="review_image_gallery">
                <?php foreach ($photos as $photo) { ?>
                    <?= $this->element('gallery_item', ['photo' => $photo, 'business' => $business]) ?>
                <?php } ?>
                <?php foreach ($review_photos as $photo) { ?>
                    <?= $this->element('gallery_item', ['photo' => $photo, 'is_review_photo' => true, 'business' => $business]) ?>
                <?php } ?>
            </div>

        </div>
        <!-- /.container -->
        <!--		<ul class="pagination justify-content-end">-->
        <!--			<li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a></li>-->
        <!--			<li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>-->
        <!--			<li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>-->
        <!--			<li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>-->
        <!--		</ul>-->
    </div>
    <div style="height:200px"></div>
    <!-- Report Photos Modal Window -->
    <?= $this->element('report_photo_modal') ?>
    <!-- End Report Photos Modal Window -->
    <!-- Report Success Modal Window -->
    <?= $this->element("success_modal") ?>
</main>
<script>
    $(document).ready(function() {
        // var photo_id = 123;

        // console.log(test);

        var $methods = $('#review_image_gallery');
        $methods.lightGallery({
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
            galleryId: 2
        });
        $methods.on('onAfterSlide.lg', function(event, prevIndex, index) {
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
        var is_loading_data = false;
        var page = 2;
        $(window).scroll(function() {
            console.log($(document).height() - $('#review_image_gallery').height() - $('footer').height());
            console.log($(window).scrollTop());
            if (!is_loading_data && $(window).scrollTop() > parseInt($(document).height() - $('#review_image_gallery').height() - $('footer').height() - 200)) {
                is_loading_data = true;


                return false; //added this line, TODO the bottom code




                $.ajax({
                    type: "POST",
                    url: base_url + "v/get_ajax_biz_photo",
                    data: {
                        page: page,
                        bid: "<?= $business->id ?>",
                    },
                    success: function(data) {
                        console.log(data);
                        $methods.append(data);
                        $methods.data('lightGallery').destroy(true);
                        page++;
                        is_loading_data = false;
                        $methods.lightGallery({
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
                            galleryId: 2
                        });
                        $methods.on('onAfterSlide.lg', function(event, prevIndex, index) {
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

                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            }
        });


    })
</script>