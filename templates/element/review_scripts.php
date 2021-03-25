<script>
  


    $(document).ready(function() {

        <?php if (isset($tips) and $tips == true) : ?>
            $('#advice_counts').text(<?= $review_total_count ?>);
        <?php else : ?>

        <?php endif; ?>

    


        // var showChar = 255; // How many characters are shown by default
        // var ellipsestext = "...";
        // var moretext = "Read more &nbsp;<i class='fa fa-caret-down'></i>";
        // var lesstext = 'Read less &nbsp;<i class="fa fa-caret-up"></i>';
        // $('.review_comment').each(function() {
        //     var content = $(this).html();
        //     // console.log(content.length);
        //     if (content.length > showChar) {
        //         var c = content.substr(0, showChar);
        //         var h = content.substr(showChar, content.length - showChar);
        //         var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="javascript:;" class="txt-12 mt-2 morelink">' + moretext + '</a></span>';

        //         $(this).html(html);
        //     }

        // });


        // $(".morelink").click(function() {
        //     if ($(this).hasClass("less")) {
        //         $(this).removeClass("less");
        //         $(this).html(moretext);
        //     } else {
        //         $(this).addClass("less");
        //         $(this).html(lesstext);

        //     }

        //     $(this).parent().prev().toggle('fast');
        //     $(this).prev().toggle('fast');

        //     return false;
        // });


        $('.review_image_gallery').lightGallery({
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


        $('.review_image_gallery').on('onAfterSlide.lg', function(event, prevIndex, index) {
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





    })
</script>