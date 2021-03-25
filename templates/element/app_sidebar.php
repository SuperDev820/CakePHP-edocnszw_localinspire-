<!--.main-menu(class="#{menuColor} #{menuOpenType}", class=(menuShadow == true ? 'menu-shadow' : ''))-->
<div data-active-color="black" data-background-color="white" data-image="" class="app-sidebar">
    <!-- main menu header-->
    <!-- Sidebar Header starts-->
    <div class="sidebar-header">
        <div class="logo clearfix">
            <a href="<?= $this->Url->build('/', ['fullBase' => true]); ?>" class="logo-text float-left">
                <div class="logo-img">
                    <img src="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/img/favicon.png" style="max-width: 30px;">
                </div>
                <span class="text align-middle">Inspire</span>
            </a>
            <a id="sidebarToggle" href="javascript:;" class="nav-toggle d-none d-sm-none d-md-none d-lg-block">
                <i data-toggle="expanded" class="ft-toggle-right toggle-icon"></i>
            </a>
            <a id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none">
                <i class="ft-x"></i>
            </a>
        </div>
    </div>
    <!-- Sidebar Header Ends-->
    <!-- / main menu header-->
    <!-- main menu content-->
    <div class="sidebar-content">
        <div class="nav-container">
            <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
                <li class="nav-item <?= $page == 'dashboard' ? 'active' : '' ?>">
                    <a href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'index']); ?>">
                        <i class="fa fa-home"></i>
                        <span data-i18n="" class="menu-title">Dashboard</span>
                    </a>
                </li>
                <?php if ($currentUser->sa) : ?>
                    <li class="nav-item <?= $page == 'users' ? 'active' : '' ?>">
                        <a href="<?= $this->Url->build(['controller' => 'users', 'action' => 'index']); ?>">
                            <i class="ft-users"></i>
                            <span data-i18n="" class="menu-title">Users</span>
                            <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1">
                                <?php echo number_format($viewCounts['users']) ?>
                            </span>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="has-sub nav-item">
                    <a href="javascript:;"><i class="ft-edit"></i><span data-i18n="" class="menu-title">Reports</span></a>
                    <ul class="menu-content">
                        <li class="<?= $page == 'report_answers' ? 'active' : '' ?>"><a href="<?= $this->Url->build(['controller' => 'reports', 'action' => 'answers']); ?>" class="menu-item">Answers <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1"><?php echo number_format($viewCounts['report_answers']) ?></span></a>
                        </li>
                        <li class="<?= $page == 'report_reviews' ? 'active' : '' ?>"><a href="<?= $this->Url->build(['controller' => 'reports', 'action' => 'reviews']); ?>" class="menu-item">Reviews <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1"><?php echo number_format($viewCounts['report_reviews']) ?></a></li>
                        <li class="<?= $page == 'report_review_response' ? 'active' : '' ?>"><a href="<?= $this->Url->build(['controller' => 'reports', 'action' => 'reviewResponses']); ?>" class="menu-item">Review Responses <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1"><?php echo number_format($viewCounts['report_review_responses']) ?></a></li>
                        <li class="<?= $page == 'report_review_photo' ? 'active' : '' ?>"><a href="<?= $this->Url->build(['controller' => 'reports', 'action' => 'reviewPhotos']); ?>" class="menu-item">Review Photos <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1"><?php echo number_format($viewCounts['report_review_photos']) ?></a></li>
                        <li class="<?= $page == 'report_photo' ? 'active' : '' ?>"><a href="<?= $this->Url->build(['controller' => 'reports', 'action' => 'photos']); ?>" class="menu-item">Photos <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1"><?php echo number_format($viewCounts['report_photos']) ?></a></li>
                        <li class="<?= $page == 'report_question' ? 'active' : '' ?>"><a href="<?= $this->Url->build(['controller' => 'reports', 'action' => 'questions']); ?>" class="menu-item">Questions <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1"><?php echo number_format($viewCounts['report_questions']) ?></a></li>
                        <li class="<?= $page == 'report_profile' ? 'active' : '' ?>"><a href="<?= $this->Url->build(['controller' => 'reports', 'action' => 'profiles']); ?>" class="menu-item">Profiles <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1"><?php echo number_format($viewCounts['report_profiles']) ?></a></li>
                    </ul>
                </li>
                <li class="has-sub nav-item ">
                    <a href="javascript:;"><i class="ft-grid"></i><span data-i18n="" class="menu-title">Businesses</span></a>
                    <ul class="menu-content">
                        <li class="<?= $page == 'businesses' ? 'active' : '' ?>"><a href="<?= $this->Url->build(['controller' => 'businesses', 'action' => 'index']); ?>" class="menu-item">View all <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1"><?php //echo number_format($viewCounts['businesses']) ?></span></a></li>
                        <li class="<?= $page == 'businessesedits' ? 'active' : '' ?>"><a href="<?= $this->Url->build(['controller' => 'businesses', 'action' => 'editRequests']); ?>" class="menu-item">Edit Requests <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1"><?php echo number_format($viewCounts['edit_requests']) ?></span></a></li>
                    </ul>
                </li>
                <li class="has-sub nav-item ">
                    <a href="javascript:;"><i class="fa fa-credit-card"></i><span data-i18n="" class="menu-title">Billing</span></a>
                    <ul class="menu-content">
                        <li class="<?= $page == 'coupons' ? 'active' : '' ?>"><a href="<?= $this->Url->build(['controller' => 'coupons', 'action' => 'index']); ?>" class="menu-item">Coupons <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1"><?php echo number_format($viewCounts['coupons']) ?></span></a></li>
                        <li class="<?= $page == 'packages' ? 'active' : '' ?>"><a href="<?= $this->Url->build(['controller' => 'packages', 'action' => 'index']); ?>" class="menu-item">Packages <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1"><?php echo number_format($viewCounts['packages']) ?></span></a></li>
                        <li class="<?= $page == 'subscriptions' ? 'active' : '' ?>"><a href="<?= $this->Url->build(['controller' => 'subscriptions', 'action' => 'index']); ?>" class="menu-item">Subscriptions <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1"><?php echo number_format($viewCounts['subscriptions']) ?></span></a></li>
                        <li class="<?= $page == 'city_subscriptions' ? 'active' : '' ?>"><a href="<?= $this->Url->build(['controller' => 'citySubscriptions', 'action' => 'index']); ?>" class="menu-item">City Subs <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1"><?php echo number_format($viewCounts['city_subscriptions']) ?></span></a></li>
                        <li class="<?= $page == 'reminders' ? 'active' : '' ?>"><a href="<?= $this->Url->build(['controller' => 'reminders', 'action' => 'index']); ?>" class="menu-item">Reminders <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1"><?php echo number_format($viewCounts['reminders']) ?></span></a></li>
                    </ul>
                </li>
                <!-- <li class="nav-item <?= $page == 'businesses' ? 'active' : '' ?>">
                    <a href="<?= $this->Url->build(['controller' => 'businesses', 'action' => 'index']); ?>">
                        <i class="ft-grid"></i>
                        <span data-i18n="" class="menu-title">Businesses</span> <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1"><?php echo number_format($viewCounts['businesses']) ?></span>
                    </a>
                </li> -->
                <li class="nav-item <?= $page == 'questions' ? 'active' : '' ?>">
                    <a href="<?= $this->Url->build(['controller' => 'Questions', 'action' => 'index']); ?>">
                        <i class="fa fa-question"></i>
                        <span data-i18n="" class="menu-title">Questions</span> <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1"><?php echo number_format($viewCounts['questions']) ?></span>
                    </a>
                </li>
                <li class="nav-item <?= $page == 'reviews' ? 'active' : '' ?>">
                    <a href="<?= $this->Url->build(['controller' => 'Reviews', 'action' => 'index']); ?>">
                        <i class="fa fa-star"></i>
                        <span data-i18n="" class="menu-title">Reviews </span><span class="tag badge badge-pill badge-dark float-right mr-1 mt-1"><?php echo number_format($viewCounts['reviews']) ?></span>
                    </a>
                </li>
                <li class="nav-item <?= $page == 'cities' ? 'active' : '' ?>">
                    <a href="<?= $this->Url->build(['controller' => 'cities', 'action' => 'index']); ?>">
                        <i class="fa fa-building"></i>
                        <span data-i18n="" class="menu-title">Cities</span> <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1"><?php echo number_format($viewCounts['cities']) ?></span>
                        <!-- <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1">
                            <?php //echo $viewCounts['plans'] 
                            ?>
                        </span> -->
                    </a>
                </li>
                <li class="has-sub nav-item ">
                    <a href="javascript:;"><i class="fa fa-cogs"></i><span data-i18n="" class="menu-title">Settings</span></a>
                    <ul class="menu-content">
                        <li class="nav-item <?= $page == 'otions' ? 'active' : '' ?>">
                            <a href="<?= $this->Url->build(['controller' => 'options', 'action' => 'index']); ?>">
                                <span data-i18n="" class="menu-title">Site Options</span>
                            </a>
                        </li>
                        <li class="nav-item <?= $page == 'keywords' ? 'active' : '' ?>">
                            <a href="<?= $this->Url->build(['controller' => 'searchKeywords', 'action' => 'index']); ?>">
                                <span data-i18n="" class="menu-title">Keywords</span>
                                <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1">
                                    <?php echo $viewCounts['search_keywords']
                                    ?>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item <?= $page == 'filters' ? 'active' : '' ?>">
                            <a href="<?= $this->Url->build(['controller' => 'filters', 'action' => 'index']); ?>">
                                <span data-i18n="" class="menu-title">Filters</span>
                                <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1">
                                    <?php echo $viewCounts['filters']
                                    ?>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item <?= $page == 'categories' ? 'active' : '' ?>">
                            <a href="<?= $this->Url->build(['controller' => 'categories', 'action' => 'index']); ?>">
                                <span data-i18n="" class="menu-title">Categories</span>
                                <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1">
                                    <?php echo $viewCounts['categories']
                                    ?>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item <?= $page == 'subcategories' ? 'active' : '' ?>">
                            <a href="<?= $this->Url->build(['controller' => 'subcategories', 'action' => 'index']); ?>">
                                <span data-i18n="" class="menu-title">Subcategories</span>
                                <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1">
                                    <?php echo $viewCounts['subcategories']
                                    ?>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item <?= $page == 'sic2cats' ? 'active' : '' ?>">
                            <a href="<?= $this->Url->build(['controller' => 'Sic2categories', 'action' => 'index']); ?>">
                                <span data-i18n="" class="menu-title">SIC2</span>
                                <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1">
                                    <?php echo $viewCounts['sic2cats']
                                    ?>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item <?= $page == 'sic4cats' ? 'active' : '' ?>">
                            <a href="<?= $this->Url->build(['controller' => 'Sic4categories', 'action' => 'index']); ?>">
                                <span data-i18n="" class="menu-title">SIC4</span>
                                <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1">
                                    <?php echo $viewCounts['sic4cats']
                                    ?>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item <?= $page == 'sic8cats' ? 'active' : '' ?>">
                            <a href="<?= $this->Url->build(['controller' => 'Sic8categories', 'action' => 'index']); ?>">
                                <span data-i18n="" class="menu-title">SIC8</span>
                                <span class="tag badge badge-pill badge-dark float-right mr-1 mt-1">
                                    <?php echo $viewCounts['sic8cats']
                                    ?>
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="<?= $this->Url->build(["prefix" => false, 'controller' => 'Api', 'action' => 'logout']); ?>">
                        <i class="ft-power"></i>
                        <span data-i18n="" class="menu-title">Logout </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- main menu content-->
    <div class="sidebar-background"></div>
    <!-- main menu footer-->
    <!-- include includes/menu-footer-->
    <!-- main menu footer-->
</div>
<script src="<?= $this->Url->build('/assets/', ['fullBase' => true]); ?>js/app-sidebar.js" type="text/javascript"></script>