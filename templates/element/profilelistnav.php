<!-- ========== MAIN ========== -->
<main id="content" role="main">
  <!-- Breadcrumb Section -->
  <div class="bg-white">


    <div class="container space-bottom-lg-0">
      <div class="d-lg-flex justify-content-lg-between align-items-lg-center">
        <!-- Breadcrumb Nav Toggle Button -->
        <div class="d-lg-none">
          <button type="button" class="navbar-toggler btn u-hamburger u-hamburger--dark" aria-label="Toggle navigation" aria-expanded="false" aria-controls="breadcrumbNavBar" data-toggle="collapse" data-target="#breadcrumbNavBar">
            <span id="breadcrumbHamburgerTrigger" class="u-hamburger__box">
              <span class="u-hamburger__inner"></span>
            </span>
          </button>
        </div>
        <!-- End Breadcrumb Nav Toggle Button -->
        <div class="container space-bottom-1 space-bottom-lg-0 accountnav">
          <div class="d-lg-flex justify-content-lg-between align-items-lg-center">
            <!-- Navbar -->
            <div class="u-header u-header-left-aligned-nav u-header--bg-transparent-lg small u-header--dark-nav-links z-index-4">
              <div class="u-header__section bg-transparent">
                <nav class="js-breadcrumb-menu navbar navbar-expand-lg u-header__navbar u-header__navbar--no-space">
                  <div id="breadcrumbNavBar" class="collapse navbar-collapse u-header__navbar-collapse">
                    <ul class="navbar-nav u-header__navbar-nav">

                      <!-- Activity -->
                      <li class="nav-item u-header__nav-item">
                        <a class="nav-link u-header__nav-link" href="<?php echo base_url(); ?>user_details?uid=<?= $Member_ID ?>">Activity Feed</a>
                      </li>
                      <!-- Activity -->

                      <!-- Reviews -->
                      <li class="nav-item  u-header__nav-item">
                        <a class="nav-link u-header__nav-link " href="<?php echo base_url(); ?>user_details_reviews?uid=<?= $Member_ID ?>">
                          Reviews
                        </a>
                      </li>
                      <!-- Reviews -->

                      <!-- Business Photos -->
                      <li class="nav-item  u-header__nav-item">
                        <a class="nav-link u-header__nav-link " href="<?php echo base_url(); ?>user_details_biz_photos?uid=<?= $Member_ID ?>">
                          Business Photos
                        </a>
                      </li>
                      <!-- Business Photos -->

                      <!-- Lists -->
                      <li class="nav-item  u-header__nav-item">
                        <a class="nav-link u-header__nav-link " href="<?php echo base_url(); ?>user_details_lists?uid=<?= $Member_ID ?>">
                          Lists
                        </a>
                      </li>
                      <!-- Lists -->

                      <!-- Followers -->
                      <li class="nav-item  u-header__nav-item">
                        <a class="nav-link u-header__nav-link " href="<?php echo base_url(); ?>user_details_followers?uid=<?= $Member_ID ?>">
                          Followers
                        </a>
                      </li>
                      <!-- Followers -->

                      <!-- Following -->
                      <li class="nav-item  u-header__nav-item">
                        <a class="nav-link u-header__nav-link " href="<?php echo base_url(); ?>user_details_following?uid=<?= $Member_ID ?>">
                          Following
                        </a>
                      </li>
                      <!-- Following -->



                    </ul>
                  </div>
                </nav>
              </div>
            </div>
            <!-- End Navbar -->

            <div class="ml-lg-auto">

            </div>





          </div>
        </div>
      </div>
    </div>
    <!-- End Breadcrumb Section -->