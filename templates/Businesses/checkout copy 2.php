<?php $this->assign('title', "Checkout Subscription for " . $business->name . " - " . $business->city->name . ", " . strtoupper($business->city->state->code)); ?>


<link rel="stylesheet" type="text/css" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/cardjs/card-js.min.css">
<script src="<?= $this->Url->build('/', ['fullBase' => true]); ?>plugins/cardjs/card-js.min.js"></script>

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
                <div class="card shadow-sm">
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
                        <div class="mb-3 font-weight-medium"><?= $package->name ?></div>
                        <div class="media align-items-center">
                            <h3 class="h6 text-secondary mr-3">Price</h3>
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
                            <h3 class="h6 text-secondary mr-3">Tax</h3>
                            <div class="media-body text-right">
                                <span>$<?= $tax ?></span>
                            </div>
                        </div>
                        <!-- End Booking Summary -->

                        <hr class="my-5">

                        <!-- Total -->
                        <div class="media align-items-center">
                            <h3 class="h6 text-secondary mr-3">Total</h3>
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
                        <h6 class="h5">Subscription for <?= $business->name ?></h6>
                        <span><?= $this->Custom->displayCategoriesAndSubcategories($business, true) ?></span> <br>
                        <?= $business->city->name; ?>, <?= strtoupper($business->city->state->code); ?> - <?= $business->zip ?></span><br>
                        <span><?= $business->phone; ?></span>
                    </div>

                    <hr class="my-5">
                    <!-- <form class="js-validate"> -->
                    <?= $this->Form->create(null, ['class' => '', 'id' => 'paymentform']) ?>



                    <!-- Title -->
                    <!-- <div class="mb-4 mt-2">
                        <h2 class="h5">Payment option</h2>
                    </div> -->
                    <!-- End Title -->

                    <!-- Button Group -->
                    <!-- <div class="btn-group btn-group-toggle mb-6">
                        <a class="js-animation-link btn btn-sm btn-outline-secondary btn-sm-wide active" href="javascript:;" data-target="#creditCard" data-link-group="paymentMethods" data-animation-in="slideInUp">
                            Credit Card
                        </a>
                        <a class="js-animation-link btn btn-sm btn-outline-secondary btn-sm-wide" href="javascript:;" data-target="#payPal" data-link-group="paymentMethods" data-animation-in="slideInUp">
                            PayPal
                        </a>
                    </div> -->
                    <!-- End Button Group -->

                    <!-- Credit Card -->
                    <div id="creditCard" data-target-group="paymentMethods">
                        <div class="card-js mb-5" id="my-card" data-capture-name="true">

                            <?= $this->Form->control('card_number', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control card-number', 'placeholder' => 'Card Number', "required", "data-msg" => "Please enter a valid card number.", "data-error-class" => "u-has-error", "data-success-class" => "u-has-success"]) ?>
                            <?= $this->Form->control('card_holder', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control name', 'placeholder' => 'Card Holder Name', "aria-label" => "Ruchika Megh",  "required", "data-msg" => "Please enter a valid card holder.", "data-error-class" => "u-has-error", "data-success-class" => "u-has-success"]) ?>
                            <?= $this->Form->control('expiration_month', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control expiry-month', 'placeholder' => 'MM', "aria-label" => "MM/YY",  "required", "data-msg" => "Please enter a valid date.", "data-error-class" => "u-has-error", "data-success-class" => "u-has-success"]) ?>
                            <?= $this->Form->control('expiration_year', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control expiry-year', 'placeholder' => 'YY', "aria-label" => "MM/YY",  "required", "data-msg" => "Please enter a valid date.", "data-error-class" => "u-has-error", "data-success-class" => "u-has-success"]) ?>
                            <?= $this->Form->control('cvc', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control cvc', 'placeholder' => 'CVC', "aria-label" => "***",  "required", "data-msg" => "Please enter a valid CVC number.", "data-error-class" => "u-has-error", "data-success-class" => "u-has-success"]) ?>
                        </div>

                        <!-- Button -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="<?= $this->Url->build(['action' => 'upgrade', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>"><span class="fas fa-angle-left mr-2"></span> Back</a>
                            <!-- <button type="submit" class="btn btn-primary transition-3d-hover">Place order</button> -->
                            <?= $this->Form->button(__('Pay and Susbcribe'), ['type' => 'submit', 'value' => "Update Settings", 'class' => 'btn btn-primary transition-3d-hover', 'style' => '']); ?>
                        </div>
                        <!-- End Button -->
                    </div>
                    <!-- End Credit Card -->

                    <!-- Credit Card -->
                    <div id="payPal" style="display: none; opacity: 0;" data-target-group="paymentMethods">
                        <button type="submit" class="btn btn-block btn-warning transition-3d-hover">
                            Pay with
                            <img src="<?= $this->Url->build('/', ['fullBase' => true]); ?>/img/paypal2.png" style="width: 70px;" alt="PayPal logo">
                        </button>
                    </div>
                    <!-- End Credit Card -->

                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End Checkout Section -->

    <hr class="my-0">
</main>

<script>
    $(document).ready(function() {
        // jQuery(document).on('submit', '#paymentform', function(e) {
        // e.preventDefault();
        // var $this = $(this);


        // var myCard = $('#my-card');

        // var cardNumber = myCard.CardJs('cardNumber');
        // var cardType = myCard.CardJs('cardType');
        // var name = myCard.CardJs('name');
        // var expiryMonth = myCard.CardJs('expiryMonth');
        // var expiryYear = myCard.CardJs('expiryYear');
        // var cvc = myCard.CardJs('cvc');

        // if (!expiryMonth) {
        //     alert("Please enter card dates");
        //     return false;
        // }
        // console.log(myCard);
        // console.log(cardNumber);
        // console.log(cardType);
        // console.log(name);
        // console.log(expiryMonth);
        // console.log(expiryYear);
        // console.log(cvc);

        // });
    });
</script>