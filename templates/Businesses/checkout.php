<?php $this->assign('title', "Checkout Subscription for " . $business->name . " - " . $business->city->name . ", " . strtoupper($business->city->state->code)); ?>

<script src="https://js.stripe.com/v3/"></script>
<!-- <link rel="stylesheet" href="StripeElements.css"> -->

<!-- <link rel="stylesheet" type="text/css" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/cardjs/card-js.min.css"> -->
<!-- <script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/cardjs/card-js.min.js"></script> -->

<!-- <script src="https://js.stripe.com/v2/"></script> -->

<main id="content" role="main">
    <!-- Checkout Section -->
    <div class="container space-2">
        <!-- Title -->
        <!-- <div class="mb-9">
            <h1 class="h2 font-weight-normal">Checkout</h1>
        </div> -->
        <!-- End Title -->

        <div class="row">
            <div class="col-lg-4 order-lg-1 mb-9 mb-lg-0">
                <!-- Order Summary -->
                <div class="card ">
                    <div class="media align-items-center">
                        <img src="<?= $this->Custom->getBusinessPhotoUrl($business) ?>" class="img-fluid" alt="<?= $business->name ?>">
                    </div>
                    <div class="card-body p-5">

                        <!-- Product -->
                        <!-- <div class="media-body text-left">
                            <h6><?= $business->name ?></h6>
                            <span><?= $this->Custom->displayCategoriesAndSubcategories($business, true) ?></span> <br>
                            <?= $business->city->name; ?>, <?= strtoupper($business->city->state->code); ?> - <?= $business->zip ?></span><br>
                            <span><?= $business->phone; ?></span>
                        </div> -->
                        <!-- End Product -->


                        <!-- Contacts -->
                        <!-- <div class="media align-items-center">
                            <h3 class="h6 text-secondary mr-3">Phone</h3>
                            <div class="media-body text-right">
                                <span><?= $business->phone; ?></span>
                            </div>
                        </div> -->
                        <!-- <div class="media align-items-center">
                            <h3 class="h6 text-secondary mr-3">Website</h3>
                            <div class="media-body text-right">
                                <span>www.example.com</span>
                            </div>
                        </div> -->
                        <!-- End contacts -->


                        <!-- Booking Summary -->
                        <h5>Subscription Summary</h5>
                        <div class="mb-3 bold"><?= $package->name ?></div>
                        <div class="media align-items-center">
                            <h3 class="h6 mr-3 bold">Price</h3>
                            <div class="media-body text-right">
                                <span>$<?= $pricing ?></span>
                            </div>
                        </div>

                        <!-- <div class="media align-items-center">
                            <h3 class="h6 text-secondary mr-3">Reservation</h3>
                            <div class="media-body text-right">
                                <span>$30.00</span>
                            </div>
                        </div> -->
                        <div class="media align-items-center">
                            <h3 class="h6 mr-3 bold">Tax</h3>
                            <div class="media-body text-right">
                                <span>$<?= $tax ?></span>
                            </div>
                        </div>
                        <!-- End Booking Summary -->

                        <hr class="my-5">

                        <!-- Total -->
                        <div class="media align-items-center">
                            <h3 class="h6 mr-3 bold">Total</h3>
                            <div class="media-body text-right">
                                <span class="font-weight-semi-bold">$<?= number_format(($pricing + $tax), 2) ?></span>
                            </div>
                        </div>
                        <!-- End Total -->
                    </div>
                </div>
                <!-- End Order Summary -->
            </div>

            <div class="col-lg-8 order-lg-2">
                <div class="card-body">
                    <!-- <div class="">
                        <h2 class="h5">Checkout</h2>
                    </div> -->
                    <!-- Product -->
                    <div class="media-body text-left">
                        <h6 class="h5 bold"><?= $package->name ?> for <?= $business->name ?></h6>
                        <!---<span><?= $this->Custom->displayCategoriesAndSubcategories($business, true) ?></span>---> 
                        <?= $business->city->name; ?>, <?= strtoupper($business->city->state->code); ?> - <?= $business->zip ?></span><br>
                        <span><?= $business->phone; ?></span>
                         <h6 class="h5 mt-2 mb-2 bold">What you are getting!</h6>
                        
                        <?= $package->description  ?>
                    </div> 

                    <hr class="my-5">
                    <!-- <form class="js-validate"> -->


                    <!-- <form action="./charge.php" method="post" id="payment-form"> -->
                    <form id="subscription-form">
                        <div id="card-element" class="MyCardElement mb-5">
                            <!-- Elements will create input elements here -->
                        </div>

                        <!-- We'll put the error messages in this element -->
                        <div id="card-errors" role="alert" style="color: red;"></div>
                        <!-- <button type="submit">Subscribe</button> -->


                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="../biz/upgrade"><span class="fas fa-angle-left mr-2"></span> Back</a>
                            <!-- <button type="submit" class="btn btn-primary transition-3d-hover">Place order</button> -->
                            <?php //echo $this->Form->button(__('Pay and Susbcribe'), ['type' => 'submit', 'value' => "Pay", 'class' => 'btn btn-primary transition-3d-hover', 'style' => '', 'id' => 'payBtn']); 
                            ?>
                            <button type="submit" class="btn btn-primary ">Subscribe</button>
                        </div>

                    </form>
                    <!-- <button>Submit Payment</button> -->
                    <!-- </form> -->


                    <!-- <button>Submit Payment</button> -->
                    <!-- </div> -->


                    <!-- Button -->
                    <!-- <div class="d-flex justify-content-between align-items-center"> -->
                    <!-- <a href="<?= $this->Url->build(['action' => 'upgrade', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>"><span class="fas fa-angle-left mr-2"></span> Back</a> -->
                    <!-- <button type="submit" class="btn btn-primary transition-3d-hover">Place order</button> -->
                    <?php //echo $this->Form->button(__('Pay and Susbcribe'), ['type' => 'submit', 'value' => "Pay", 'class' => 'btn btn-primary transition-3d-hover', 'style' => '', 'id' => 'payBtn']); 
                    ?>
                    <!-- </div> -->
                    <!-- End Button -->
                </div>
                <!-- End Credit Card -->


                <?php //echo $this->Form->end() 
                ?>
                <!-- Credit Card -->
                <div id="payPal" style="display: none; opacity: 0;" data-target-group="paymentMethods">
                    <button type="submit" class="btn btn-block btn-warning transition-3d-hover">
                        Pay with
                        <img src="<?= $this->Url->build('/', ['fullBase' => true]); ?>/img/paypal2.png" style="width: 70px;" alt="PayPal logo">
                    </button>
                </div>
                <!-- End Credit Card -->
            </div>
        </div>
    </div>
    </div>
    <!-- End Checkout Section -->

    <hr class="my-0">
</main>
<script>
    // Stripe API Key
    var stripe = Stripe('<?= $api_pub_key ?>');
    var elements = stripe.elements();
    // Set up Stripe.js and Elements to use in checkout form
    var style = {
        base: {
            color: "#32325d",
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: "antialiased",
            fontSize: "20px",
            "::placeholder": {
                color: "#aab7c4"
            }
        },
        invalid: {
            color: "#fa755a",
            iconColor: "#fa755a"
        }
    };

    var cardElement = elements.create("card", {
        style: style,
        iconStyle: "solid",
        hidePostalCode: true
    });
    cardElement.mount("#card-element");
    // Handle real-time validation errors from the card Element.
    cardElement.addEventListener('change', ({
        error
    }) => {
        const displayError = document.getElementById('card-errors');
        if (error) {
            displayError.textContent = error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission
    var form = document.getElementById('subscription-form');

    form.addEventListener('submit', function(event) {
        // We don't want to let default form submission happen here,
        // which would refresh the page.
        event.preventDefault();

        block();

        stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
            billing_details: {
                email: '<?= $currentUser->email ?>',
            },
        }).then(stripePaymentMethodHandler);
    });
    // Send Stripe Token to Server
    function stripePaymentMethodHandler(result, email) {
        // console.log(result);
        unblock();
        if (result.error) {
            // Show error in payment form
            if (result.error.message) {
                toastr.error(result.error.message, "Oops!");
            } else {
                toastr.error("Something went wrong. Please try again", "Oops!");
            }
        } else {
            block();
            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'subscribe']); ?>",
                data: {
                    payment_method: result.paymentMethod.id,
                    package_id: "<?= $package->id ?>",
                    business_id: "<?= $business->id ?>",
                    duration: "<?= !empty($this->request->getQuery()['duration']) ? $this->request->getQuery()['duration'] : '' ?>",
                },
                success: function(response) {
                    // console.log(data);
                    unblock();
                    if (response.success) {
                        if (response.requires_action) {
                            handleSubscription(response);
                        } else {
                            navigateAway();
                        }
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                    unblock();
                }
            });

        }
    }


    function navigateAway() {
        window.location.href = "<?= $package->id == 3 ? $this->Url->build(['prefix' => false, 'controller' => 'biz', 'action' => 'feature'],  ['fullBase' => true]) : $this->Url->build(['prefix' => false, 'controller' => 'biz', 'action' => 'index'],  ['fullBase' => true]) ?>";
    }

    function handleSubscription(response) {
        block();
        // stripe.confirmCardPayment(response.stripe_subscription.payment_intent.client_secret).then(function(result) {
        stripe.confirmCardPayment(response.client_secret).then(function(result) {
            unblock();
            if (result.error) {
                toastr.error(result.error.message);
            } else {
                confirmSubscription(response.subscription.id);
            }
        });
    }

    function confirmSubscription(subscription_id) {
        block();
        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "POST",
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'confirmSubscription']); ?>",
            data: {
                subscription_id: subscription_id,
                package_id: "<?= $package->id ?>",
                business_id: "<?= $business->id ?>",
            },
            success: function(response) {
                // console.log(data);
                unblock();
                if (response.success) {
                    navigateAway();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(error) {
                console.log(error);
                unblock();
            }
        });
    }
</script>
<script>
    $(document).ready(function() {


    });
</script>