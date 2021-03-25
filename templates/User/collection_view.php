<?php $this->assign('title', $collection->name . " by " . ucfirst($user->name_desc)); ?>

<?php $this->assign('image', $this->Custom->getBusinessPhotoUrl($collection->collection_items[0]->business, true)); ?>

<!-- Explore CSS -->
<link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/css/explore.css">
<!-- ========== MAIN CONTENT =========== -->
<style>
    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    /* The dots/bullets/indicators */
    .dot {
        padding: 4px;
        cursor: pointer;
        height: 3px;
        width: 3px;
        margin: 0 5px;
        background-color: #c9cccf;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    .active,
    .dot:hover {
        background-color: white;
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        margin-top: -22px;
        /*font-weight: bold;*/
        font-size: 22px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
        color: white !important;
        display: none;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .review-image-gallery-item:hover>a.prev,
    .review-image-gallery-item:hover>a.next {
        display: block;
    }

    /*.review_image_gallery:hover > .dot_container{*/
    /*display: block;*/
    /*}*/
    .dot_container {
        position: absolute;
        bottom: 12px;
        left: 50%;
        transform: translate(-50%, 0);
        /*display: none;*/
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 5px;
    }

    /*.review-image-gallery-item {display: none}*/

    a.next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }


    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.7);
        color: white !important;
    }

    .gal-item {
        overflow: hidden;
        padding: 1px;
    }

    .gal-item .box {
        height: 100%;
        overflow: hidden;
    }

    .box img {
        height: 100%;

        object-fit: cover;
    }

    .img-h {
        height: 230px !important;
    }

    .img-h-half {
        height: 115px !important;
    }

    .review-image-gallery-item {
        height: 250px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>
<main id="content" role="main">
    <div class="ml-0 pl-0 ">
        <div class="row no-gutters">
            <!-- 1st column -->
            <div style="max-width:700px" class="col-lg-5 col-md-5 col-12 js-scrollbar mt-0 height-86vh">

                <div class="m-0 p-0">
                    <div class="row no-gutters mb-0 mt-0 review_image_gallery" id="listview" style="position: relative;">
                        <?php
                        $list_count = count($collection->collection_items);
                        for ($p = 0; $p < count($collection->collection_items); $p++) {
                            $item = $collection->collection_items[$p];
                            $show_none = $p == 0 ? "block" : "none";
                        ?>
                            <div class="col-sm-12 mb-0 space1">
                                <div class="review-image-gallery-item slideitem<?= $p ?>" style="background-image:url(<?= $this->Custom->getBusinessPhotoUrl($item->business) ?>); display: <?= $show_none ?>;position: relative;width:100%">

                                    <?php if ($p > 0) { ?>
                                        <a class="prev" href="javascript:currentSlide(<?= $p - 1 ?>)">&#10094;</a>
                                    <?php } ?>
                                    <?php if ($p < $list_count - 1) { ?>
                                        <a class="next" href="javascript:currentSlide(<?= $p + 1 ?>)">&#10095;</a>
                                    <?php } ?>
                                    <div class="numbertext"><?= $p + 1 ?> / <?= $list_count ?></div>

                                </div>
                            </div>
                        <?php } ?>

                        <div class="dot_container" style="position: absolute; bottom: 22px; left:50%; -webkit-transform: translate(-50%, 0);-moz-transform: translate(-50%, 0);-ms-transform: translate(-50%, 0);-o-transform: translate(-50%, 0);transform: translate(-50%, 0);" id="sliderdot">
                            <?php for ($p = 0; $p < $list_count; $p++) { ?>
                                <?php $active_dot = $p == 0 ? " active" : ""; ?>
                                <span class="dot <?= $active_dot ?> dotitem<?= $p ?>" onclick="currentSlide(<?= $p ?>)"></span>
                            <?php } ?>

                        </div>
                    </div>
                </div>

                <div class="p-4 pb-0 pt-0">

                    <ul class="list-inline d-flex align-items-center">
                        <li class="list-inline-item d-flex align-items-center pr-2">
                            <div class="u-sm-avatar mr-2">
                                <img class="img-fluid rounded-circle" src="<?= !empty($user) ?  $this->Custom->getDp($user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description" style="height: 100%;">
                            </div>
                            <a class="text-secondary font-size-1" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $user->username]); ?>"> Created by <?php echo ucfirst($user->firstname) . ' ' . ucfirst(substr($user->lastname, 0, 1)) . "."; ?>
                            </a>
                        </li>
                        <li class="list-inline-item ml-auto mr-2">
                            <span class="d-flex align-items-center small text-graylt">
                                Created <?= $this->Custom->niceDateMonthDayYear($collection->created) ?>
                            </span>
                        </li>
                    </ul>


                    <!--End Business Listing -->
                    <h5 class="bold"><?= $collection->name ?></h5>
                    <span class="small"><?= $collection->description ?> </span>
                    <!-- Buttons -->
                    <div class=" mt-3 text-right mb-0">


                        <div class="btn-toolbar text-right " role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                <a data-js="facebook-share" href="http://www.facebook.com/sharer/sharer.php?u=<?= $this->Url->build($this->request->getRequestTarget(), ['fullBase' => true]); ?>" target="_blank" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
                                    <button type="button" class="btn btn-soft-facebookreg mb-1 mr-2"><i class="fab fa-facebook-f text-white txt-12 mr-2"></i> <span class="text-white bold txt-12">Share on Facebook</span></button>
                                </a>
                            </div>
                            <div class="btn-group mr-2" role="group" aria-label="Second group">
                                <?php if (!empty($currentUser) and $currentUser->id != $collection->user_id) { ?>
                                    <?php $random_id_target = "follow_block" . mt_rand(100000, 999999); ?>
                                    <div id="<?= $random_id_target ?>">
                                        <?= $this->element('follow_block', ['ckUser' => $currentUser, 'targetUser' => $user, 'ckfollowsUser' => $followsUser, 'ckfollowedByUser' => $followedByUser, 'random_id_target' => $random_id_target]) ?>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>

                    </div>
                    <!-- End Buttons -->
                </div>

                <div class="sidebar-none-columns pr-2 pl-3">
                    <?php $map_data = []; ?>
                    <?php if (count($collection->collection_items) > 0) { ?>
                        <div class="d-flex justify-content-between align-items-center pt-0">

                            <span class="mb-0 bold font-size-12"><?= count($collection->collection_items) ?> <?= count($collection->collection_items) > 1 ? "Places" : 'Place' ?></span>

                        </div>
                        <div class="mt-0 mr-3">
                            <hr> <!-- Reviews -->
                            <?php foreach ($collection->collection_items as $index => $list) { ?>
                                <div>
                                    <!-- Author -->
                                    <div class="media mt-3 mb-5">
                                        <img class="u-avatar square-img85 mr-3" src="<?= $this->Custom->getBusinessPhotoUrl($list->business) ?>" alt="Image Description">

                                        <div style="width:600px" class="">
                                            <h4 class="d-inline-block mb-0">
                                                <a class="d-block h6 mb-0 bold" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($list->business->name)), strtolower($list->business->city->name), $list->business->city->state->code, $list->business->id]); ?>">
                                                    <?= $list->business->name ?>
                                                </a>
                                            </h4>
                                            <ul class="list-inline text-white star_size12 mb-1">
                                                <?= $this->element('stars_count', ['rating' => $list->business->average_rating]) ?>
                                                <span class="text-secondary star_size13 ml-1"> <?= $list->business->review_count ?> <?= $list->business->review_count > 1 ? 'reviews' : 'review' ?> </span>
                                            </ul>
                                            <small class="d-block mt-1 mb-1">
                                                <?= $this->Custom->displayCategoriesAndSubcategories($list->business) ?>
                                            </small>
                                            <small class="d-block text-secondary star_size13">
                                                <?= $list->business->city->name ?>, <?= strtoupper($list->business->city->state->code) ?>
                                            </small>
                                        </div>

                                        <div class="media-body text-right">
                                            <a class="<?= $this->Custom->userHasSavedBusiness($list->business, $loggedInUserCollections) ? "text-danger" : "text-primary" ?> font-size-2 biz_save" data-business_id="<?= $list->business->id ?>" data-toggle="tooltip" data-placement="top" title="<?= $this->Custom->userHasSavedBusiness($list->business, $loggedInUserCollections) ? "Saved" : "Save" ?>" href="javascript:;">
                                                <i class="fas fa-bookmark mt-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- End Author -->
                                    <?php if (!empty($list->note)) { ?>
                                        <b>Note:</b> <?= $list->note ?>
                                    <?php } ?>

                                </div>
                                <!-- End Reviews -->
                                <hr>
                            <?php } ?>

                        </div>
                        <!-- End Reviews -->

                    <?php } else { ?>
                        <div class="pt-5 mb-4 border-top text-center pb-4 "><i class="fas fa-bookmark fa-3x"></i>
                            <h4 class="bold pt-2"><?php echo ucfirst($user->firstname) . ' ' . ucfirst(substr($user->lastname, 0, 1)) . "."; ?> hasn't saved any businesses yet!</h4>
                        </div>
                    <?php } ?>
                </div>
            </div>


            <!-- 2nd column -->
            <div class="col">

                <div id="map" class="map-columns pad2"></div>

                <script src="https://maps.google.com/maps/api/js?sensor=false&key=AIzaSyDRa91l5ZUbyWuMHzKFLAwSS7_OS5gntpo" type="text/javascript"></script>
                <script type="text/javascript">
                    var map_data = '<?php echo str_replace('\'', '\\\'', json_encode($collection)); ?>';

                    window.map = new google.maps.Map(document.getElementById('map'), {
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });

                    var infowindow = new google.maps.InfoWindow();

                    var bounds = new google.maps.LatLngBounds();
                    var default_logo = '<?php echo $this->Url->build('/', ['fullBase' => true]); ?>assets/img/new_map_icon3.png';
                    var icon_lable = 0;
                    for (i = 0; i < map_data.length; i++) {
                        // var map_data[i] = map_data[i];
                        icon_lable = map_data[i]['icon_key'];
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(map_data[i]['lat'], map_data[i]['lng']),
                            map: map,
                            icon: default_logo,
                            label: {
                                text: '' + icon_lable + '',
                                color: 'white',
                                fontSize: "11px",
                                fontWeight: "bold"
                            }
                        });

                        bounds.extend(marker.position);

                        google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
                            return function() {
                                infowindow.setContent(
                                    '<div><img class="u-avatar square-img55 mr-3" src="' + map_data[i]['photo'] + '" alt="Image Description" style="float:left;"><div style="width:300px;"><a class="bold" href="<?= $this->Url->build('/', ['fullBase' => true]) ?>v/' +
                                    map_data[i]['link'] + '"> ' + map_data[i]['name'] +
                                    '</a><br/>' + map_data[i]['SIC4'] + map_data[i]['SIC8'] +
                                    '<br>' + map_data[i]['full_address'] + '</div></div>');
                                infowindow.open(map, marker);
                            }
                        })(marker, i));
                    }

                    map.fitBounds(bounds);
                    // console.log(window.map.getZoom());
                    var listener = google.maps.event.addListener(map, "idle", function() {
                        console.log(map.getZoom(10));
                        if (map.getZoom() > 18) map.setZoom(18);
                        google.maps.event.removeListener(listener);
                    });
                    //     marker.addListener('mouseover', function() {
                    //     infowindow.open(map, this);
                    // });
                </script>
            </div>
        </div>

    </div>
    <!-- Add Members Modal Window -->
    <?= $this->element('bookmark_modal') ?>
    <!-- End Add Members Modal Window -->

    <!-- Create List Modal Window -->
    <?= $this->element('create_collection_modal') ?>
    <!-- End Create List Modal Window -->

</main>
<!-- ========== END MAIN CONTENT ========== -->

<!-- ========== SECONDARY CONTENTS ========== -->

<script>
    $(document).ready(function() {

    })
</script>