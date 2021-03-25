<!--<header id="header" class="u-header u-header--sticky-top-md " data-header-fix-moment="500" data-header-fix-effect="slide">-->
<header id="header" class="u-header" data-header-fix-moment="500" data-header-fix-effect="slide">


    <?php if (!empty($currentUser)) { ?>

        <input type="hidden" name="sessioncjax" id="sessionid" class="is_customer_login" value="<?= $currentUser->id ?>">
    <?php } else { ?>
        <input type="hidden" name="sessioncjax" id="sessionid" class="is_customer_login" value="0">

    <?php } ?>



    <!-- Search -->
    <div id="searchPushTop" class="u-search-push-top">
        <div class="container position-relative">
            <div class="u-search-push-top__content">
                <!-- Close Button -->
                <button type="button" class="close u-search-push-top__close-btn" aria-haspopup="true" aria-expanded="false" aria-controls="searchPushTop" data-unfold-type="jquery-slide" data-unfold-target="#searchPushTop">
                    <span aria-hidden="true">×</span>
                </button>
                <!-- End Close Button -->

                <!-- Search Jobs Form -->
                <form action="<?= $this->Url->build('/', ['fullBase' => true]); ?>search" class="input-group-lg input-group-borderless ml-4" id="search_form">
                    <div class="form-row align-items-center">
                        <div class="col-lg-6 mb-0 mb-lg-0">
                            <div class="js-focus-state borderlt">
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-black-50" id="search">
                                            <b>FIND</b>
                                        </span>
                                    </div>
                                    <input type="search" id="suggested-searches" autocomplete="off" name="find" class="form-control" placeholder="Hotels, Restaurants, Things to Do..." aria-label="Hotels, Restaurants, Things to Do..." aria-describedby="Search for" onClick="$('#suggestions').show();">
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
                        <div class="col-lg-4 mb-0 mb-lg-0">
                            <!-- Input -->
                            <div class="js-focus-state borderlt">
                                <div class="input-group">
                                    <div class="input-group-prepend" onClick="$('#location-suggest').show();">
                                        <span class="input-group-text text-black-50" id="search">
                                            <b>NEAR</b>
                                        </span>
                                    </div>
                                    <!--<input type="hidden" name="loc" value="">-->
                                    <input type="search" id="suggested-location" autocomplete="off" name="loc" class="form-control" placeholder="<?= isset($currentLocation['city']) ? $currentLocation['city'] . "," : ""; ?> <?= isset($currentLocation['region']) ? $currentLocation['region'] : ""; ?>" aria-label="<?= isset($currentLocation['city']) ? $currentLocation['city'] . "," : ""; ?> <?= isset($currentLocation['region']) ? $currentLocation['region'] : ""; ?>" value="" aria-describedby="keywordInputAddon" onClick="$('#location-suggest').show();">
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

                                                        <li class="grey-text" role="option" data-entity_type="subzone"><a href="javascript:void(0)" onclick="getLocation()" id="get_user_current_location"><i class="fas fa-location-arrow"></i> &nbsp;&nbsp;
                                                                Use Current Location</a></li>
                                                        <li class=" text-left ttupper p-2 text-muted">Recent
                                                            Locations</li>
                                                        <li class="item-loc grey-text" role="option" data-entity_type="subzone" data-value="Los-Angeles-CA">Los Angeles, CA</li>

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
                            <button type="submit" style="padding-top:14px" class="btn btn-sm btn-soft-twitterreg ">Search</button>
                        </div>
                    </div>
                    <input type="hidden" name="type" value="" />
                    <input type="hidden" name="id" value="" />
                    <!-- End Checkbox -->
                </form>
                <!-- End Search Jobs Form -->
            </div>
        </div>
    </div>
    <!-- End Search -->

    <div class="u-header__section bg-white border-top-header p-2">
        <div id="logoAndNav" class="">
            <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space">
                <div class="navbar-logo ml-3"><a href="<?= $this->Url->build('/', ['fullBase' => true]); ?>"><img src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/images/logo_new.png" alt="LocalInspire"></a></div>
                <button type="button" class="navbar-toggler btn u-hamburger" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
                    <span id="hamburgerTrigger" class="u-hamburger__box">
                        <span class="u-hamburger__inner"></span>
                    </span>
                </button>

                <?= $this->element('navigation', ['home' => false]) ?>
            </nav>
        </div>
    </div>
    
</header>
<div style="height:1px;background-color:#f2f2f2"></div>

<!--<div class="mb-3 space-bottom-1"></div>-->