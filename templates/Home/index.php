<?php $this->assign('title', "LocalInspire's User Reviews and Recommendations of Top Restaurants, Lodging, Things to do, and more!"); ?>
<style>
    li.label.small.font-weight-bold.text-body.text-left.mb-1 {
        display: none;
    }

    #explore-by {
        border-radius: 5px;
    }

    #suggestion_contianer {
        max-height: 300px;
        /*box-shadow: 0 1px 5px black;*/
    }

    #location_contianer {
        max-height: 300px;
        /*overflow: hidden;*/
        /*overflow-y: scroll;*/
    }
</style>

<?php if (!empty($currentUser)) { ?>

    <input type="hidden" name="sessioncjax" id="sessionid" class="is_customer_login" value="<?php echo $currentUser->id ?>">
<?php } else { ?>
    <input type="hidden" name="sessioncjax" id="sessionid" class="is_customer_login" value="0">

<?php } //echo "tttt".; 
?>

<header id="header" class="u-header u-header--abs-top-md u-header--bg-transparent-md u-header--white-nav-links-md">



    <input type="hidden" name="sessioncjax" id="sessionid" class="is_customer_login" value="0">


    <div class="u-header__section">

        <div id="logoAndNav" class="container">
            <!-- Nav -->
            <div class="u-header__section">
                <div id="logoAndNav" class="container">
                    <!-- Nav -->
                    <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space sr-menu-initialized sr-menu-horizontal">
                        <!-- White Logo -->
                        <a class="navbar-brand u-header__navbar-brand u-header__navbar-brand-center u-header__navbar-brand-default u-header__navbar-brand-text-white" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>" aria-label="LocalInspire">
                            <div class="navbar-logo">
                                <!--<img src="https://li.localinspire.com/assets/images/logo.png" alt="LocalInspire">-->
                                <img src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/img/logos/logo.png" alt="LocalInspire">
                            </div>
                        </a>
                        <!-- End White Logo -->

                        <!-- Default Logo -->
                        <a class="navbar-brand u-header__navbar-brand u-header__navbar-brand-center u-header__navbar-brand-collapsed" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>" aria-label="LocalInspire">
                            <div class="navbar-logo"><img src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/images/logo_blue.png" alt="LocalInspire"></div>
                        </a>
                        <!-- End Default Logo -->

                        <!-- On Scroll Logo -->
                        <a class="navbar-brand u-header__navbar-brand u-header__navbar-brand-center u-header__navbar-brand-on-scroll" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>" aria-label="LocalInspire">
                            <div class="navbar-logo"><img src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/images/logo_blue.png" alt="LocalInspire"></div>
                        </a>
                        <!-- End On Scroll Logo -->

                        <!-- Responsive Toggle Button -->
                        <button type="button" class="navbar-toggler btn u-hamburger" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
                            <span id="hamburgerTrigger" class="u-hamburger__box">
                                <span class="u-hamburger__inner"></span>
                            </span>
                        </button>
                        <!-- End Responsive Toggle Button -->

                        <!-- Navigation -->
                        <?= $this->element('navigationhome', ['home' => true]) ?>
                         
                    </nav>
                </div>
            </div>
            <div class="alert alert-success sentMail col-md-12 mt-5" style=" display: none;">
                <span class="text-dark"><b>Mail has been sent!</b> Check your inbox and spam folders for a confirmation
                    email, or click here to <a href="#" onclick="ResendMail()">resend.</a></span>
            </div>
            <!-- <div class="alert alert-warning sentMail col-md-12 mt-5" <?php if (!empty($currentUser) and $currentUser->email_verification_status == false) { ?> style=" display: block;" <?php } elseif (!empty($currentUser) and $currentUser->email_verification_status == true) { ?> style=" display: none;" <?php } else { ?> style=" display: none;" <?php } ?>>
    <span class="text-dark"><b>Your account is still unconfirmed!</b> Check your inbox and spam folders for a
        confirmation email, or click here to <a href="#" onclick="ResendMail()">resend.</a></span>
</div> -->
</header>

<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main">
    <!-- Hero Section -->
    <div class="bg-img-hero" style="background-image: url(<?= $this->Url->build('/assets/img/img46.jpg', ['fullBase' => true]); ?>);">
        <div class="">
            <div class="container space-2 space-md-3">
                <div class="text-center mx-auto">
                    <!-- Logo -->
                    <!--  <div class="mb-0">
  <a class="d-inline-flex mx-auto mb-2" href="javascript:;" aria-label="LocalInspire">
    <div class="w-md-60 mx-md-auto"><img class="img-fluid" src="https://via.placeholder.com/logo.png" alt="LocalInspire"></div>
  </a>
</div> -->
                    <!-- End Logo -->
                    <!-- Title --> <BR> <BR> <BR>
                    <div class="mb-5">
                        <h1 class="display-5 font-size-md-down-5 text-white mb-0">
                            Where your inspired journey begins!

                        </h1>

                        <h2 style="color: white;">Discover your next great adventure & inspire local businesses to be
                            great!</h2>
                    </div>
                    <!-- Search Jobs Form -->

                    <?= $this->Form->create(null, ['class' => 'input-group-lg input-group-borderless mb-5', 'id' => 'search_form', 'url' => ['prefix' => null, 'controller' => 'search', 'action' => 'index']]) ?>

                    <div class="form-row align-items-center">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <div class="js-focus-state">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-black-50" id="search">
                                            <b>FIND</b>
                                        </span>
                                    </div>
                                    <?= $this->Form->control('find', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'type' => 'search', 'id' => 'suggested-searches', 'class' => 'form-control', 'placeholder' => "Hotels, Restaurants, Things to Do...", "aria-label" => "Hotels, Restaurants, Things to Do...", "autocomplete" => 'off', "aria-describedby" => "Search for", "onClick" => "$('#suggestions').show();"]) ?>

                                    <!--<input type="hidden" name="find" value="" />-->

                                    <div id="suggestions" class="suggestions">
                                        <!-- keywords dro down starts   -->
                                        <div id="suggestion_contianer" class="js-scrollbar">
                                            <div class="suggestion-items">

                                                <ul id="explore-by">
                                                    <li class="font-weight-bold text-body text-left mb-1 pl-4 mt-1">
                                                        Suggested Searches</li>

                                                    <li class="item" data-item_type="cat" data-item_id="1">
                                                        <div class="start-step-label">
                                                            <i class="fas fa-hotel"></i>&nbsp;&nbsp;
                                                            <span>Hotels</span>
                                                        </div>
                                                    </li>

                                                    <li class="item" data-item_type="cat" data-item_id="8">
                                                        <div class="start-step-label">
                                                            <i class="fas fa-utensils"></i>&nbsp;&nbsp;
                                                            <span>Restaurants</span>
                                                        </div>
                                                    </li>

                                                    <li class="item" data-item_type="cat" data-item_id="9">
                                                        <div class="start-step-label">
                                                            <i class="fas fa-home"></i>&nbsp;&nbsp;
                                                            <span>Cabins</span>
                                                        </div>
                                                    </li>

                                                    <li class="item" data-item_type="cat" data-item_id="10">
                                                        <div class="start-step-label">
                                                            <i class="fas fa-suitcase-rolling"></i>&nbsp;&nbsp;
                                                            <span>Vacation Rentals</span>
                                                        </div>
                                                    </li>

                                                    <li class="item" data-item_type="cat" data-item_id="6">
                                                        <div class="start-step-label">
                                                            <i class="fas fa-skating"></i>&nbsp;&nbsp;
                                                            <span>Things to do</span>
                                                        </div>
                                                    </li>

                                                    <!--<li class="item" data-item_type="cat" data-item_id="3">-->
                                                    <!--	<div class="start-step-label">-->
                                                    <!--		<i class="fas fa-plane"></i>&nbsp;&nbsp;-->
                                                    <!--		<span>Flights</span>-->
                                                    <!--	</div>-->
                                                    <!--</li>-->

                                                    <!--<li class="item" data-item_type="specials" data-item_id="23">-->
                                                    <!--	<div class="start-step-label">-->
                                                    <!--		<i class="fas fa-car"></i>&nbsp;&nbsp;-->
                                                    <!--		<span>Car Rental</span>-->
                                                    <!--	</div>-->
                                                    <!--</li>-->


                                                </ul>
                                            </div>
                                        </div>
                                        <!-- keywords dro down ends   -->


                                    </div>
                                </div>
                            </div>

                            <!-- End Input -->
                        </div>


                        <!-- Input -->
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            <!-- Input -->
                            <div class="js-focus-state">
                                <div class="input-group">
                                    <div class="input-group-prepend" onClick="$('#location-suggest').show();">
                                        <span class="input-group-text text-black-50" id="search">
                                            <b>NEAR</b>
                                        </span>
                                    </div>
                                    <!--<input type="hidden" name="loc" value="">-->
                                    <?= $this->Form->control('location', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, "type" >= "search", "id" => "suggested-location", "autocomplete" => "off", "class" => "form-control", "aria-describedby" => "keywordInputAddon", "onClick" => "$('#location-suggest').show();", "placeholder" => (isset($currentLocation['city']) ? $currentLocation['city'] . "," : "") . " " . (isset($currentLocation['region']) ? $currentLocation['region'] : ""),  'value' => (isset($currentLocation['city']) ? $currentLocation['city'] . "," : "") . " " . (isset($currentLocation['region']) ? $currentLocation['region'] : "")]) ?>

                                    <div class="input-group-append append-location-down" onClick="$('#location-suggest').show();">
                                        <span class="input-group-text" id="search">
                                            <span class="fas fa-angle-down"></span>
                                        </span>
                                    </div>
                                    <div id="location-suggest" class="location-suggest">
                                        <!-- Location drop down starts   -->
                                        <div id="location_contianer" class="js-scrollbar">
                                            <div id="location_pretext">

                                                <div class="l-pre-2 text-left">
                                                    <ul id="location-recent" role="presentation">

                                                        <li class="item-loc grey-text" role="option" data-entity_type="subzone"><a href="javascript:void(0)" onclick="getLocation()" id="get_user_current_location"><i class="fas fa-location-arrow"></i> &nbsp;&nbsp;
                                                                Use Current Location</a></li>
                                                        <li class=" text-left ttupper p-2 text-muted">Recent
                                                            Locations</li>
                                                        

                                                        <li class="item-loc grey-text" role="option" data-entity_type="subzone" data-value="Dallas-TX">Dallas, TX</li>

                                                        <li class="item-loc grey-text" role="option" data-entity_type="subzone" data-value="New-York-NY">New York, NY</li>
                                                        <li class="item-loc grey-text" role="option" data-entity_type="subzone" data-value="Washington-DC">Washington, DC</li>
                                                    </ul>
                                                </div>
                                                <div class="l-pre-2 text-left">
                                                    <ul id="location-popular" role="presentation">
                                                        <li class="text-left p-2 ttupper text-muted">Popular
                                                            Locations</li>
                                                        <li class="item-loc grey-text" role="option" data-entity_type="subzone" data-value="Terrell-TX">Terrell, TX</li>
                                                        <li class="item-loc grey-text" role="option" data-entity_type="subzone" data-value="Fort-Lauderdale-FL">Fort Lauderdale, FL</li>
                                                        <li class="item-loc grey-text" role="option" data-entity_type="subzone" data-value="New-York-NY">New York, NY</li>
                                                        <li class="item-loc grey-text" role="option" data-entity_type="subzone" data-value="Las-Vegas-NV">Las Vegas, NV</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Location dro down ends   -->
                                    </div>
                                </div>
                            </div>

                            <!-- End Input -->
                        </div>

                        <div class="col-lg-2 align-self-lg-end">
                            <button type="submit" style="padding-top:14px" class="btn btn-block btn-twitter">Let's
                                Find It</button>
                        </div>
                    </div>

                    <!--<input type="hidden" name="type" value="" />-->
                    <!--<input type="hidden" name="id" value="" />-->
                    <!-- End Checkbox -->
                    <?= $this->Form->end() ?>



                    <div class="container">
                        <div class="home-browse-btns pvxl">

                            <div class="row text-center">


                                <div class="col-md-2 col-sm-2 col-xs-3 col-sm-offset-1">
                                    <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'search', 'action' => 'index', '?' => ['find' => 'Hotels', 'location' => isset($currentLocation['city']) ? $currentLocation['city'] . "-" . $currentLocation['region'] : '']]); ?>" class="btn  btn-md text-white"><i class="fas fa-hotel font-size-2"></i></a>
                                    <p></p>
                                    <p class="hidden-xs"><a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'search', 'action' => 'index', '?' => ['find' => 'Hotels', 'location' => isset($currentLocation['city']) ? $currentLocation['city'] . "-" . $currentLocation['region'] : '']]); ?>" class="text-white">Hotels</a></p>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-3">
                                    <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'search', 'action' => 'index', '?' => ['find' => 'Restaurants', 'location' => isset($currentLocation['city']) ? $currentLocation['city'] . "-" . $currentLocation['region'] : '']]); ?>" class="btn btn-md text-white"><i class="fas fa-utensils font-size-2"></i></a>
                                    <p></p>
                                    <p class="hidden-xs"><a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'search', 'action' => 'index', '?' => ['find' => 'Restaurants', 'location' => isset($currentLocation['city']) ? $currentLocation['city'] . "-" . $currentLocation['region'] : '']]); ?>" class="text-white">Restaurants</a></p>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-3">
                                    <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'search', 'action' => 'index', '?' => ['find' => 'Things to do', 'location' => isset($currentLocation['city']) ? $currentLocation['city'] . "-" . $currentLocation['region'] : '']]); ?>" class="btn btn-md text-white"><i class="fas fa-skating font-size-2"></i></a>
                                    <p></p>
                                    <p class="hidden-xs"><a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'search', 'action' => 'index', '?' => ['find' => 'Things to do', 'location' => isset($currentLocation['city']) ? $currentLocation['city'] . "-" . $currentLocation['region'] : '']]); ?>" class="text-white">Things to do</a></p>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-3">
                                    <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'search', 'action' => 'index', '?' => ['find' => 'Vacation Rentals', 'location' => isset($currentLocation['city']) ? $currentLocation['city'] . "-" . $currentLocation['region'] : '']]); ?>" class="btn btn-md text-white"><i class="fas fa-suitcase-rolling font-size-2"></i></a>
                                    <p></p>
                                    <p class="hidden-xs"><a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'search', 'action' => 'index', '?' => ['find' => 'Vacation Rentals', 'location' => isset($currentLocation['city']) ? $currentLocation['city'] . "-" . $currentLocation['region'] : '']]); ?>" class="text-white">Vacation Rentals</a></p>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-3">
                                    <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'search', 'action' => 'index', '?' => ['find' => 'Flights', 'location' => isset($currentLocation['city']) ? $currentLocation['city'] . "-" . $currentLocation['region'] : '']]); ?>" class="btn btn-md text-white"><i class="fas fa-plane-departure font-size-2"></i></a>
                                    <p></p>
                                    <p class="hidden-xs"><a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'search', 'action' => 'index', '?' => ['find' => 'Flights', 'location' => isset($currentLocation['city']) ? $currentLocation['city'] . "-" . $currentLocation['region'] : '']]); ?>" class="text-white">Flights</a></p>
                                </div>
                                <div class="col-md-2 col-sm-2 hidden-xs">
                                    <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'search', 'action' => 'index', '?' => ['find' => 'Car Rental', 'location' => isset($currentLocation['city']) ? $currentLocation['city'] . "-" . $currentLocation['region'] : '']]); ?>" class="btn btn-md text-white"><i class="fas fa-car-side font-size-2"></i></a>
                                    <p></p>
                                    <p class="hidden-xs"><a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'search', 'action' => 'index', '?' => ['find' => 'Car Rental', 'location' => isset($currentLocation['city']) ? $currentLocation['city'] . "-" . $currentLocation['region'] : '']]); ?>" class="text-white">Car Rental</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    

    <div class="bg-light pt-6">
          

      </div>
    
    
    
    
    
    
    
    
    
    
  
      <!-- Subscribe Section -->
<div id="SVGsubscribeExample1" class="svg-preloader  mt-1">
  <div class="container space-2">
    <div class="row justify-content-lg-end align-items-lg-center">
      <div class="col-lg-7 mb-7 mb-lg-0">
        <!-- SVG Icon -->
        <figure class="ie-subscribe-illustration">
          <img class="js-svg-injector" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/app-development-flat-concept-illustration.svg" alt="Image Description"
               data-parent="#SVGsubscribeExample1">
        </figure>
        <!-- End SVG Icon -->
      </div>

      <div class="col-lg-5">
        <div class="pl-lg-4">
          <!-- Title -->
          <div class="mb-5"> <!-- Heading -->
            <h2 class="">
              <strong class="text-success font-weight-semi-bold">Join us</strong> <span class="text-dark">in making our communities great! </span>
            </h2>
            
            <p class="text-dark"> We're striving to build a local review site that will benefit both the business and the user. We want to build a site that people can trust to get honest reviews and tips from. <br><br>

We're looking to build a better community to help businesses grow and give better service and support, and in return get honest reviews and repeat customers.<br><br>

We will be continually building and adding to this site to make it user friendly, safe, and to give back to our communities.<br><br>

So please join, review, and rate the businesses you have visited.</p>
          </div>
          <!-- End Title -->

        
        </div>
      </div>
    </div>
  </div>
</div>

    
    
     <div class="bg-light space-md-1">
          

      </div>
    
    
    
    <!-- End Hero Section -->
    <?php if (!empty($featuredCities)) { ?>

        <!-- Best Restaurants Section -->
        <div class="container space-2 space-md-2">
            <!-- Title -->
            <div class="w-md-90 w-lg-60 text-center mx-md-auto mb-5">

                <h2 class="h3 font-weight-medium">The best places in the top cities </h2>

            </div>
            <div class="row mx-gutters-2">
                <?php if (!empty($featuredCities[0])) { ?>
                    <div class="col-md-6 mb-3">
                        <?= $this->element('featured_city', ['city' => $featuredCities[0]]) ?>
                    </div>
                <?php } ?>
                <?php if (!empty($featuredCities[1])) { ?>
                    <div class="col-md-6 mb-3">
                        <!-- Restaurants Total -->
                        <?= $this->element('featured_city', ['city' => $featuredCities[1]]) ?>
                        <!-- End Restaurants Total -->
                    </div>
                <?php } ?>
                <?php if (!empty($featuredCities[2])) { ?>
                    <div class="col-md-4 mb-3">
                        <!-- Restaurants Total -->
                        <?= $this->element('featured_city', ['city' => $featuredCities[2]]) ?>
                        <!-- End Restaurants Total -->
                    </div>
                <?php } ?>

                <?php if (!empty($featuredCities[3])) { ?>
                    <div class="col-md-4 mb-3">
                        <!-- Restaurants Total -->
                        <?= $this->element('featured_city', ['city' => $featuredCities[3]]) ?>
                        <!-- End Restaurants Total -->
                    </div>
                <?php } ?>
                <?php if (!empty($featuredCities[4])) { ?>
                    <div class="col-md-4 mb-3">
                        <!-- Restaurants Total -->
                        <?= $this->element('featured_city', ['city' => $featuredCities[4]]) ?>
                        <!-- End Restaurants Total -->
                    </div>
                <?php } ?>
                <?php if (!empty($featuredCities[5])) { ?>
                    <div class="col-md-6 mb-3">
                        <!-- Restaurants Total -->
                        <?= $this->element('featured_city', ['city' => $featuredCities[5]]) ?>
                        <!-- End Restaurants Total -->
                    </div>
                <?php } ?>
                <?php if (!empty($featuredCities[6])) { ?>
                    <div class="col-md-6 mb-3">
                        <!-- Restaurants Total -->
                        <?= $this->element('featured_city', ['city' => $featuredCities[6]]) ?>
                        <!-- End Restaurants Total -->
                    </div>
                <?php } ?>
            </div>
            <!-- End Title -->
        </div>
        <!-- End Best Restaurants Section -->

        <style>
            .post-meta-s {
                width: 100%;
                position: relative;
            }

            .post-meta-s .media-body {
                padding-left: 5px;
            }

            .post-meta-s .media-body p {
                font-family: 'Open Sans', sans-serif;
                font-weight: 400;
                color: #232323;
                font-size: 13px;
                margin-bottom: -8px;
            }

            .label {
                border-radius: 3px;
                font-size: 10px;
                font-size: 0.625rem;
                position: absolute;
                top: 12px;
                left: 12px;
                display: inline-block;
                padding: 2px 8px;
                color: #222222;
                text-align: center;
            }

            .label--primary {
                background-color: #fcc400;
            }

            .label--secondary {
                background-color: #39b54a;
                color: #ffffff;
            }

            .label--tertiary {
                background-color: #f15636;
                color: #ffffff;
            }

            .favorite {
                position: absolute;
                top: 12px;
                right: 12px;
                cursor: pointer;
            }
        </style>
    <?php } ?>
    <?php if (!empty($sponsoredListings)) { ?>
        <!-- Featured -->
        <div class="container space-1">
            <!-- Title -->
            <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-3">

                <h2 class="h3 font-weight-medium">Featured Businesses in your city </h2>
                <!-- <div class="normal">Featured businesses in your city...</div> -->
            </div>
            <!-- End Title -->
            <!--  <div class="card-deck card-sm-gutters-2 d-block d-sm-flex">-->
            <div class="row">
                <!-- Featured -->
                <?= $this->element('sponsored_listings', ['sponsoredListings' => $sponsoredListings]) ?>
            </div>
            <!-- <center>
            <div class="mt-4">
                <a class="btn btn-sm btn-primary" href="#">

                    View More &nbsp;&nbsp;<i class="fas fa-chevron-down"></i>
                </a>
            </div>
        </center> -->
        </div>
        <!-- End Featured -->

    <?php } ?>



    <!-- Nearby -->
    <!-- <div class=" container space-1 mb-5"> -->
    <!-- Title -->
    <!-- <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-3">

        <h2 class="h3 font-weight-medium">Our Nearby Places</h2>
        <div class="normal">A list of our nearby places, check out what's going on in
            <?= isset($currentLocation['city']) ? $currentLocation['city'] . "," : ""; ?> <?= isset($currentLocation['region']) ? $currentLocation['region'] : ""; ?> now.</div>
    </div> -->
    <!-- End Title -->


    <!-- <h4>Restaurants</h4> -->
    <?php if (1 == 2) : ?>
        <!--  <div class="card-deck card-sm-gutters-2 d-block d-sm-flex">-->
        <div class="row">

            <?php
            $total_near_by_records = $current_location_data->results->total_hits;
            if ($total_near_by_records > 0) {  //******************IF Records found***************
                $rpp = 10;
                foreach ($current_location_data as $place) {
                    //print_r($place)
                    $total_hits = $place->total_hits;
                    $first_hit = $place->first_hit;
                    $last_hit = $place->last_hit;
                    $page = $place->page;
                    $maxpage = $total_hits / $rpp;
                    $rpp = $place->rpp;;
                    foreach ($place->locations as $location) {
                        $featured = $location->featured;
                        $public_id = $location->public_id;
                        $name = $location->name;
                        $address = $location->address;
                        $street = $address->street;
                        $city = $address->city;
                        $state = $address->state;
                        $postal_code = $address->postal_code;
                        $rating = $location->rating;
                        $image = $location->image;
                        $sample_categories = $location->sample_categories;
                        $tags_categories = $location->tags[0]->name;

            ?>
                        <div class="col-sm-4 card-sm-gutters-0">
                            <div class="card shadow-sm mb-5">
                                <a href=""><img class="card-img-top" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/img/defauls_buisness_image.png" alt="Image Description">
                                    <span class="label label--secondary"><?php echo $tags_categories; ?></span>
                                    <span class="favorite">
                                        <i class="far fa-heart text-white"></i>
                                    </span></a>
                                <div class="card-body p-2">
                                    <div class="mb-2 small"> <?php echo $sample_categories; ?></div>
                                    <a class="homebusiness-wrapa" href=""><?php echo $name;  ?></a>
                                    <ul class="list-inline mt-2 text-white star_size12 mb-1">
                                        <li class="list-inline-item mx-0">
                                            <span class="fas fa-star star_borderoff"></span>
                                        </li>
                                        <li class="list-inline-item mx-0">
                                            <span class="fas fa-star star_borderoff"></span>
                                        </li>
                                        <li class="list-inline-item mx-0">
                                            <span class="fas fa-star star_borderoff"></span>
                                        </li>
                                        <li class="list-inline-item mx-0">
                                            <span class="fas fa-star star_borderoff"></span>
                                        </li>
                                        <li class="list-inline-item mx-0">
                                            <span class="fas fa-star star_borderoff"></span>
                                        </li> <span class="text-dark"> &nbsp;&nbsp;<?php echo $rating; ?> reviews</span>
                                    </ul>
                                    <small class="d-block"> <?php echo $street; ?> <?php echo $city; ?>, <?php echo $state; ?> -
                                        <?php echo $postal_code; ?></small>
                                    <div>
                                        <hr>

                                        <div class="post-meta-s">
                                            <div class="media">
                                                <div class="customer-ratingsm"><?php echo $rating; ?>.0</div>
                                                <div class="media-body">
                                                    <p>Based on <?php echo $rating; ?> people's opinion</p>

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
            <?php }
                }
            } ?>
            <!-- End Nearby -->





        </div>


        <?php if ($total_near_by_records > 0) {  //******************IF Records found*************** 
        ?>

            <center>
                <div class="mt-4">
                    <a class="btn btn-sm btn-primary" href="#">

                        View More &nbsp;&nbsp;<i class="fas fa-chevron-down"></i>
                    </a>
                </div>
            </center>
        <?php } else { ?>
            <center>
                <div class="mt-4">
                    <a href="javascript:void(0)" onclick="getLocation()" id="near_by_current_location"><i class="fas fa-location-arrow"></i> &nbsp;&nbsp; Use Current Location</a>
                </div>
            </center>
        <?php } ?>


    <?php endif; ?>
    <!-- </div> -->
    <!-- End Nearby -->


   

        <!-- <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-3 mt-3"> -->
        <!-- <small class="u-label u-label--sm u-label--success mb-2">Hand Picked</small> -->
        <!-- <h2 class="h3 font-weight-medium">Featured Cities</h2> -->
        <!-- </div> -->

        <!-- <div class="js-slick-carousel u-slick u-slick--gutters-1" data-slides-show="5" data-slides-scroll="1" data-autoplay="false" data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle" data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4" data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4" data-responsive='[{"breakpoint": 992,"settings": {"slidesToShow": 2}}, {"breakpoint": 768,"settings": {"slidesToShow": 1}}, {"breakpoint": 554,"settings": {"slidesToShow": 1}}]'>

            <?php //foreach ($featuredCities as $key => $city) { 
            ?>
                <a href="<?php //echo $this->Url->build(['prefix' => false, 'controller' => 'search', 'action' => 'index', '?' => ['find' => 'Restaurants', 'location' => $city->name . "-" . $city->state->code]]); 
                            ?>">
                    <div class="js-slide rounded-pseudo gradient-overlay-half-dark-v1 bg-img-hero-center" style="background-image: url(<?php //echo $this->Custom->getDp($city->image, 'cities', '210x100') 
                                                                                                                                        ?>);">
                        <div class="text-center space-1 pt-9">
                            <article class="w-100 text-center mt-9">
                                <div class="pt-9 mb-0">
                                    <div class="font-size-2 font-weight-semi-bold text-white pt-5"><?php //echo ucfirst($city->name) 
                                                                                                    ?></div>
                                    <div class="d-block text-white mt-0"><?php //echo $city->state->code 
                                                                            ?></div>
                                </div>
                            </article>
                        </div>
                    </div>
                </a>
            <?php //} 
            ?>
        </div>
    </div> -->
        <!-- End Nearby -->
        <?php if (!empty($latest_posts)) { ?>
            <!-- Title -->
            <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-3 mt-3">

                <h2 class="h3 font-weight-medium">Latest Posts in <?= (!empty($city) ? $city->name . ", " . strtoupper($city->state->code) : '') ?></h2>
                
            </div>
            <!-- End Title -->
            <div class="bg-light mt-3 pt-3 pb-3 mb-3">
                <div class="container">
                    <!-- <h1 class="text-center">Latest Posts in <?= (!empty($city) ? $city->name . ", " . strtoupper($city->state->code) : '') ?></h1> -->


                    <div class="card-deck d-block d-md-flex card-md-gutters-3">
                        <?php foreach ($latest_posts as $post) { ?>
                            <div class="card border-0 mb-5 mb-md-0">
                                <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'stories', 'action' => 'view', $post->id, \Cake\Utility\Text::slug(strtolower($post->title))]); ?>"> <img class="card-img-top" src="<?= $this->Custom->getDp($post->image, "posts") ?>" alt="<?= $post->title ?>"></a>
                                <div class="card-body p-5">
                                    <small class="d-block text-secondary mb-1"><?= $this->Custom->niceDateMonthDayYear($post->created) ?></small>
                                    <h3 class="h6 bold mb-0">
                                        <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'stories', 'action' => 'view', $post->id, \Cake\Utility\Text::slug(strtolower($post->title))]); ?>"><?= $post->title ?></a>
                                    </h3>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        <?php } ?>

        <BR><BR>
        </div>
</main>