<!-- Sidebar Info -->

<div class="card p-4 mb-5">
    <div class="border-bottom pb-2 mb-2">

        <h6 class="bold">About</h6>

        <!-- Additional Info -->
        <ul class="list-inline text-graylt font-size-1 mb-4">
            <li class="list-inline-item mb-1">
                <small class="fas fa-map-marker-alt mr-1 "></small>
                <?=$City;?>,  <?php echo $State;?>

            <?php
            function dateFormat($profile_data, $format = 'd-M-Y'){
                return date($format, strtotime($profile_data));
            }
            ?><li class="list-inline-item"><i class="far fa-calendar-alt mr-1"></i>
                Joined <?php echo dateFormat($Created_On, 'M, Y');?>
            </li>
        </ul>
        <!-- End Additional Info -->
        <div class="pb-1 mb-1">
            <h3 class="font-size-1 font-weight-semi-bold mb-1">My Hometown</h3>

            <!-- Languages -->
            <span class="d-block font-size-1 font-weight-medium mb-1"><?php echo $Home_town;?>
                <!-- End Languages -->
        </div>




        <h2 class="font-size-1 font-weight-semi-bold mb-1">About Me</h2>

        <p class="font-size-1 mb-3"><?php echo $About_me != ""? "<q>".$About_me."</q>": "";?></p>



        <?php
        // print_r($Member_ID);
        // print_r($this->session->userdata('Member_ID'));
        if(!$this->session->has_userdata('Member_ID') || $this->session->userdata('Member_ID') != $Member_ID ){
            ?>
            <?php
            if(isset($is_already_follow)){
                ?>
                <div>
                    <a class="btn btn-block btn-sm btn-soft-primary bold unfollow" href="javascript:stop_following(<?=$Member_ID?>)"><span class="fas fa-user-minus small mr-2"></span>Stop Following</a>
                </div>
                <?php
            }else if(isset($is_following_already)){
                ?>
                <div>
                    <a class="btn btn-block btn-sm btn-soft-primary bold following" href="javascript:follow_me(<?=$Member_ID?>)">Follow Back</a>
                </div>
                <?php
            }
            else{
                ?>
                <div>
                    <a class="btn btn-block btn-sm btn-soft-primary bold follow" href="javascript:follow_me(<?=$Member_ID?>)"><span class="fas fa-user-plus small mr-2"></span> Follow</a>
                </div>
                <?php
            }
            ?>

            <?php
        }
        ?>










    </div>




    <div class="text-center">
        <a href="https://www.facebook.com/<?php echo $facebook_links;?>" class="btn btn-icon btn-link" target="_blank">
            <span class="fab fa-facebook-f btn-icon__inner"></span>
        </a>
        <a href="https://twitter.com/<?php echo $twitter_links;?>" class="btn btn-icon btn-link" target="_blank">
            <span class="fab fa-twitter btn-icon__inner"></span>
        </a>
        <a href="https://www.instagram.com/<?php echo $google_links;?>" class="btn btn-icon btn-link" target="_blank">
            <span class="fab fa-instagram btn-icon__inner"></span>
        </a></div>




</div>


  <?php
        // print_r($Member_ID);
        // print_r($this->session->userdata('Member_ID'));
        if(!$this->session->has_userdata('Member_ID') || $this->session->userdata('Member_ID') != $Member_ID ){
            ?><!-- Report & Block  -->

<a class="text-secondary small mb-1" href="#reportprofileModal"
   data-modal-target="#reportprofileModal">
    <i class="far fa-flag mr-1"></i> Report this profile
</a><br>
<?=$block_user?>
<a class="text-secondary small block_user" href="javascript:;" style="display:<?=$block_user == 0? "block": "none"?>"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;&nbsp;  <span class="block-text">Block</span> <?php echo $FirstName?> <?php echo substr("$LastName",0,1)."";?>.</a>
<a class="text-primary small unblock_user" href="javascript:;"  style="display:<?=$block_user > 0? "block": "none"?>"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;&nbsp;  <span class="block-text">Unblock</span> <?php echo $FirstName?> <?php echo substr("$LastName",0,1)."";?>.</a>

<!-- End Report & Block  -->   <?php
        }
        ?><br><br>

<!-- End Sidebar Info -->
<div id="blockresultmodal" class="js-modal-window u-modal-window" style="width: 620px;">
    <div class="card mb-9">
        <!-- Header -->
        <header class="card-header bg-light py-3 px-5"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h6 bold mb-0"><?php echo $FirstName.' '.ucfirst(substr($LastName, 0, 1)).".";?> blocked successfully</h3>

                <button type="button" class="close" aria-label="Close" onclick="Custombox.modal.close();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </header>
        <!-- End Header -->

        <div class="card-body bg-white">

            <!-- Process Section -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-12 mb-md-0">
                        <!-- Process -->
                        <div class="text-center">
                            <div class="position-relative">
                                <div id="SVGcircleProcess10" class="svg-preloader min-height-155 mb-2">
                                    <!-- Icon -->
                                    <span class="text-primary btn btn-lg btn-icon mt-7">
            							<span class="fas fa-ban font-size-6 btn-icon__inner btn-icon__inner-bottom-minus"></span>
          							</span>
                                    <!-- End Icon -->

                                    <!-- SVG Shape -->
                                    <figure class="w-100 position-absolute top-0 right-0 left-0 z-index-n1">
                                        <img class="js-svg-injector" src="<?= $this->Url->build('/svg/', ['fullBase' => true]); ?>circle-process-3.svg" alt="Image Description"
                                             data-parent="#SVGcircleProcess10">
                                    </figure>
                                    <!-- End SVG Shape -->
                                </div>

                                <h2 class="h4 font-weight-semi-bold text-primary">&nbsp;</h2>
                                <p class="mb-10"><?php echo $FirstName.' '.ucfirst(substr($LastName, 0, 1)).".";?> has been successfully blocked.</p>
                            </div>
                            <!-- End Process -->
                        </div>




                    </div>
                    <!-- End Process Section -->


                </div>
            </div>
            <!-- End Report Success Modal Window -->
            
            
        </div>
    </div>
</div>


<div id="unblockresultmodal" class="js-modal-window u-modal-window" style="width: 620px;">
    <div class="card mb-9">
        <!-- Header -->
        <header class="card-header bg-light py-3 px-5"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h6 bold mb-0"><?php echo $FirstName.' '.ucfirst(substr($LastName, 0, 1)).".";?> unblocked successfully</h3>

                <button type="button" class="close" aria-label="Close" onclick="Custombox.modal.close();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </header>
        <!-- End Header -->

        <div class="card-body bg-white">

            <!-- Process Section -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-12 mb-md-0">
                        <!-- Process -->
                        <div class="text-center">
                            <div class="position-relative">
                                <div id="SVGcircleProcess11" class="svg-preloader min-height-155 mb-2">
                                    <!-- Icon -->
                                    <span class="text-primary btn btn-lg btn-icon mt-7">
            							<span class="fas fa-ban font-size-6 btn-icon__inner btn-icon__inner-bottom-minus"></span>
          							</span>
                                    <!-- End Icon -->

                                    <!-- SVG Shape -->
                                    <figure class="w-100 position-absolute top-0 right-0 left-0 z-index-n1">
                                        <img class="js-svg-injector" src="<?= $this->Url->build('/svg/', ['fullBase' => true]); ?>circle-process-3.svg" alt="Image Description"
                                             data-parent="#SVGcircleProcess11">
                                    </figure>
                                    <!-- End SVG Shape -->
                                </div>

                                <h2 class="h4 font-weight-semi-bold text-primary">&nbsp;</h2>
                                <p class="mb-10"><?php echo $FirstName.' '.ucfirst(substr($LastName, 0, 1)).".";?> has been successfully unblocked.</p>
                            </div>
                            <!-- End Process -->
                        </div>




                    </div>
                    <!-- End Process Section -->


                </div>
            </div>
            <!-- End Report Success Modal Window -->
            
            
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        var blockresultmodal = new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#blockresultmodal'
            }
            
        });
        var unblockresultmodal = new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#unblockresultmodal'
            }
            
        });
        if($('input[id=sessionid]').val() == "0" || $('input[id=sessionid]').val() == ""){
        }else{
            $.ajax({
                type: "POST",
                url: "<?=base_url()?>" + "profile/checkUserBlock",
                dataType: "json",
                data: {
                    uid: "<?=$_GET['uid']?>"
                },
                success: function(data){
                    // console.log(data);
                    if(!data.error){
                        if(data.result > 0){
                            $('.block_user').css('display', 'none');
                            $('.unblock_user').css('display', 'block');
                        }else{
                            $('.block_user').css('display', 'block');
                            $('.unblock_user').css('display', 'none');
                        }
                    }

                },
                error: function(error){
                    console.log(error);
                }
            })
        }

        $('.block_user').click(function (e) {
            e.preventDefault();
            var $this = $(this);
            if($('input[id=sessionid]').val() == "0" || $('input[id=sessionid]').val() == ""){
                $('.loginn').trigger('click');
            }else{
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>" + "profile/block_user",
                    data: {
                        uid: "<?=$_GET['uid']?>"
                    },
                    success: function(data){
                        console.log(data);
                        // $this.removeClass("block_user");
                        $('.block_user').css('display', 'none');
                        $('.unblock_user').css('display', 'block');
                        // $this.addClass("unblock_user");
                        blockresultmodal.open();
                    },
                    error: function(error){
                        console.log(error);
                    }
                })
            }

        });
        $('.unblock_user').click(function (e) {
            e.preventDefault();
            var $this = $(this);
            if($('input[id=sessionid]').val() == "0" || $('input[id=sessionid]').val() == ""){
                $('.loginn').trigger('click');
            }else{
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>" + "profile/unblock_user",
                    data: {
                        uid: "<?=$_GET['uid']?>"
                    },
                    success: function(data){
                        console.log(data);
                        $('.block_user').css('display', 'block');
                        $('.unblock_user').css('display', 'none');
                        unblockresultmodal.open();
                    },
                    error: function(error){
                        console.log(error);
                    }
                })
            }

        });
    })
</script>