<?php $this->assign('title', 'View Coupon'); ?>
<style>
    #user-profile .profile-with-cover .profile-cover-buttons {
        /* position: absolute; */
        top: unset;
        right: 10px;
    }
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
                                <h3 class=" white">
                                    <?= $coupon->code ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-2">
                        <div class="align-self-center halfway-fab text-center">
                            <a class="profile-image">
                                <img src="<?= $this->Url->build('/backend/', ['fullBase' => true]); ?>app-assets/img/portrait/avatars/avatar-08.png" class="rounded-circle img-border gradient-summer width-100" alt="Card image">
                            </a>
                        </div>
                    </div> -->
                    <div class="col-5">
                    </div>
                    <div class="profile-cover-buttons">
                        <div class="media-body halfway-fab align-self-end">
                            <div class="text-right d-none d-sm-none d-md-none d-lg-block">
                                <?= $this->Html->link(__('<i class="fa fa-edit"></i>Edit Voucher'), ['action' => 'edit', $coupon->id], ['class' => 'btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm', 'escape' => false]) ?>
                                <!-- <a href="<?= $this->Url->build(['action' => 'edit', $coupon->id]); ?>" class="btn btn-info btn-raised mr-2"><i class="fa fa-edit"></i> Edit User</a> -->
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
                            <!-- <ul class="profile-menu no-list-style">
                                <li>
                                    <a href="#about" class="white font-medium-2 font-weight-600">About</a>
                                </li>

                            </ul> -->
                        </div>
                        <div class="col-lg-2 col-md-2 text-center">
                            <!-- <span class="font-medium-2 text-uppercase">
                                <?= $coupon->code ?>
                            </span> -->
                            <!-- <p class="grey font-small-2">Ninja Developer</p> -->
                        </div>
                        <div class="col-lg-5 col-md-5">
                            <!-- <ul class="profile-menu no-list-style">
                                <li>
                                    <a href="#subscriptions" class="white font-medium-2 font-weight-600">Subscriptions</a>
                                </li>

                            </ul> -->
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
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="text-bold-500 primary">Description:</span>
                                    <span class="display-block overflow-hidden">
                                        <?= $this->Text->autoParagraph(h($coupon->description)); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="text-bold-500 primary">
                                        <a>
                                            <i class="ft-calendar font-small-3"></i> Expiration:</a>
                                    </span>
                                    <span class="display-block overflow-hidden">
                                        <?= !empty($coupon->expiration) ? $this->Custom->niceShorterDate($coupon->expiration) : 'N/A' ?>
                                    </span>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="text-bold-500 primary">
                                        <a>
                                            Percentage Coupon:</a>
                                    </span>
                                    <span class="display-block overflow-hidden">
                                        <?= $coupon->percentage_voucher ? "YES" : 'NO' ?>
                                    </span>
                                </div>

                            </div>
                        </div>


                        <hr>
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4">
                                <ul class="no-list-style">
                                    <li class="mb-2">
                                        <span class="text-bold-500 primary">
                                            <a>
                                                <i class="icon-present font-small-3"></i> Voucher Code:</a>
                                        </span>
                                        <span class="display-block overflow-hidden">
                                            <?= $coupon->code ?>
                                        </span>
                                    </li>

                                </ul>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <ul class="no-list-style">
                                    <li class="mb-2">
                                        <span class="text-bold-500 primary">
                                            <a>
                                                <i class="ft-credit-card font-small-3"></i> Amount:</a>
                                        </span>
                                        <span class="display-block overflow-hidden">
                                            <?= $coupon->percentage_voucher ? number_format($coupon->percent) : $currency . number_format($coupon->amount) ?>
                                        </span>
                                    </li>

                                </ul>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <ul class="no-list-style">
                                    <li class="mb-2">
                                        <span class="text-bold-500 primary">
                                            <a>
                                                <i class="ft-power font-small-3"></i> Active:</a>
                                        </span>
                                        <span class="display-block overflow-hidden">
                                            <?= $coupon->active ? 'YES' : 'NO' ?>
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

<!--User Timeline section starts-->
<section id="subscriptions">
    <div class="row">
        <div class="col-12">
            <div class="content-header">Subscriptions</div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12">
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
                            <div class="col-12 col-md-12 ">
                                <div class="table-responsive">
                                    <?= $this->element('subscriptions_table', ['subscriptions' => $coupon->subscriptions, 'ajax' => true, 'show_edit' => false, 'show_remove' => false, 'idtouse' => 'vouchers_orders']) ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

</section>
<!--User Timeline section ends-->