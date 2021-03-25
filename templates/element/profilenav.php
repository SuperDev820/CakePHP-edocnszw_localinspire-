<style>
    .profilex {
        background: #fff;
        margin-bottom: 0px;
        transition: .5s;
        border: 0;
        border-radius: .1875rem;
        display: inline-block;
        position: relative;
        width: 100%;
        box-shadow: none;
    }

    .profilex .body {
        font-size: 14px;
        color: #424242;

        font-weight: 400;
    }

    /* .profile-page .profile-header {} */

    .profile-page .profile-header .profile-image img {
        border-radius: 50%;
        width: 140px;
        height: 140px;
        border: 1px solid #fff;
        <!---box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23)--->
    }
</style>



<!-- ========== MAIN ========== -->
<main id="content" role="main">
    <!-- Breadcrumb Section -->
    <div class="bg-white border-bottom">
        <div class="container space-top-1 pb-3">
            <div class="row">
                <div class="col-lg-5 order-lg-2 text-lg-right mb-4 mb-lg-0">
                    <div class="d-flex d-lg-inline-block justify-content-between justify-content-lg-end align-items-center align-items-lg-start">
                        <!-- Breadcrumb Nav Toggle Button -->
                        <div class="d-lg-none">
                            <button type="button" class="navbar-toggler btn u-hamburger u-hamburger--dark" aria-label="Toggle navigation" aria-expanded="false" aria-controls="breadcrumbNavBar" data-toggle="collapse" data-target="#breadcrumbNavBar">
                                <span id="breadcrumbHamburgerTrigger" class="u-hamburger__box">
                                    <span class="u-hamburger__inner"></span>
                                </span>
                            </button>
                        </div>
                        <!-- End Breadcrumb Nav Toggle Button -->
                    </div>
                </div>
                <div class="col-md-10 profile-page">
                    <div class="profilex profile-header">
                        <div class="">
                            <div class="row">
                                <div class="mt-3">
                                    <div class="profile-image float-md-right"> <img src="<?= !empty($user) ?  $this->Custom->getDp($user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt=""> </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-12 ml-3 mt-5">
                                    <h4 class="ml-2 mb-1"><strong><?php echo ucfirst($user->firstname) . ' ' . ucfirst(substr($user->lastname, 0, 50)) . ""; ?></strong> </h4>

                                    <p><?= !empty($user->sayings) ? "<q>" . $user->sayings . "</q>" : ""; ?></p>
                                    
                                    
                           
                                    
                                    
                                   
                                    
                                    
                                    
                                    <b><?= $user->followers_count ?></b> <?= $user->followers_count > 1 ? "followers" : "follower"; ?> &bull; <b><?= $this->Custom->userContributions($user) ?></b> contributions
                                    <div>

                                        <!-- Navbar -->
                                        <div class="ml-2 u-header u-header-left-aligned-nav u-header--bg-transparent-lg small u-header--dark-nav-links mb-0 accountnav">
                                            <div class="u-header__section bg-transparent">
                                                <nav class="js-breadcrumb-menu navbar navbar-expand-lg u-header__navbar u-header__navbar--no-space">
                                                    <div id="breadcrumbNavBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                                        <ul class="navbar-nav u-header__navbar-nav">

                                                            <!-- Activity -->
                                                            <li class="nav-item u-header__nav-item">
                                                                <a class="nav-link u-header__nav-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $user->username]); ?>">Activity Feed</a>
                                                            </li>
                                                            <!-- Activity -->

                                                            <!-- Reviews -->
                                                            <li class="nav-item  u-header__nav-item">
                                                                <a class="nav-link u-header__nav-link " href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'reviews', $user->username]); ?>">
                                                                    Reviews
                                                                </a>
                                                            </li>
                                                            <!-- Reviews -->

                                                            <!-- Business Photos -->
                                                            <li class="nav-item  u-header__nav-item">
                                                                <a class="nav-link u-header__nav-link " href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'businessPhotos', $user->username]); ?>">
                                                                    Business Photos
                                                                </a>
                                                            </li>
                                                            <!-- Business Photos -->

                                                            <!-- Lists -->
                                                            <li class="nav-item  u-header__nav-item">
                                                                <a class="nav-link u-header__nav-link " href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'collections', $user->username]); ?>">
                                                                    Lists
                                                                </a>
                                                            </li>
                                                            <!-- Lists -->

                                                            <!-- Followers -->
                                                            <li class="nav-item  u-header__nav-item">
                                                                <a class="nav-link u-header__nav-link " href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'followers', $user->username]); ?>">
                                                                    Followers
                                                                </a>
                                                            </li>
                                                            <!-- Followers -->

                                                            <!-- Following -->
                                                            <li class="nav-item  u-header__nav-item">
                                                                <a class="nav-link u-header__nav-link " href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'following', $user->username]); ?>">
                                                                    Following
                                                                </a>
                                                            </li>
                                                            <!-- Following -->
                                                            <?php if (empty($currentUser)) { ?>
                                                                <li class="nav-item  u-header__nav-item">
                                                                    <a class="nav-link u-header__nav-link " href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'join', $user->username]); ?>">
                                                                        Join <?= ucfirst($user->firstname) ?> on Localinspire
                                                                    </a>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </nav>
                                            </div>
                                        </div>
                                        <!-- End Navbar -->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <?php //if (!empty($currentUser)) {  
                    ?>

                    <div class="btn-group btn-group-sm" role="group" aria-label="Button group with nested dropdown">
                        <?php if (!empty($currentUser) and $currentUser->id == $user->id) { ?>
                        <?php } elseif (!empty($user)) { ?>
                            <button type="button" class="btn btn-outline-primary txt-11 bold sendmessage" data-receievername="<?= ucwords($user->name_desc) ?>" data-receieverid="<?= $user->id ?>"> <span class="far bold fa-envelope mr-2"></span>
                                Message</button>
                        <?php } ?>

                        <?php if (!empty($currentUser) and ($currentUser->sa or $currentUser->admin)) { ?>

                            <div class="btn-group btn-group-sm" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary bold" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" id="btnGroupDrop1menu">
                                    <a class="dropdown-item" href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'users', 'action' => 'view', $user->id]); ?>">View in admin area</a>
                                    <a class="dropdown-item" href="<?= $this->Url->build(['prefix' =>  'Admin', 'controller' => 'users', 'action' => 'edit', $user->id]); ?>">Edit user</a>
                                    <a class="dropdown-item" href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'users', 'action' => 'toggleStatus', $user->id]); ?>"><?= $user->active ? "Suspend" : "Activate" ?></a>
                                    <a class="dropdown-item" href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'users', 'action' => 'email', $user->id]); ?>">Send Email</a>
                                    <a class="dropdown-item" href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'users', 'action' => 'resetPassword', $user->id]); ?>" onclick="return confirm('Reset Password of <?= ucwords($user->name_desc) ?> ?')">Reset Password</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php //} 
                    ?>
                </div>
            </div>
            <!-- End Breadcrumb Section -->
        </div>
        <div class="border-bottom">

        </div>
    </div>

</main>