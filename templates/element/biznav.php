<!-- ========== MAIN ========== -->
<main id="content" role="main">
  <!-- Breadcrumb Section -->
  <div class="bg-primary">
    <!-- Breadcrumb Nav Toggle Button -->
    <div class="d-lg-none">
      <button type="button" class="navbar-toggler btn u-hamburger u-hamburger--dark" aria-label="Toggle navigation" aria-expanded="false" aria-controls="breadcrumbNavBar" data-toggle="collapse" data-target="#breadcrumbNavBar">
        <span id="breadcrumbHamburgerTrigger" class="u-hamburger__box">
          <span class="u-hamburger__inner"></span>
        </span>
      </button>
    </div>
    <!-- End Breadcrumb Nav Toggle Button -->
    <div class="container space-bottom-lg-0">
      <div class="d-lg-flex justify-content-lg-between align-items-lg-center">
        <!-- Navbar -->
        <div class="u-header u-header-left-aligned-nav u-header--bg-transparent-lg u-header--white-nav-links z-index-4">
          <div class="u-header__section bg-transparent">
            <nav class="js-breadcrumb-menu navbar navbar-expand-lg u-header__navbar u-header__navbar--no-space" style="padding:0;">
              <div id="breadcrumbNavBar" class="collapse navbar-collapse u-header__navbar-collapse">
                <ul class="navbar-nav u-header__navbar-nav">

                  <!-- Others -->
                  <li class="nav-item u-header__nav-item">
                    <a class="nav-link u-header__nav-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => "biz", 'action' => 'index']); ?>">Dashboard</a>
                  </li>
                  <!-- Others -->

                  <!-- Others -->
                  <li class="nav-item u-header__nav-item">
                    <a class="nav-link u-header__nav-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => "biz", 'action' => 'activity']); ?>">Activity</a>
                  </li>
                  <!-- Others -->

                  <!-- Account Settings -->
                  <li class="nav-item sr-has-sub-menu u-header__nav-item" data-event="hover" data-animation-in="slideInUp" data-animation-out="fadeOut">
                    <a id="accountSettingsDropdown" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false" aria-labelledby="accountSettingsDropdownMenu">

                      Business Information
                    </a>

                    <ul id="accountSettingsDropdownMenu" class="sr-sub-menu u-header__sub-menu u-header__sub-menu--spacer" style="min-width: 230px;" aria-labelledby="accountSettingsDropdown">
                      <li><a class="nav-link u-header__sub-menu-nav-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'edit', $active_business->id, \Cake\Utility\Text::slug(strtolower($active_business->name))]); ?>">Edit business information</a></li>

                      <li><a class="nav-link u-header__sub-menu-nav-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => "account", 'action' => 'password']); ?>">Change password</a></li>
                      <li><a class="nav-link u-header__sub-menu-nav-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => "account", 'action' => 'notifications']); ?>">Notifications</a></li>
                    </ul>
                  </li>
                  <!-- Account Settings -->


                  <!-- Accessibility -->
                  <li class="nav-item sr-has-sub-menu u-header__nav-item" data-event="hover" data-animation-in="slideInUp" data-animation-out="fadeOut">
                    <a id="accessibilityDropdown" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false" aria-labelledby="accessibilityDropdownMenu">
                      Manage Business
                    </a>

                    <ul id="accessibilityDropdownMenu" class="sr-sub-menu u-header__sub-menu u-header__sub-menu--spacer" style="min-width: 230px;" aria-labelledby="accessibilityDropdown">
                      <li><a class="nav-link u-header__sub-menu-nav-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => "biz", 'action' => 'photos']); ?>">Manage photos</a></li>
                      <li><a class="nav-link u-header__sub-menu-nav-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => "account", 'action' => 'messages']); ?>">User messages</a></li>
                      <li><a class="nav-link u-header__sub-menu-nav-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => "biz", 'action' => 'reviews']); ?>">Manage reviews</a></li>
                      <!--<li><a class="nav-link u-header__sub-menu-nav-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => "account", 'action' => 'questions']); ?>">Mange Questions</a></li>-->

                    </ul>
                  </li>
                  <!-- Accessibility -->

                  <!-- General -->
                  <li class="nav-item sr-has-sub-menu u-header__nav-item" data-event="hover" data-animation-in="slideInUp" data-animation-out="fadeOut">
                    <a id="generalDropdown" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false" aria-labelledby="generalDropdownMenu">
                      Increase Business
                    </a>

                    <ul id="generalDropdownMenu" class="sr-sub-menu u-header__sub-menu u-header__sub-menu--spacer" style="min-width: 230px;" aria-labelledby="generalDropdown">
                      <li><a class="nav-link u-header__sub-menu-nav-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => "biz", 'action' => 'feature']); ?>">Feature business</a></li>
                      <li><a class="nav-link u-header__sub-menu-nav-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => "biz", 'action' => 'callToAction']); ?>">Add a call to action</a></li>
                      <li><a class="nav-link u-header__sub-menu-nav-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => "biz", 'action' => 'specialOffers']); ?>">Add special offers</a></li>
                      <li><a class="nav-link u-header__sub-menu-nav-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => "biz", 'action' => 'announcements']); ?>">Announcements</a></li>
                      <li><a class="nav-link u-header__sub-menu-nav-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => "biz", 'action' => 'share']); ?>">Share your business</a></li>


                    </ul>
                  </li>
                  <!-- General -->
                  <?php if (count($userBusinesses) > 1) { ?>
                    <li class="nav-item sr-has-sub-menu u-header__nav-item" data-event="hover" data-animation-in="slideInUp" data-animation-out="fadeOut">
                      <a id="generalDropdown" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false" aria-labelledby="generalDropdownMenu">
                        Switch Business
                      </a>

                      <ul id="generalDropdownMenu" class="sr-sub-menu u-header__sub-menu u-header__sub-menu--spacer" style="min-width: 230px;" aria-labelledby="generalDropdown">
                        <?php foreach ($userBusinesses as $biz) { ?>
                          <li><a class="nav-link u-header__sub-menu-nav-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => "biz", 'action' => 'switch', $biz->id]); ?>"><?= $biz->name ?></a></li>
                        <?php } ?>

                      </ul>
                    </li>
                  <?php } ?>

                </ul>
              </div>
            </nav>
          </div>
        </div>
        <!-- End Navbar -->

        <div class="ml-lg-auto" style="    text-align: right;">
          <!-- Button -->
          <a class="btn btn-sm btn-soft-white" href="<?= $this->Url->build(['prefix' => false, 'controller' => "account", 'action' => 'index']); ?>">
            <span class="fas fa-tachometer-alt mr-2"></span>
            Account Area
          </a>
          <!-- End Button -->
        </div>
        <?php if ($isCityOwner) { ?>
          <div class="ml-lg-auto" style="text-align: right;">
            <!-- Button -->
            <a class="btn btn-sm btn-soft-white ml-2" href="<?= $this->Url->build(['prefix' => false, 'controller' => "manager", 'action' => 'index']); ?>">
              <span class="fas fa-store mr-2"></span>
              City Manager
            </a>
            <!-- End Button -->
          </div>

        <?php } ?>
      </div>
    </div>
  </div>
</main>
<!-- End Breadcrumb Section -->