<!-- ========== MAIN ========== -->
<main id="" role="main">
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
                    <a class="nav-link u-header__nav-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => "manager", 'action' => 'index']); ?>">Dashboard</a>
                  </li>
                  <li class="nav-item u-header__nav-item">
                    <a class="nav-link u-header__nav-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => "manager", 'action' => 'earnings']); ?>">Earnings</a>
                  </li>
                  <li class="nav-item u-header__nav-item">
                    <a class="nav-link u-header__nav-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => "manager", 'action' => 'stories']); ?>">Stories</a>
                  </li>
                  <li class="nav-item u-header__nav-item">
                    <a class="nav-link u-header__nav-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => "manager", 'action' => 'paymentSettings']); ?>">Get Paid</a>
                  </li>

                  <li class="nav-item u-header__nav-item">
                    <a class="nav-link u-header__nav-link" href="<?= $this->Url->build(['prefix' => false, 'controller' => "manager", 'action' => 'cityDetails']); ?>">City Details</a>
                  </li>


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
        <?php if ($isBusinessOwner) { ?>
          <div class="ml-lg-auto" style="text-align: right;">
            <!-- Button -->
            <a class="btn btn-sm btn-soft-white ml-2" href="<?= $this->Url->build(['prefix' => false, 'controller' => "biz", 'action' => 'index']); ?>">
              <span class="fas fa-store mr-2"></span>
              Business Account
            </a>
            <!-- End Button -->
          </div>

        <?php } ?>
      </div>
    </div>
  </div>
</main>
<!-- End Breadcrumb Section -->