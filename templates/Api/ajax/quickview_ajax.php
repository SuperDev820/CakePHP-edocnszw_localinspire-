<?php// $this->disableAutoLayout();?>
<div class="row">
    <?=$this->element('item_details', ['item' => $item, 'policy' => false])?>
</div>
<script>
 $('.thumb-menu').owlCarousel({
        loop: false,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 15,
        smartSpeed: 1000,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 3,
                autoplay: true,
                smartSpeed: 500
            },
            768: {
                items: 3
            },
            1000: {
                items: 3
            }
        }
    })
    $('.thumb-menu a').on('click', function () {
        $('.thumb-menu a').removeClass('active');
    })

    $('.lazy').Lazy({
        effect: "fadeIn",
    });
</script>
