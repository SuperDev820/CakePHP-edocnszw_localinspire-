<div id="navBar" class="<?= !$home ? 'small' : 'mt-3' ?> collapse navbar-collapse u-header__navbar-collapse">
    <ul class="navbar-nav u-header__navbar-nav">

        <?php if (!$home) : ?>
            <li class="nav-item sr-has-mega-menu u-header__nav-item">
                <a class="nav-link mr-2 text-white" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'search', 'action' => 'index', '?' => ['find' => 'Hotels', 'location' => isset($currentLocation['city']) ? $currentLocation['city'] . "-" . $currentLocation['region'] : '']]); ?>">Hotels</a>
            </li>
            <li class="nav-item sr-has-mega-menu u-header__nav-item">
                <a class="nav-link mr-2 text-white" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'search', 'action' => 'index', '?' => ['find' => 'Restaurants', 'location' => isset($currentLocation['city']) ? $currentLocation['city'] . "-" . $currentLocation['region'] : '']]); ?>">Restaurants</a>
            </li>
            <li class="nav-item sr-has-mega-menu u-header__nav-item">
                <a class="nav-link mr-2 text-white" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'search', 'action' => 'index', '?' => ['find' => 'Cabins', 'location' => isset($currentLocation['city']) ? $currentLocation['city'] . "-" . $currentLocation['region'] : '']]); ?>">Cabins</a>
            </li>
            <li class="nav-item sr-has-mega-menu u-header__nav-item">
                <a class="nav-link mr-2 text-white" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'search', 'action' => 'index', '?' => ['find' => 'Vacation Rentals', 'location' => isset($currentLocation['city']) ? $currentLocation['city'] . "-" . $currentLocation['region'] : '']]); ?>">Vacation Rentals</a>
            </li>
            <li class="nav-item sr-has-mega-menu u-header__nav-item">
                <a class="nav-link mr-2 text-white" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'search', 'action' => 'index', '?' => ['find' => 'Things to do', 'location' => isset($currentLocation['city']) ? $currentLocation['city'] . "-" . $currentLocation['region'] : '']]); ?>">Things to do</a>
            </li>

            <li class="nav-item sr-has-mega-menu u-header__nav-item pr-3 ">
                <a class="nav-link text-white" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'search', 'action' => 'index', '?' => ['find' => 'Cruises', 'location' => isset($currentLocation['city']) ? $currentLocation['city'] . "-" . $currentLocation['region'] : '']]); ?>">Cruises</a>
            </li>
            <li class="nav-item sr-has-mega-menu u-header__nav-item pr-3 ">
                <a class="nav-link text-white" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'stories', 'action' => 'index']); ?>">Stories</a>
            </li>
        <?php endif; ?>

        <?php if (empty($currentUser)) { ?>

            <style type="text/css">
                .before_login {
                    display: block;
                }
            </style>


        <?php } else { ?>

            <style type="text/css">
                .before_login {
                    display: none;
                }
            </style>

        <?php } ?>
        <li class="nav-item sr-has-mega-menu u-header__nav-item before_login">
            <a class="btn btn-sm btn-link loginn" href="#loginModal" data-modal-target="#loginModal" data-target="#login"> <i class="fas text-white fa-user-circle font-size-3"></i></a>
        </li>
        <li class="nav-item u-header__nav-last-item  before_login">
            <a class="btn btn-sm btn-soft-twitterreg ml-0 pt-1 pb-1 bold signinn" href="#loginModal" data-modal-target="#loginModal" data-target="#login">Join</a>
        </li>
        <!-- Account Login -->
        <?php if (!empty($currentUser)) { ?>

            <style type="text/css">
                .after_login {
                    display: block;
                }
            </style>


        <?php } else { ?>

            <style type="text/css">
                .after_login {
                    display: none;
                }
            </style>

        <?php } ?>

        <!-- Messages -->
        <style>
            #messagesMegaMenu .badge.badge-pos {
                position: absolute;
                top: 20px !important;
                right: 20px;
                background: red;
                display: none;
            }

            #messagesMegaMenu {
                position: relative;
            }
        </style>
        <li class="after_login position-relative  mt-1 sr-has-mega-menu " data-event="hover" data-animation-in="slideInUp" data-animation-out="fadeOut" data-max-width="260px" data-position="right">
            <a id="messagesMegaMenu" class=" nav-link  " href="javascript:;" aria-haspopup="true" aria-expanded="false">
                <span class="badge badge-xs badge-outline-success rounded-circle new_message_dot blink" style="display: none;"></span>
                <i class="far text-white  mr-2 font-size-15 fa-comment-alt"></i>
            </a>
            <!-- Messages - Submenu -->
            <div class="after_login border sr-mega-menu u-header__sub-menu" aria-labelledby="messagesMegaMenu" style="min-width: 330px;" id="notifications_unread_messages">
                <?= $this->element('notifications_unread', ['notifications_values' => $notifications_unread_messages, 'message_notification' => true]) ?>
            </div>
            <!-- End Messages - Submenu -->
        </li>
        <!-- End Messages -->
        <!-- Notifications -->
        <li class="after_login position-relative  mt-1 sr-has-mega-menu " data-event="hover" data-animation-in="slideInUp" data-animation-out="fadeOut" data-max-width="260px" data-position="right">
            <a id="docsMegaMenu" class="after_login nav-link" href="javascript:;" aria-haspopup="true" aria-expanded="false">
                <span class="badge badge-xs badge-outline-success rounded-circle new_notification_dot blink" style="display: none;"></span>
                <i class="fas font-size-15  mr-2 text-white fa-bell"></i>
            </a>
            <!-- Notifications - Submenu -->
            <div class="after_login border  sr-mega-menu u-header__sub-menu" aria-labelledby="docsMegaMenu" style="min-width: 330px;" id="notifications_unread">
                <?= $this->element('notifications_unread', ['notifications_values' => $notifications_unread]) ?>
            </div>
            <!-- End Notifications - Submenu -->
        </li>
        <!-- End Notifications -->

        <!-- Account -->
        <li class="after_login position-relative  mt-1 sr-has-mega-menu " data-event="hover" data-animation-in="slideInUp" data-animation-out="fadeOut" data-max-width="260px" data-position="right">
            <a id="notificationMegaMenu" class="after_login nav-link " href="javascript:;" aria-haspopup="true" aria-expanded="false">
                <?php if ($home) : ?>
                    <span class="text-white u-sidebar--account__toggle-text"><span id="ShowName"><?= !empty($currentUser) ?  $currentUser->firstname : "" ?></span>
                    <?php endif; ?>
                    <img class="after_login_img  u-sidebar--account__toggle-img" src="<?= !empty($currentUser) ?  $this->Custom->getDp($currentUser->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description"> <i class="fas ml-2 small text-white fa-chevron-down"></i></a>


            <!-- Account - Submenu -->
            <div class="after_login border sr-mega-menu u-header__sub-menu" aria-labelledby="notificationMegaMenu" style="min-width: 330px;">
                <!-- Promo Item -->
                <div class="p-0">
                    <!-- Content -->
                    <div class="after_login u-sidebar__body">

                        <header class="after_login d-flex align-items-center u-sidebar--account__holder mt-0">
                            <div class="position-relative">
                                <img class="after_login_img u-sidebar--account__holder-img mCS_img_loaded" src="<?= !empty($currentUser) ?  $this->Custom->getDp($currentUser->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">
                                <span class="badge badge-xs badge-outline-success badge-pos rounded-circle"></span>
                            </div>
                            <div class="after_login ml-3">
                                <span class="after_login_name font-weight-semi-bold">
                                    <?php if (!empty($currentUser)) :  ?>
                                        <?= $currentUser->firstname  ?>
                                    <?php else :  ?>
                                        User
                                    <?php endif;  ?>
                                </span>

                                <span class="after_login_view_profile u-sidebar--account__holder-text">
                                    
                                     <?= !empty($currentUser->city) ?  $currentUser->city->name . ", " . strtoupper($currentUser->city->state->code) : '' ?> </span><a class="small" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'account', 'action' => 'profile']); ?>">View
                                    profile</a><br />
                                <a class="small" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'account', 'action' => 'password']); ?>">Change
                                    Password</a>

                            </div>

                            <!-- Settings -->
                            <div class="btn-group position-relative ml-auto mb-auto">
                                <a id="sidebar-account-settings-invoker" class="btn btn-xs btn-icon btn-text-secondary rounded" href="account">
                                    <span class="fas fa-ellipsis-v btn-icon__inner"></span>
                                </a>
                            </div>
                            <!-- End Settings -->
                        </header>

                        <div class="after_login">
                            <!-- List Links -->
                            <ul class="after_login list-unstyled u-sidebar--account__list">
                                <li class="u-sidebar--account__list-item">
                                    <a class="u-sidebar--account__list-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'account', 'action' => 'index']); ?>">
                                        <figure class="ie-height-56 max-width-4">
                                            <img class="js-svg-injector float-left" src="<?= $this->Url->build('/svg/icon-35.svg', ['fullBase' => true]); ?>" alt="SVG" data-parent="#icon35">
                                        </figure>
                                        <div class="ml-6 pt-1 pb-0">Dashboard</div>
                                    </a>
                                </li>
                                <li class="u-sidebar--account__list-item">
                                    <a class="u-sidebar--account__list-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'account', 'action' => 'settings']); ?>">
                                        <figure class="ie-height-56 max-width-4">
                                            <img class="js-svg-injector float-left" src="<?= $this->Url->build('/svg/icon-12.svg',  ['fullBase' => true]); ?>" alt="SVG" data-parent="#icon12">
                                        </figure>
                                        <div class="ml-6 pt-1 pb-0">Account Settings
                                        </div>
                                    </a>
                                </li>


                                <li class="u-sidebar--account__list-item">
                                    <a class="u-sidebar--account__list-link" href="#">
                                        <figure class="ie-height-56 max-width-4">
                                            <img class="js-svg-injector float-left" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/icon-18.svg" alt="SVG" data-parent="#icon18">
                                        </figure>
                                        <div class="ml-6 pt-1 pb-0">Find Friends</div>
                                    </a>
                                </li>
                                <li class="u-sidebar--account__list-item">
                                    <a class="u-sidebar--account__list-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'account', 'action' => 'connections']); ?>">
                                        <figure class="ie-height-56 max-width-4">
                                            <img class="js-svg-injector float-left" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/icon-56.svg" alt="SVG" data-parent="#icon56">
                                        </figure>
                                        <div class="ml-6 pt-1 pb-0">Get Connected</div>
                                    </a>
                                </li>
                                <?php if (!empty($currentUser) and ($currentUser->sa or $currentUser->admin)) {  ?>
                                    <li class="u-sidebar--account__list-item">
                                        <a class="u-sidebar--account__list-link" href="<?= $this->Url->build(["prefix" => 'Admin', 'controller' => 'dashboard', 'action' => 'index']); ?>">
                                            <figure class="ie-height-56 max-width-4">
                                                <img class="js-svg-injector float-left" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/icon-56.svg" alt="SVG" data-parent="#icon56">
                                            </figure>
                                            <div class="ml-6 pt-1 pb-0">Admin Area</div>
                                        </a>
                                    </li>
                                <?php }  ?>
                                <hr class="mb-0">
                                <li class="u-sidebar--account__list-item">
                                    <a class="u-sidebar--account__list-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'logout']); ?>">
                                        <figure class="ie-height-56 max-width-4">
                                            <img class="js-svg-injector float-left" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/icon-20.svg" alt="SVG" data-parent="#icon20">
                                        </figure>
                                        <div class="ml-6 pt-1 pb-0">Log Out</div>
                                    </a>
                                </li>
                            </ul>
                            <!-- End List Links -->
                        </div>
                    </div>
                </div>
                <!-- End Account - Submenu -->
        </li>
        <!-- End Account -->

        <!-- End Account Login -->
        <?php if (!$home) : ?>
            <li class="nav-item u-header__nav-last-item ">
                <a class="btn btn-sm btn-soft-search ml-0 pt-1 pb-1" style="padding:5px!important;padding-left:8px!important;padding-right:20px!important" href="javascript:;" role="button" aria-haspopup="true" aria-expanded="false" aria-controls="searchPushTop" data-unfold-type="jquery-slide" data-unfold-target="#searchPushTop"><i class="fas fa-search mr-1"></i> Search</a>
            </li>
            <?php if (!empty($business) or !empty($city)) : ?>
                <?php $showCity =  (!empty($business) ? $business->city : $city); ?>
                <?php if (!empty($showCity) and empty($showCity->user_id)) : ?>
                    <li class="nav-item u-header__nav-last-item ">
                        <a class="btn btn-sm btn-soft-twitterreg ml-0 pt-1 pb-1" style="padding:5px!important;padding-left:8px!important;padding-right:20px!important" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'ClaimCity', 'action' => 'index', $showCity->id, \Cake\Utility\Text::slug(strtolower($showCity->name))]); ?>"><i class="fas fa-hand-rock-o mr-1"></i> Claim <?= $showCity->name ?> </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
</div>