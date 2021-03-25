<main id="content" role="main">
    <!-- Hero Section -->
    <div class="dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll" data-options='{direction: "normal"}'>
        <!-- Apply your Parallax background image here -->
        <div class="divimage dzsparallaxer--target" style="height: 130%; background-image: url(<?= $this->Custom->getDp($post->image, "posts") ?>);"></div>

        <!-- Content -->
        <div class="js-scroll-effect position-relative" data-scroll-effect="smoothFadeToBottom">
            <div class="container space-top-2 space-bottom-1 space-top-md-5">
                <div class="text-center w-lg-80 mx-auto space-bottom-2 space-bottom-md-3">
                    <h1 class="display-4 font-size-md-down-5 text-white font-weight-normal mb-0"><?= $post->title ?></h1>
                </div>

                <!-- Author -->
                <div class="text-center">
                    <div class=" mx-auto mb-2">
                         <img style="height:125px;width:125px" class="img-fluid  rounded-circle profile_image" src="<?= !empty($post->user) ?  $this->Custom->getDp($post->user->image, 'users', '150x150') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">
                    </div>
                    <span class="d-block">
                        <a class="text-white h6 mb-0" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $post->user->username]); ?>"><?= !empty($post->user) ? $post->user->name_desc : '' ?></a>
                    </span>
                </div>
                <!-- End Author -->
            </div>
        </div>
        <!-- End Content -->
    </div>
    <!-- End Hero Section -->

    <!-- Description Section -->
    <div class="container mt-3">
        <div class="w-lg-60 mx-auto">
            <div class="mb-4">
                <span class="text-muted"><?= $this->Custom->niceDateMonthDayYear($post->created) ?></span>
            </div>

            <?= $post->content ?>

        </div>
    </div>

    <!-- Description Section -->
    <div class="container space-bottom-2 space-bottom-md-3">
        <div class="w-lg-60 mx-auto">
            <!-- Tags -->
            <ul class="list-inline text-center mb-0">

                <?php foreach ($post->tags as $tag) { ?>
                    <li class="list-inline-item pb-3">
                        <a class="btn btn-xs btn-gray btn-pill" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'stories', 'action' => 'index', $tag->slug]); ?>"><?= $tag->name ?></a>
                    </li>
                <?php } ?>
            </ul>
            <!-- End Tags -->

            <hr class="my-7">

            <!-- Social Networks -->
            <ul class="list-inline text-center mb-0 a2a_kit">
                <li class="list-inline-item">
                    <a class="btn btn-icon btn-soft-secondary btn-bg-transparent a2a_button_twitter" href="#">
                        <span class="fab fa-twitter btn-icon__inner"></span>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn btn-icon btn-soft-secondary btn-bg-transparent a2a_button_facebook" href="#">
                        <span class="fab fa-facebook btn-icon__inner"></span>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn btn-icon btn-soft-secondary btn-bg-transparent a2a_button_whatsapp" href="#">
                        <span class="fab fa-whatsapp btn-icon__inner"></span>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn btn-icon btn-soft-secondary btn-bg-transparent a2a_button_google_gmail" href="#">
                        <span class="fab fa-google btn-icon__inner"></span>
                    </a>
                </li>
            </ul>
            <!-- End Social Networks -->
            <script async src="https://static.addtoany.com/menu/page.js"></script>
            <hr class="my-7">

            <!-- Author -->
            <div class="media">
                <div class="u-avatar mr-3">
                    <img class="img-fluid rounded-circle" src="<?= !empty($post->user) ?  $this->Custom->getDp($post->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">
                </div>
                <div class="media-body">
                    <div class="row mb-3 mb-sm-0">
                        <div class="col-sm-6 mb-2">
                            <h4 class="d-inline-block mb-0">
                                <a class="d-block h6 mb-0" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $post->user->username]); ?>"><?= !empty($post->user) ? $post->user->name_desc : '' ?></a>
                            </h4>
                            <!-- <small class="d-block text-muted">Best Author of the year Award Winner.</small> -->
                        </div>
                        <div class="col-sm-6">
                            <?php $random_id_target = "follow_block" . mt_rand(100000, 999999); ?>
                            <div id="<?= $random_id_target ?>">
                                <?= $this->element('follow_block', ['ckUser' => $currentUser, 'targetUser' => $post->user,  'random_id_target' => $random_id_target]) ?>
                            </div>
                            <!-- <button type="button" class="btn btn-xs btn-soft-primary font-weight-semi-bold transition-3d-hover">Follow</button> -->
                        </div>
                    </div>
                    <!-- <p class="small">Andrea Gard is the author of two story collections and two novels, most recently Eat Only When You're Hungry. She lives in Chicago.</p> -->
                </div>
            </div>
            <!-- End Author -->
        </div>
    </div>
    <!-- End Description Section -->

    <!-- Related News -->
    <div class="bg-light">
        <div class="container space-2 space-md-3">
            <h1>Latest Posts</h1>
            <div class="card-deck d-block d-md-flex card-md-gutters-3">
                <?php foreach ($latest_posts as $post) { ?>
                    <div class="card border-0 mb-5 mb-md-0">
                        <img class="card-img-top" src="<?= $this->Custom->getDp($post->image, "posts") ?>" alt="Image Description">
                        <div class="card-body p-5">
                            <small class="d-block text-secondary mb-1"><?= $this->Custom->niceDateMonthDayYear($post->created) ?></small>
                            <h3 class="h6 mb-0">
                                <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'stories', 'action' => 'view', $post->id, \Cake\Utility\Text::slug(strtolower($post->title))]); ?>"><?= $post->title ?></a>
                            </h3>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
    <!-- End Related News -->

</main>