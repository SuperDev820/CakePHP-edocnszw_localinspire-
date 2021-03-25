<style>
    .pic_3 {

        display: grid;
        grid-template-columns: 50% 50%;
        grid-template-rows: 50% 50%;
        height: 180px;
        grid-gap: 2px;
        padding-right: 2px;
        padding-bottom: 2px;
    }

    .pic_3 .first {
        grid-area: 1 / 1 / span 2 / span 1;
    }

    .pic_3 img {
        height: 100%;
    }

    .pic_2 {
        display: grid;
        grid-template-columns: 50% 50%;
        grid-template-rows: 100%;
        height: 180px;
        grid-gap: 2px;
        padding-right: 2px;
    }

    .shadow-sm {
        box-shadow: 0 0 2px #ccc !important;
    }

    .card-img-top {
        min-height: 180px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>

<main class="bg-white" id="content" role="main">
    <!-- Breadcrumb Section -->
    <div class="container mt-3">
        <?php if (isset($accountpage) and $accountpage == true) { ?>
            <h3 class="bold">My Collections</h3>
        <?php } else { ?>
            <h3 class="bold"><?php echo ucfirst($user->firstname) . " " . ucfirst(substr($user->lastname, 0, 1)) . "."; ?>'s Collections</h3>
        <?php } ?>
        <div style="display:flex;flex-wrap:wrap;">
            <span class="bold" style="width:200px;"><span id="collection_count"><?= $collections_total_count ?></span> collections created</span>
            <?php if (isset($accountpage) and $accountpage == true) { ?>
                <div style="flex:1; text-align:right;">
                    <a href="<?= $this->Url->build(['controller' => "account", 'action' => 'newCollection']); ?>" class="btn btn-sm btn-primary mr-1"><i class="fa fa-plus" aria-hidden="true"></i>
                        &nbsp;New Collection</a>
                </div>
            <?php } ?>
        </div>
    </div>
    <main class="bg-light mt-2" id="content" role="main">
        <div class="pt-5 container">
            <div class="row  mb-5">

                <?php if ($collections_total_count > 0) { ?>

                    <div class="col-md-12">
                        <div class="row">
                            <?php foreach ($collections as $collection) { ?>
                                <?php $count = count($collection->collection_items); ?>
                                <div class="col-md-4 mb-5 ">
                                    <div class="js-slide card  mb-3">
                                        <div class="position-relative">
                                            <?php if ($count == 1) { ?>
                                                <a class="" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'collectionView', $user->username, $collection->id]); ?>" style="display: block">
                                                    <div class="card-img-top" style="background-image:url(<?= $this->Custom->getBusinessPhotoUrl($collection->collection_items[0]->business) ?>"></div>
                                                </a>

                                            <?php } elseif ($count == 0) { ?>
                                                <a class="" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'collectionView', $user->username, $collection->id]); ?>" style="display: block">
                                                    <img class="card-img-top" src="<?= $this->Custom->emptyBusinessImage() ?>">
                                                </a>
                                            <?php } ?>


                                            <div style="background-color: rgba(0,0,0,0.5);border-top-right-radius:8px" class="position-absolute right-1 bottom-0 left-0 p-4">
                                                <span class="h5 text-white"><i class="fas fa-bookmark mr-1"></i> <?= $count ?> &nbsp;<?= $count > 1 ?
                                                                                                                                            "Places" : "Place" ?></span>
                                            </div>
                                        </div>
                                        <div class="card-body p-4">
                                            <a class="media align-items-center text-graylt" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $user->username]); ?>">
                                                <div class="u-sm-avatar mr-2">
                                                    <img class="img-fluid rounded-circle" src="<?= !empty($user) ?  $this->Custom->getDp($user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">
                                                </div>
                                                <div class="media-body small bold">
                                                    <span>
                                                        <?= ucfirst($user->firstname) . " " . ucfirst(substr($user->lastname, 0, 1)) . "."; ?>
                                                    </span>
                                                </div>
                                                <div class="media-body text-right">
                                                    <small class="d-block text-graylt small">Created <?= $this->Custom->niceDateMonthDayYear($collection->created) ?></small>
                                                </div>
                                            </a>
                                            <h4 class="h6 mt-3 bold">
                                                <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'collectionView', $user->username, $collection->id]); ?>"><?= $collection->name ?>&nbsp;</a>
                                            </h4>
                                            <?php if (!empty($currentUser) and $currentUser->id == $collection->user_id) { ?>
                                                <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'account', 'action' => 'editCollection', $collection->id]); ?>">Edit Collection&nbsp;</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>

                        </div>

                        <?php if (!$empty_result) { ?>
                            <div class="row  mb-5">
                                <div class="col-md-12">
                                    <?= $this->element('pagination_block', ['model' => 'Collections', 'showPageBool' => true]) ?>
                                </div>

                            </div>
                        <?php } ?>
                    </div>

                <?php } else { ?>
                    <div style="height:450px" class="w-100 pt-3 mb-4 text-center pb-4 ">
                        <i class="fas fa-list-alt fa-3x"></i>

                        <?php if (isset($accountpage) and $accountpage == true) { ?>
                            <h5>
                                <h4 class="bold"> You haven't created any collections yet!</h4>
                            </h5>
                        <?php } else { ?>
                            <h5>
                                <h4 class="bold"> <?= ucfirst($user->firstname) . " " . ucfirst(substr($user->lastname, 0, 1)) . "."; ?> has no public collections to show yet!</h4>
                            </h5>
                        <?php } ?>


                    </div>

                <?php } ?>
            </div>
        </div>
    </main>
</main>