<?php $this->assign('title', 'View User'); ?>
<style>
    #user-profile .profile-with-cover .profile-cover-buttons {
        /* position: absolute; */
        top: unset;
        right: 10px;
    }

    #questions_table td:nth-child(3) {
        text-align: left;
    }
    /* #reviews_table td:nth-child(3) {
        text-align: left;
    } */
</style>
<section id="user-profile">
    <div class="row">
        <div class="col-12">
            <div class="card profile-with-cover">
                <div class="card-img-top img-fluid bg-cover height-100" style="background: grey"></div>
                <div class="media profil-cover-details row">
                    <div class="col-5">
                        <div class="align-self-start halfway-fab pl-3 pt-2">
                            <div class="text-left">
                                <h3 class="card-title white">
                                    <?= ucwords($user->name_desc) ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="align-self-center halfway-fab text-center">
                            <a class="profile-image">
                                <img src="<?= $this->Custom->getDp($user->image, 'users', '150x150') ?>" alt="Card image" class="rounded-circle img-border gradient-summer width-100">
                            </a>
                        </div>
                    </div>
                    <div class="col-5">
                    </div>
                    <div class="profile-cover-buttons">
                        <div class="media-body halfway-fab align-self-end">
                            <div class="text-right d-none d-sm-none d-md-none d-lg-block">
                                <?= $this->Html->link(__('<i class="fa fa-edit"></i> Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm', 'escape' => false]) ?>
                                <a href="<?= $this->Url->build(['action' => 'email', $user->id]); ?>" class="btn btn-info btn-xs btn-raised mr-2 btn-sm"><i class="fa fa-envelope"></i> Email User</a>


                                <a class="btn btn-dark btn-xs btn-raised mr-2 btn-sm" href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'users', 'action' => 'toggleStatus', $user->id]); ?>"><?= $user->active ? "Suspend" : "Activate" ?></a>

                                <a class="btn btn-dark btn-xs btn-raised mr-2 btn-sm" href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'users', 'action' => 'resetPassword', $user->id]); ?>" onclick="return confirm('Reset Password of <?= ucwords($user->name_desc) ?> ?')">Reset Password</a>
                                <!-- <button type="button" class="btn btn-success btn-raised mr-3"><i class="fa fa-dashcube"></i> Message</button> -->
                            </div>
                            <!-- <div class="text-right d-block d-sm-block d-md-block d-lg-none">
                                <button type="button" class="btn btn-primary btn-raised mr-2"><i class="fa fa-plus"></i></button>
                                <button type="button" class="btn btn-success btn-raised mr-3"><i class="fa fa-dashcube"></i></button>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="profile-section">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 ">
                            <ul class="profile-menu no-list-style">
                                <li>
                                    <a href="#reviews" class="primary font-medium-2 font-weight-600">Reviews</a>
                                </li>
                                <li>
                                    <a href="#questions" class="primary font-medium-2 font-weight-600">Questions</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-2 col-md-2 text-center">
                            <span class="font-medium-2 text-uppercase">
                                <?= $user->firstname ?>
                            </span>
                            <p class="grey font-small-2"> <?= $user->about_me ?></p>
                        </div>
                        <div class="col-lg-5 col-md-5">
                            <ul class="profile-menu no-list-style">
                                <li>
                                    <a href="#answers" class="primary font-medium-2 font-weight-600">Answers</a>
                                </li>
                                <li>
                                    <a href="#business_photos" class="primary font-medium-2 font-weight-600">Business Photos</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Basic User Details Ends-->

<!--About section starts-->
<section id="about">
    <div class="row">
        <div class="col-12">
            <div class="content-header">About</div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h5>Personal Information</h5> -->
                </div>
                <div class="card-body">
                    <div class="card-block">
                        <!-- <div class="mb-3">
                            <span class="text-bold-500 primary">About Me:</span>
                            <span class="display-block overflow-hidden">
                            </span>
                        </div> -->
                        <!-- <hr> -->
                        <div class="row">

                            <div class="col-12 col-md-6 col-lg-4">
                                <ul class="no-list-style">
                                    <li class="mb-2">
                                        <span class="text-bold-500 primary">
                                            <a>
                                                <i class="ft-briefcase font-small-3"></i> Username:</a>
                                        </span>
                                        <span class="display-block overflow-hidden">
                                            <?= $user->username ?>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <ul class="no-list-style">


                                    <li class="mb-2">
                                        <span class="text-bold-500 primary">
                                            <a>
                                                <i class="ft-book font-small-3"></i> Joined:</a>
                                        </span>
                                        <span class="display-block overflow-hidden">
                                            <?= $this->Custom->niceDateMonthDayYear($user->created) ?>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <ul class="no-list-style">
                                    <li class="mb-2">
                                        <span class="text-bold-500 primary">
                                            <a>
                                                <i class="ft-smartphone font-small-3"></i> Phone Number:</a>
                                        </span>
                                        <span class="display-block overflow-hidden">
                                            <?= ucfirst($user->phone) ?>
                                        </span>
                                    </li>

                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--About section ends-->

<section id="reviews">
    <!-- <div class="row">
        <div class="col-12">
            <div class="content-header">Orders</div>
        </div>
    </div> -->
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h5>Personal Information</h5> -->
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Reviews by <?= ucwords($user->name_desc) ?></h4>
                        </div>
                        <div class="col-4 text-right">
                            <?php if ($currentUser->sa || $currentUser->admin) : ?>
                                <!-- <a href="<?= $this->Url->build(['controller' => 'instances', 'action' => 'add']); ?>"
                                class="btn round btn-raised btn-dark">
                                <i class="fa fa-plus"></i>&nbsp; New Instance
                            </a> -->
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-block">
                        <!-- <div class="mb-3">
                            <span class="text-bold-500 primary">About Me:</span>
                            <span class="display-block overflow-hidden">
                            </span>
                        </div> -->
                        <!-- <hr> -->
                        <div class="row">
                            <div class="col-12 col-md-12 ">
                                <div class="table-responsive">
                                    <?php echo $this->element('reviews_table', ['userid' => $user->id, 'showUser' => false, 'ajax' => true, 'show_edit' => false, 'show_remove' => false, "idtouse" => "reviews_table", "record_name" => "reviews"]) ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="questions">
    <!-- <div class="row">
        <div class="col-12">
            <div class="content-header">Orders</div>
        </div>
    </div> -->
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h5>Personal Information</h5> -->
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Questions by <?= ucwords($user->name_desc) ?></h4>
                        </div>
                        <div class="col-4 text-right">
                            <?php if ($currentUser->sa || $currentUser->admin) : ?>
                                <!-- <a href="<?= $this->Url->build(['controller' => 'instances', 'action' => 'add']); ?>"
                                class="btn round btn-raised btn-dark">
                                <i class="fa fa-plus"></i>&nbsp; New Instance
                            </a> -->
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-block">
                        <!-- <div class="mb-3">
                            <span class="text-bold-500 primary">About Me:</span>
                            <span class="display-block overflow-hidden">
                            </span>
                        </div> -->
                        <!-- <hr> -->
                        <div class="row">
                            <div class="col-12 col-md-12 ">
                                <div class="table-responsive">
                                    <?php echo $this->element('questions_table', ['userid' => $user->id, 'showUser' => false, 'ajax' => true, 'show_edit' => false, 'show_remove' => false, "idtouse" => "questions_table", "record_name" => "questions"]) ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="answers">
    <!-- <div class="row">
        <div class="col-12">
            <div class="content-header">Orders</div>
        </div>
    </div> -->
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h5>Personal Information</h5> -->
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Answers by <?= ucwords($user->name_desc) ?></h4>
                        </div>
                        <div class="col-4 text-right">
                            <?php if ($currentUser->sa || $currentUser->admin) : ?>
                                <!-- <a href="<?= $this->Url->build(['controller' => 'instances', 'action' => 'add']); ?>"
                                class="btn round btn-raised btn-dark">
                                <i class="fa fa-plus"></i>&nbsp; New Instance
                            </a> -->
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-block">
                        <!-- <div class="mb-3">
                            <span class="text-bold-500 primary">About Me:</span>
                            <span class="display-block overflow-hidden">
                            </span>
                        </div> -->
                        <!-- <hr> -->
                        <div class="row">
                            <div class="col-12 col-md-12 ">
                                <div class="table-responsive">
                                    <?php echo $this->element('answers_table', ['userid' => $user->id, 'showUser' => false, 'ajax' => true, 'show_edit' => false, 'show_remove' => false, "idtouse" => "answers_table", "record_name" => "answers", "searching" => false]) ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="business_photos">
    <!-- <div class="row">
        <div class="col-12">
            <div class="content-header">Orders</div>
        </div>
    </div> -->
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h5>Personal Information</h5> -->
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Business Photos by <?= ucwords($user->name_desc) ?></h4>
                        </div>
                        <div class="col-4 text-right">
                            <?php if ($currentUser->sa || $currentUser->admin) : ?>
                                <!-- <a href="<?= $this->Url->build(['controller' => 'instances', 'action' => 'add']); ?>"
                                class="btn round btn-raised btn-dark">
                                <i class="fa fa-plus"></i>&nbsp; New Instance
                            </a> -->
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-block">
                        <!-- <div class="mb-3">
                            <span class="text-bold-500 primary">About Me:</span>
                            <span class="display-block overflow-hidden">
                            </span>
                        </div> -->
                        <!-- <hr> -->
                        <div class="row">
                            <div class="col-12 col-md-12 ">
                                <div class="table-responsive">
                                    <?php echo $this->element('business_photos_table', ['userid' => $user->id, 'showUser' => false, 'ajax' => true, 'show_edit' => false, 'show_remove' => false, "idtouse" => "business_photos_table", "record_name" => "business photos", "searching" => false]) ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>