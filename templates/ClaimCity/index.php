<?php $this->assign('title', 'Claim Cities'); ?>
<link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/datatables/dataTables.checkboxes.css">
<script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/datatables/dataTables.checkboxes.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<style>
    .pro-price .full_price {
        font-size: 20px;
    }
 .full_price_top {
         color: green;
        display: inline-block;
        font-size: 20px;
        font-weight: 600;
       
 }
    .full_price {
        color: #555555;
        display: inline-block;
        font-size: 16px;
        font-weight: 400;
        text-decoration: line-through;
    
    }

    .pro-price .price {
        font-size: 30px;
        font-weight: 600;
        line-height: 30px;
    }

    .price {
        color: green;
        font-size: 18px;
        font-weight: 600;
        padding-right: 8px;
    }

    .savings {
        background: orange none repeat scroll 0 0;
        color: #ffffff;
        display: inline-block;
        font-size: 13px;
        font-weight: 400;
        height: 30px;
        line-height: 30px;
        padding: 0 15px;
        text-align: center;
        text-transform: uppercase;
        vertical-align: top;
    }
</style>

<!-- ========== MAIN ========== -->
<main class="bg-light" id="content" role="main">
    <!-- Hero Section -->
    <div id="SVGhireUsBg" class="svg-preloader position-relative gradient-half-primary-v1">
        <div class="container space-2">
            <div class="row justify-content-lg-between align-items-center">
                <div class="col-md-6">
                    <h1 class="display-4 font-size-md-down-5 text-white mb-4"><strong>Become City Manager of <span class="text-warning"><?= $cityToClaim->name ?>, <?= strtoupper($cityToClaim->state->code) ?></span></strong></h1>
                    <p class="leadmd text-white">With An Estimated City Population of <?= number_format($cityToClaim->population) ?>
                        For Only <span class="text-warning bold">$<?= number_format($cityToClaim->price, 2) ?></span> Per Month!</p>
                </div>
                <div class="col-md-6">

                    <figure class="ie-buyer">
                        <img class="js-svg-injector" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/buyer.svg" alt="Image Description" data-parent="#SVGbuyer">
                    </figure>

                </div>
            </div>
        </div>

        <!-- SVG Background -->
        <figure class="position-absolute right-0 bottom-0 left-0">
            <img class="js-svg-injector" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/wave-1-bottom-sm.svg" alt="Image Description" data-parent="#SVGhireUsBg">
        </figure>
        <!-- End SVG Background Section -->
    </div>
    <!-- End Hero Section -->
    <!-- Hero Section -->
     <!-- <div class="container border mt-2 bg-white pb-4">
        <div class="text-center p-5 w-75 ml-10 mr-10">
            <h1 class="bold text-center">

                Secure your City Now And Make Money...
                My Goal Is To Make A Family Friendly Local Business Directory That Inspires Businesses To Be Great... </h1>
        </div>


        <div class="w-75 ml-10 mr-10">
            <P>Hello Friend,</P>

            <p>What does any of that have to do with you? Well, I could give a long sales pitch as to how much you can earn and benefit from claiming your city and securing your spot in what could be the next big thing...</p>

            <p>I won't do that, all I will say is I truly feel localinspire is going to explode onto the scene, it's not your typical site where the guy who owns the site makes all the money, it's a site designed to grow fast and create an income flow for all who secure a city or multiple cities.</p>

            <p class="h4 bold">It works like this:</p>

            <ul class="list-unstyled">
               
                <li class="u-indicator-steps py-3">
                    <div class="media align-items-center border rounded p-5">
                        <div class="d-flex u-indicator-steps__inner mr-3">
                            <span class="display-4 text-primary font-weight-medium">1.</span>
                        </div>
                        <div class="media-body">
                            <p class="mb-0">You secure your city or multiple cities for a small price.</p>
                        </div>
                    </div>
                </li>
              
                <li class="u-indicator-steps py-3">
                    <div class="media align-items-center border rounded p-5">
                        <div class="d-flex u-indicator-steps__inner mr-3">
                            <span class="display-4 text-primary font-weight-medium">2.</span>
                        </div>
                        <div class="media-body">
                            <p class="mb-0">You get 90% of <b>ALL</b> the income made from your city from businesses who sponsor their listing or pay to manage their listing.</p>
                        </div>
                    </div>
                </li>
              
                <li class="u-indicator-steps py-3">
                    <div class="media align-items-center border rounded p-5">
                        <div class="d-flex u-indicator-steps__inner mr-3">
                            <span class="display-4 text-primary font-weight-medium">3.</span>
                        </div>
                        <div class="media-body">
                            <p class="mb-0">You get equal share of the income generated from Google adsense.</p>
                        </div>
                    </div>
                </li>
               
                <li class="u-indicator-steps py-3">
                    <div class="media align-items-center border rounded p-5">
                        <div class="d-flex u-indicator-steps__inner mr-3">
                            <span class="display-4 text-primary font-weight-medium">4.</span>
                        </div>
                        <div class="media-body">
                            <p class="mb-0">When we add certain income opportunities you'll get a piece of the action.</p>
                        </div>
                    </div>
                </li>
                
            </ul>

            <p> Now, obviously this is an amazing offer which you’ll probably never see from any other
                business in the world.</p>

            <h3>Think about it.</h3 <p>I’m personally giving you a peace of my business, a profit-producing business for you up front without you having to do any of the work or headache.
            Plus, I’m taking it one BOLD step further by guaranteeing you’ll find this free plan
            immensely valuable – or – use it without me, just for taking your time with me.
            Just tell me, and it’s yours. No questions asked.
            Who Else Would Do That?
            NOBODY. (I checked). </p>

            <p> </p>
        </div>-->

        <div class="container p-8">
            <div class="row">
                <div class="col-md-6">
                    <h5>Add Surrounding Cities For <?= $options->city_discount ?>% Discount Today! </h5>
                </div>
                <div class="col-md-6 calculated_price">
                    <div class="pro-price float-right">
                        <span class="full_price_top"></span>
                        <!---<span class="price  hide"></span>--->
                        <!---<span class="savings"></span>--->
                    </div>
                </div>
            </div>
            <div id="alert-container">
            </div>
            <div class="row">
                <div class="table-responsive col-sm-12">
                    <table class="table table-striped table-bordered file-export" id="cities_table">
                        <thead>
                            <tr>
                                <th>
                                </th>
                                <th>City</th>
                                <th>Population</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END PAGE LEVEL JS-->

            <?php //echo $this->element('datatable_options', ['export' => false, 'ordering' => false, 'searching' => true, 'paging_and_search_multiple' => true, "export" => false, "record_name" => "cities", 'specific_id' => 'city_table', "ajax_table" => true, "autoreload" => false, "ajax_url" => $this->Url->build(['prefix' => false, 'controller' => 'AjaxTable', 'action' => 'claimcity', (isset($cityToClaim) ? $cityToClaim->id : '')])]) 
            ?>
            <br style="clear: left;">
            <?= $this->Form->create(null, ['class' => '', 'id' => 'citySubForm', 'enctype' => 'multipart/form-data']) ?>
            <?php //echo $this->Form->hidden('cities_ids', ['value' => '']); 
            ?>
            <div class="bottom_container">
                <!-- Checkbox -->
                <div class="js-form-message mb-5">
                    <div class="custom-control custom-checkbox d-flex align-items-center text-muted">
                        <input type="checkbox" class="custom-control-input" id="termsCheckbox" name="termsCheckbox" required data-msg="Please accept our Terms and Conditions." data-error-class="u-has-error" data-success-class="u-has-success">
                        <label class="custom-control-label" for="termsCheckbox">
                            <small>
                                By purchasing I am agreeing to the <a class="link-muted" href="<?= $this->Url->build(['controller' => 'terms', 'action' => 'index']); ?>">Localinspire Terms of Use</a>

                            </small>
                        </label>
                    </div>
                </div>
                <!-- End Checkbox -->

            </div>

            <div class="row">
                <div class="col-md-3">
                    <!-- <button type="submit" id="show" class="btn btn-primary mt-3"><b>Buy Now!</b></button> -->
                    <?= $this->Form->button('Buy Now!', ['escape' => false, 'class' => 'btn btn-raised btn-primary', 'id' => 'payButton']); ?>
                </div>
                <div class="col-md-6 calculated_price">
                    <div class="pro-price float-right">
                        <!-- <p class="d-flex"> -->
                        <span class="full_price"></span>
                        <span class="price"></span>
                        <span class="savings"></span>
                        <!-- </p> -->
                    </div>
                </div>
            </div>

            <?= $this->Form->end() ?>
        </div>
    </div>

    <br>
    <br>
</main>
<!-- ========== END MAIN ========== -->

<script>
    var selections = ["<?php echo $cityToClaim->id ?>"];
    var selections = [];
</script>

<?= $this->element('datatable_options', ["record_name" => (!empty($record_name) ? $record_name : 'cities'), 'specific_id' => 'cities_table', "ajax_table" => true, 'pagination' => false, 'no_info' => true, 'ordering' => false, 'paging_and_search_multiple' => true, "autoreload" => false, "export" => false, "autoreload" => false, "ajax_url" => $this->Url->build(['prefix' => false, 'controller' => 'AjaxTable', 'action' => 'claimcity', (isset($cityToClaim) ? $cityToClaim->id : '')])]) ?>


<script>
    var payButton;
    var sessionid;
    var stripe = Stripe('<?= $api_pub_key ?>');

    function isBusinessOwner() {
        swal("Oops!", "Bussiness owners are not allowed to purchase cities", "error");
    }

    function redirectToCheckout() {
        if (sessionid) {
            stripe.redirectToCheckout({
                // Make the id field from the Checkout Session creation API response
                // available to this file, so you can provide it as parameter here
                // instead of the {{CHECKOUT_SESSION_ID}} placeholder.
                sessionId: sessionid
            }).then(function(result) {
                // If `redirectToCheckout` fails due to a browser or network
                // error, display the localized error message to your customer
                // using `result.error.message`.
                // swal("Error", result.error.message, "error");
                swal("Error", result.error.message, "info");
            });
        } else {
            swal("Error", "Invalid Session. Please reload the page and try again", "error");
        }
    }

    function calculateCityPrices(checkout = false) {

        // $("input[name=cities_ids]").val(JSON.stringify(selections));
        if (!checkout) {
            $('.calculated_price').fadeOut();
        }
        block();
        payButton.prop('disabled', true);

        if (selections) {
            // $('#subcatdiv').hide("slow");
            $('#citydiv').fadeOut();

            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'calculateCityPrices']); ?>",
                data: {
                    selections: JSON.stringify(selections),
                    city_id: "<?= (isset($cityToClaim) ? $cityToClaim->id : '') ?>",
                    checkout: checkout,
                },
                method: "post",
                success: function(response) {
                    unblock();
                    if (response.success) {
                        $('.full_price_top').html("$" + response.full_price);
                        $('.full_price').html("$" + response.full_price);
                        $('.price').html("$" + response.price);
                        $('.savings').html("You Save $" + response.savings);
                        $('.calculated_price').fadeIn();

                        if (response.stripe) {
                            sessionid = response.stripe.session.id;
                        }

                        payButton.prop('disabled', false);
                        if (checkout) {
                            if (response.isBusinessOwner) {
                                isBusinessOwner();
                            } else {
                                redirectToCheckout();
                            }
                        }
                    }
                    // $('.calculated_price').html(response);
                },
                error: function(error) {
                    console.log(error);
                    unblock();
                    payButton.prop('disabled', false);
                }
            });
        }
    }

    $(document).ready(function() {

        payButton = $('#payButton');

        $('.calculated_price').fadeOut();
        calculateCityPrices();
        cities_table_table.on("select deselect", function() {
            selections = $.map(cities_table_table.rows('.selected').data(), function(item) {
                return $(item[0]).attr('itemid');
            });
            calculateCityPrices();
        });

        $('#citySubForm').on('submit', function(e) {
            e.preventDefault();
            if (Array.isArray(selections) && selections.length) {} else {
                swal("Oops!", "Please select at least one city", "info");
                return;
            }
            if (!$(this).valid()) return false;
            if (loggedIn) {
                // $('#citySubForm').unbind('submit').submit();
                // redirectToCheckout();
                calculateCityPrices(true);
            } else {
                $('.signuphide').hide();
                $(".loginn").trigger('click');
                iscitySubForm = true;
            }
        });


    });
</script>