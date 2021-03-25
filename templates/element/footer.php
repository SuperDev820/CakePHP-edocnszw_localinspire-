<button style="display: none" type="button" href="" data-modal-target="#emailsignupModal" id="emailsignup" class="sharebutton btn btn-light btn-sm borderlt"><i class="far fa-share-square"></i> &nbsp; Share</button>
<div style="height:1px;background-color:#ddd"></div>

<div id="currentlocation"></div>
<footer class="container">
    <div class="row justify-content-lg-between space-2">
        <div class="col-6 col-md-4 col-lg-3 order-lg-2 ml-lg-auto mb-7 mb-lg-0">
            <h3 class="h6 font-weight-semi-bold">About</h3>

            <!-- List Group -->
            <ul class="list-group list-group-flush list-group-borderless mb-0">
                <li><a class="list-group-item list-group-item-action" href="<?= $this->Url->build('about', ['fullBase' => true]); ?>">About localinspire</a></li>
                
            </ul>
            <!-- End List Group -->
        </div>

        <div class="col-6 col-md-4 col-lg-3 order-lg-3 mb-7 mb-lg-0">
            <h3 class="h6 font-weight-semi-bold">Get listed</h3>

            <!-- List Group -->
            <ul class="list-group list-group-flush list-group-borderless mb-0">
               
                <li><a class="list-group-item list-group-item-action" href="<?= $this->Url->build(['controller' => "Businesses", 'action' => 'add']); ?>">Add a Business</a></li>
            </ul>
            <!-- End List Group -->
        </div>

        <div class="col-md-4 col-lg-2 order-lg-4 mb-7 mb-lg-0">
            <h3 class="h6 font-weight-semi-bold">Our Location</h3>

            <!-- List Group -->
            <ul class="list-group list-group-flush list-group-borderless mb-0">
                <li>
                    <a class="list-group-item list-group-item-action" href="../pages/help.html">
                        <span class="media align-items-center">
                            <span class="fas fa-info-circle mr-3"></span>
                            <span class="media-body">Help</span>
                        </span>
                    </a>
                </li>
                <li>
                    <a class="list-group-item list-group-item-action" href="#">
                        <span class="media align-items-center">
                            <span class="fas fa-user-circle mr-3"></span>
                            <span class="media-body">Your Account</span>
                        </span>
                    </a>
                </li>
                <li class="position-relative">
                    <!-- Country -->
                    <a id="footerCountryInvokerExample1" class="list-group-item list-group-item-action" href="javascript:;" role="button" aria-controls="footer-country-example-2" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" data-unfold-event="click" data-unfold-target="#footer-country-example-2" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="false" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                        <img class="list-group-icon" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/flag-icon-css/flags/4x3/us.svg" alt="United States Flag">
                        <span>United States</span>
                    </a>

                    <div id="footer-country-example-2" class="dropdown-menu dropdown-unfold dropdown-card dropdown-menu-md-right dropdown-menu-bottom" aria-labelledby="footerCountryInvokerExample1">
                        <div class="card">
                            <!-- Body -->
                            <div class="card-body p-5">
                                <h4 class="h6 font-weight-semi-bold">Localinspire available in</h4>

                                <div class="row">
                                    <div class="col-6">
                                        <!-- List Group -->
                                      <a class="list-group-item list-group-item-action active " href="">
                                            <img class="list-group-icon" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/vendor/flag-icon-css/flags/4x3/us.svg" alt="United States Flag">
                                            US
                                        </a>
                                        <!-- End List Group -->
                                    </div>

                                    <div class="col-6">
                                        <!-- List Group -->
                                  
                                      
                                        <!-- End List Group -->
                                    </div>
                                </div>
                            </div>
                            <!-- End Body -->

                            <!-- Footer -->
                            <a class="card-footer card-bg-light p-5" href="#">
                                <span class="d-block text-muted mb-1">More countries coming soon.</span>
                                <small class="d-block">Signup to get notified <span class="fas fa-arrow-right small"></span></small>
                            </a>
                            <!-- End Footer -->
                        </div>
                    </div>
                    <!-- End Country -->
                </li>
            </ul>
            <!-- End List Group -->
        </div>

        <div class="col-lg-3 order-lg-1">
            <div class="d-flex align-items-start flex-column h-100">
                <!-- Logo -->
                <a class="d-inline-flex align-items-center mb-3 navbar-logo" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>" aria-label="Localinspire">
                    <img src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/images/logo_new.png" alt="Localinspire">
                </a>
                <!-- End Logo -->

                <!-- Copyright -->
                <p class="small text-muted mb-0">© <?= date('Y') ?> localinspire Inc.</p>
                <!-- End Copyright -->
            </div>
        </div>
    </div>

    <hr class="my-0">

    <div class="row align-items-md-center space-1">
        <div class="col-md-4 mb-4 mb-lg-0">
            <!-- Social Networks -->
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <a class="btn btn-sm btn-icon btn-soft-secondary btn-bg-transparent" href="https://www.facebook.com/localinspire">
                        <span class="fab fa-facebook-f btn-icon__inner"></span>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn btn-sm btn-icon btn-soft-secondary btn-bg-transparent" href="#">
                        <span class="fab fa-google btn-icon__inner"></span>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn btn-sm btn-icon btn-soft-secondary btn-bg-transparent" href="https://twitter.com/localinspirecom">
                        <span class="fab fa-twitter btn-icon__inner"></span>
                    </a>
                </li>
                
            </ul>
            <!-- End Social Networks -->
        </div>

        <div class="col-md-8 text-md-right">
            <!-- Links -->
            <ul class="list-inline list-group-flush list-group-borderless mb-0">
                <li class="list-inline-item pl-3">
                    <a class="list-group-item-action font-size-1" href="<?= $this->Url->build('privacy-policy', ['fullBase' => true]); ?>">Privacy & policy</a>
                </li>
                <li class="list-inline-item pl-3">
                    <a class="list-group-item-action font-size-1" href="<?= $this->Url->build('terms-of-use', ['fullBase' => true]); ?>">Terms & conditions</a>
                </li>
            </ul>
            <!-- End Links -->
        </div>
    </div>
</footer>
<!-- ========== END FOOTER ========== -->



<!-- Go to Top -->
<a class="js-go-to u-go-to" href="#" data-position='{"bottom": 15, "right": 15 }' data-type="fixed" data-offset-top="400" data-compensation="#header" data-show-effect="slideInUp" data-hide-effect="slideOutDown">
    <span class="fa fa-arrow-up u-go-to__inner"></span>
</a>
<!-- End Go to Top -->