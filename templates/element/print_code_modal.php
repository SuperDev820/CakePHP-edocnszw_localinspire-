<div class="modal" id="getcode" role="dialog">
    <div class="modal-dialog490 modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <H4 class="modal-title redTxt">Claim Special Offer</H4><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">

                        <h3>Free Fries With Purchase of Burger!</h3>

                        Free order of french fries with a purchase of any burger. One per customer. Offer valid for first visit only, no repeat visits will be allowed. <h3>Code: XcD124</h3>


                        <!-- End Print ONLY Offer Content -->

                        <div id="printThis" class="printMe" style="display:none">
                            <center>
                                <h3 class="bold">Panda Express Restaurant and Take out</h3>
                            </center>


                            <div class="specialcode-box">
                                <center>
                                    <h3 class="bold">Free Fries With Purchase of Burger!</h3>
                                </center>
                                Free order of french fries with a purchase of any burger. One per customer. Offer valid for first visit only, no repeat visits will be allowed. <h3>Code: XcD124</h3>
                            </div>
                        </div>

                        <!-- End Print ONLY Offer Content -->


                        <hr>
                        <input id="btnPrint" class="btn btn-sm btn-primary bold" type="button" value="Print Code">
                        <span></span>
                        <input class="btn btn-link" type="reset" value="Email me code">

                    </div>
                </div>
            </div>
        </div>
    </div></b>
</div>
<script>
    jQuery.fn.extend({
        printElem: function() {
            var cloned = this.clone();
            var printSection = $('#printSection');
            if (printSection.length == 0) {
                printSection = $('<div id="printSection"></div>')
                $('body').append(printSection);
            }
            printSection.append(cloned);
            var toggleBody = $('body *:visible');
            toggleBody.hide();
            $('#printSection, #printSection *').show();
            window.print();
            printSection.remove();
            toggleBody.show();
        }
    });

    $(document).ready(function() {
        $(document).on('click', '#btnPrint', function() {
            $('.printMe').printElem();
        });
    });
</script>