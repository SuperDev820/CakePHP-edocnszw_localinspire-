<?php $random_id_target =  mt_rand(100000, 999999); ?>
<!-- Special Offer -->

    <div>
        <!-- Ad -->
        <div class="media mb-4">
            <div class="u-avatar mr-4">
                <?php if ($offer->anniversary) { ?>
                    <i class="fas fa-heart fa-3x"></i>
                <?php } elseif ($offer->birthday) { ?>
                    <i class="fas fa-birthday-cake fa-3x"></i>
                <?php } else { ?>
                    <figure class="ie-height-56 max-width-8 mx-auto">
                        <img class="js-svg-injector" src="<?= $this->Url->build('/svg/icon-28.svg', ['fullBase' => true]) ?>" alt="SVG" data-parent="#icon28">
                    </figure>
                <?php } ?>
            </div>

            <div class="media-body">
                <h4 class="d-inline-block mb-1">
                    <?php if ($offer->link_offer and !empty($offer->link)) { ?>
                        <a class="d-block h6 mb-0  bold" target="_blank" href="<?= $offer->link ?>"> <?= $offer->title ?></a>
                    <?php } else { ?>
                        <span class="d-block h6 mb-0  bold"><?= $offer->title ?></span>
                    <?php } ?>
                </h4>
                <span class="d-block txt-12lt text-muted">Special from  <!---<?= !empty($business->business_role) ? $business->business_role->name : "owner" ?> ---> <a class="bold" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>"><?= $business->name ?></a> <!---for <?= $this->Custom->getOfferTypeDisplay($offer) ?>---> </span>
            </div>
            <?php if ($offer->link_offer and !empty($offer->link)) { ?>
                <div class="media-body text-right"> <a target="_blank" href="<?= $offer->link ?>" class="btn btn-sm btn-cta bold" type="button"><i class="fa fa-link" aria-hidden="true"></i> &nbsp;Get Offer</a>
                </div>
            <?php } ?>
            <?php if ($offer->code_offer and !empty($offer->code)) { ?>
                <div class="media-body text-right"> <span data-toggle="modal" data-target="#get<?= $random_id_target ?>code"><button href="#" class="btn btn-sm btn-cta bold" type="button"><i class="fa fa-tag" aria-hidden="true"></i> &nbsp;Get Code</button></span>
                </div>
            <?php } ?>
        </div>
        <!-- End Ad -->
        <p><?= $offer->description ?> <span class="txt-12lt"><?= !empty($offer->start_date) ? "─ Starts: " . $this->Custom->readableTimestamp2($offer->start_date) : "" ?> <?= !empty($offer->stop_date) ? "- Ends: " . $this->Custom->readableTimestamp2($offer->stop_date) : "" ?></span> <span rel="tooltip" data-html="true" data-container="body" title="<?= $offer->conditions ?>" data-placement="right"> <i class="fa fa-info-circle txt-12" aria-hidden="true"></i></span> </p>


    
</div>
<?php if ($offer->code_offer and !empty($offer->code)) { ?>
    <!-- End Special Offer -->
    <!-- Begin Print code modal -->
    <div class="modal" id="get<?= $random_id_target ?>code" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h3 class="h6 bold mb-0">Claim Special Offer</h3>
                    <button type="button" class="close text-darker" data-dismiss="modal" aria-hidden="true"> <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="bold"><?= $offer->title ?></h5>
                            <p class="font-size-1">
                                <?= $offer->description ?></p>
                            <h5>Code: <?= $offer->code ?></h5>
                            <!-- End Print ONLY Offer Content -->
                            <div id="div_<?= $random_id_target ?>print" style="display:none"><br>
                                <center>
                                    <h3 class="bold "><?= $business->name ?>, <?= $business->city->name . ", " . strtoupper($business->city->state->code) ?></h3>
                                </center>

                                <center>
                                    <h3 class="bold"><?= $offer->title ?></h3>
                                </center>
                                <h5><?= $offer->description ?></h5>
                                <h3>Code: <?= $offer->code ?></h3>
                            </div><!-- End Print ONLY Offer Content -->
                            <hr>
                            <input name="b_<?= $random_id_target ?>print" onClick="printdiv('div_<?= $random_id_target ?>print');" class="btn btn-primary bold" value="Print Code">
                            <span></span>
                            <input class="btn btn-link" type="reset" value="Email me code">
                        </div>
                    </div>
                </div>
            </div>
        </div></b>
    </div>
    <!-- End Print code modal -->
<?php } ?>
<!-- Begin Print ONLY Offer Script -->

<!-- End Print ONLY Offer Script -->