<!-- ========== MAIN ========== -->
  <main id="content" role="main">
    <!-- Breadcrumb Section -->
    <div class="bg-primary">
     
                        <!-- Breadcrumb Nav Toggle Button -->
                        <div class="d-lg-none">
                            <button type="button" class="navbar-toggler btn u-hamburger u-hamburger--dark"
                                    aria-label="Toggle navigation"
                                    aria-expanded="false"
                                    aria-controls="breadcrumbNavBar"
                                    data-toggle="collapse"
                                    data-target="#breadcrumbNavBar">
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
                      <a class="nav-link u-header__nav-link" href="<?php echo base_url();?>manager">Dashboard</a>
                    </li>
                    <!-- Others -->
                     <!-- Others -->
                    <li class="nav-item u-header__nav-item">
                      <a class="nav-link u-header__nav-link" href="<?php echo base_url();?>manager/payment_settings">Payment Settings</a>
                    </li>
                    <!-- Others -->
                    
                      <!-- Others -->
                    <li class="nav-item u-header__nav-item">
                      <a class="nav-link u-header__nav-link" href="<?php echo base_url();?>manager/performance_dashboard">Performance Dashboard</a>
                    </li>
                    <!-- Others -->
                      
                       <!-- Account Settings -->
                    <li class="nav-item sr-has-sub-menu u-header__nav-item"
                        data-event="hover"
                        data-animation-in="slideInUp"
                        data-animation-out="fadeOut">
                      <a id="accountSettingsDropdown" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false" aria-labelledby="accountSettingsDropdownMenu">
                        
                        City Articles & News
                      </a>

                      <ul id="accountSettingsDropdownMenu" class="sr-sub-menu u-header__sub-menu u-header__sub-menu--spacer" style="min-width: 230px;" aria-labelledby="accountSettingsDropdown">
                        <li><a class="nav-link u-header__sub-menu-nav-link" href="<?php echo base_url();?>manager/stories">City Articles & News</a></li>
                        
                        <li><a class="nav-link u-header__sub-menu-nav-link" href="<?php echo base_url();?>manager/add_story">Add Story</a></li>
                       
                      </ul>
                    </li>
                    <!-- Account Settings -->
                      
                      
                       <!-- Accessibility -->
                    <li class="nav-item sr-has-sub-menu u-header__nav-item"
                        data-event="hover"
                        data-animation-in="slideInUp"
                        data-animation-out="fadeOut">
                      <a id="accessibilityDropdown" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false" aria-labelledby="accessibilityDropdownMenu">
                        City Details
                      </a>

                      <ul id="accessibilityDropdownMenu" class="sr-sub-menu u-header__sub-menu u-header__sub-menu--spacer" style="min-width: 230px;" aria-labelledby="accessibilityDropdown">
                          <li><a class="nav-link u-header__sub-menu-nav-link" href="<?php echo base_url();?>manager/city_details">Add city details</a></li>
                          <li><a class="nav-link u-header__sub-menu-nav-link" href="<?php echo base_url();?>manager/purchased_cities">Manage cities</a></li>
                         
                         
                      </ul>
                    </li>
                    <!-- Accessibility --> 
                       
                   

                    

                   

                   
                  </ul>
                </div>
              </nav>
            </div>
          </div>
          <!-- End Navbar -->

             <div class="ml-lg-auto" style="    text-align: right;">
            <!-- Button -->
            <a class="btn btn-sm btn-soft-white mr-2" href="<?php echo base_url();?>account/">
              <span class="fas fa-tachometer-alt mr-2"></span>
              Account Area
            </a>
            <!-- End Button --> 
          </div>
          
          
          
          
          
        </div>
      </div>
    </div>
    <!-- End Breadcrumb Section -->