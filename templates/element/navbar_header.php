<nav class="navbar navbar-expand-lg navbar-light bg-faded">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-container">
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <!-- <li class="nav-item mr-2">
                        <a id="navbar-fullscreen" href="javascript:;" class="nav-link apptogglefullscreen">
                            <i class="ft-maximize font-medium-3 blue-grey darken-4"></i>
                            <p class="d-none">fullscreen</p>
                        </a>
                    </li> -->
                    <!-- <li class="dropdown nav-item">
                        <a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle">
                            <i class="ft-flag font-medium-3 blue-grey darken-4"></i>
                            <span class="selected-language d-none"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="javascript:;" class="dropdown-item py-1">
                                <img src="<?= $this->Url->build('/assets/', ['fullBase' => true]); ?>img/flags/us.png" class="langimg" />
                                <span> English</span>
                            </a>
                            <a href="javascript:;" class="dropdown-item py-1">
                                <img src="<?= $this->Url->build('/assets/', ['fullBase' => true]); ?>img/flags/es.png" class="langimg" />
                                <span> Yoruba</span>
                            </a>
                            <a href="javascript:;" class="dropdown-item py-1">
                                <img src="<?= $this->Url->build('/assets/', ['fullBase' => true]); ?>img/flags/br.png" class="langimg" />
                                <span> Hausa</span>
                            </a>
                            <a href="javascript:;" class="dropdown-item">
                                <img src="<?= $this->Url->build('/assets/', ['fullBase' => true]); ?>img/flags/de.png" class="langimg" />
                                <span> Igbo</span>
                            </a>
                        </div>
                    </li> -->

                    <li class="dropdown nav-item">
                        <a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle">
                            <i class="ft-user font-medium-3 blue-grey darken-4"></i>
                            <p class="d-none">User Settings</p>
                        </a>
                        <div ngbdropdownmenu="" aria-labelledby="dropdownBasic3" class="dropdown-menu dropdown-menu-right">
                            <a href="<?= $this->Url->build('/', ['fullBase' => true]); ?>" class="dropdown-item py-1">
                                <i class="ft-home mr-2"></i>
                                <span>Home</span>
                            </a>
                            <?= $this->Html->link('<i class="fa fa-user"></i><span>&nbsp;&nbsp;&nbsp; Account</span>', ['prefix' => false, 'prefix' => false, 'controller' => 'account', 'action' => 'index'], ['escape' => false, 'class' => 'dropdown-item', 'data-close' => "true", 'title' => "User Account Area"]); ?>
                            <?= $this->Html->link('<i class="fa fa-key"></i><span>&nbsp;&nbsp;&nbsp; Password</span>', ['prefix' => false, 'prefix' => false, 'controller' => 'account', 'action' => 'password'], ['escape' => false, 'class' => 'dropdown-item', 'data-close' => "true", 'title' => "Change Password"]); ?>
                            <?= $this->Html->link('<i class="ft-power mr-2"></i><span>Logout</span>', ["prefix" => false, 'controller' => 'GeneralActions', 'action' => 'logout'], ['escape' => false, 'class' => 'dropdown-item', 'data-close' => "true", 'title' => "Sign Out"]); ?>
                        </div>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="javascript:;" class="nav-link position-relative notification-sidebar-toggle">
                            <i class="ft-align-left font-medium-3 blue-grey darken-4"></i>
                            <p class="d-none">Notifications Sidebar</p>
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
</nav>