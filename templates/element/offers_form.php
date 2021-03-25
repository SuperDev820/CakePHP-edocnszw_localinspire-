<?= $this->Form->create($offer, ['class' => '', 'enctype' => 'multipart/form-data', 'id' => 'offer_form']) ?>
<div class="bold mb-2">Set your dates</div>
<div class="mb-2 txt-12lt text-graylt">Leave this blank to keep an offer going until you stop it.</div>
<div class="row mb-4">
    <div class="col-md-6 mb-1">

        <!-- Datepicker -->
        <div id="datepickerWrapperFrom" class="u-datepicker input-group u-form">
            <div class="input-group-prepend u-form__prepend">
                <span class="input-group-text u-form__text">
                    <span class="fas fa-calendar-alt u-form__text-inner"></span>
                </span>
            </div>
            <?= $this->Form->control('start_date', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'datepicker form-control bg-transparent rounded-right offer_control', 'placeholder' => 'Start Date', 'type' => "text", "id" => "start_date", "aria-label" => "Start Date", "data-rp-wrapper" => "#datepickerWrapperFrom", "data-rp-date-format" => "d/m/Y", "value" => $this->Custom->dateFromTimestamp($offer->start_date, "d/m/Y")]) ?>
        </div>
        <!-- End Datepicker -->
    </div>
    <div class="col-md-6 mb-1">
        <!-- Datepicker -->
        <div id="datepickerWrapperstop" class="u-datepicker input-group u-form">
            <div class="input-group-prepend u-form__prepend">
                <span class="input-group-text u-form__text">
                    <span class="fas fa-calendar-alt u-form__text-inner"></span>
                </span>
            </div>
            <?= $this->Form->control('stop_date', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'datepicker form-control bg-transparent rounded-right offer_control', 'placeholder' => 'Stop Date', 'type' => "text", "id" => "stop_date", "aria-label" => "Stop Date", "data-rp-wrapper" => "#datepickerWrapperstop", "data-rp-date-format" => "d/m/Y", "value" => $this->Custom->dateFromTimestamp($offer->stop_date, "d/m/Y")]) ?>
        </div>
        <!-- End Datepicker -->
    </div>
</div>



<div class="form-group mb-4">
    <label class="bold mb-0" for="sot">Special offer title</label>
    <div class="mb-2 txt-12lt text-graylt">This field is required.</div>
    <!-- <input type="email" class="form-control" id="sot" placeholder="Your special offer title"> -->
    <?= $this->Form->control('title', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control offer_control', 'placeholder' => 'Your special offer title', 'required', 'id' => 'title']) ?>
</div>


<div class="bold mb-2">Who is this offer for?</div>
<div class="row mb-4">
    <div class="col-md-4 mb-1">

        <div class="custom-control custom-checkbox">
            <!-- <input type="checkbox" class="custom-control-input" id="mo"> -->
            <?= $this->Form->control('all_members', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'type' => 'checkbox', "id" => "mo", 'class' => 'custom-control-input offer_control', 'hiddenField' => true, $offer->all_members == false ? '' : 'checked' => "checked"]) ?>
            <label class="custom-control-label txt-12 pt-1" for="mo">
                All members
            </label>
        </div>
    </div>

    <div class="col-md-4 mb-1">
        <div class="custom-control custom-checkbox">
            <!-- <input type="checkbox" class="custom-control-input" id="mwsb"> -->
            <?= $this->Form->control('collection_members', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'type' => 'checkbox', "id" => "mwsb", 'class' => 'custom-control-input offer_control', 'hiddenField' => true, $offer->collection_members == false ? '' : 'checked' => "checked"]) ?>
            <label class="custom-control-label txt-12 pt-1" for="mwsb">
                Members who saved business
            </label>
        </div>

    </div>
</div>

<div class="bold mb-2">Pick the type of special you're running.</div>

<div class="row mb-4">
    <div class="col-md-3 mb-1">

        <div class="custom-control custom-checkbox">
            <!-- <input type="checkbox" class="custom-control-input" id="RegularOffer"> -->
            <?= $this->Form->control('regular', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'type' => 'checkbox', "id" => "RegularOffer", 'class' => 'custom-control-input offer_control', 'hiddenField' => true, $offer->regular == false ? '' : 'checked' => "checked"]) ?>
            <label class="custom-control-label txt-12 pt-1" for="RegularOffer">
                Regular offer
            </label>
        </div>
    </div>

    <div class="col-md-3 mb-1">
        <div class="custom-control custom-checkbox">
            <!-- <input type="checkbox" class="custom-control-input" id="BirthdayOffer"> -->
            <?= $this->Form->control('birthday', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'type' => 'checkbox', "id" => "BirthdayOffer", 'class' => 'custom-control-input offer_control', 'hiddenField' => true, $offer->birthday == false ? '' : 'checked' => "checked"]) ?>
            <label class="custom-control-label txt-12 pt-1" for="BirthdayOffer">
                Birthday offer
            </label>
        </div>

    </div>
    <div class="col-md-3 mb-1">
        <div class="custom-control custom-checkbox">
            <!-- <input type="checkbox" class="custom-control-input" id="Anniversaryoffer"> -->
            <?= $this->Form->control('anniversary', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'type' => 'checkbox', "id" => "Anniversaryoffer", 'class' => 'custom-control-input offer_control', 'hiddenField' => true, $offer->anniversary == false ? '' : 'checked' => "checked"]) ?>
            <label class="custom-control-label txt-12 pt-1" for="Anniversaryoffer">
                Anniversary offer
            </label>
        </div>
    </div>

</div>
<div class="bold mb-2">How will they recieve your special offer?</div>

<div class="row mb-4">

    <div class="col-md-4 mb-1">

        <div class="custom-control custom-checkbox">
            <!-- <input type="checkbox" class="custom-control-input" id="Speciallinkoffer"> -->
            <?= $this->Form->control('link_offer', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'type' => 'checkbox', "id" => "Speciallinkoffer", 'class' => 'custom-control-input offer_control', 'hiddenField' => false, $offer->link_offer == false ? '' : 'checked' => "checked"]) ?>
            <label class="custom-control-label txt-12 pt-1" for="Speciallinkoffer">
                <span rel="tooltip" data-html="true" data-container="body" title="Check if you have a page you want the special offer to go to." data-placement="right" class="txt-12lt cursor">Special link offer <i class="fa fa-info-circle" aria-hidden="true"></i></span>
            </label>
        </div>
    </div>

    <div class="col-md-6 mb-1">
        <div class="custom-control custom-checkbox">
            <!-- <input type="checkbox" class="custom-control-input" id="Specialcodeoffer"> -->
            <?= $this->Form->control('code_offer', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'type' => 'checkbox', "id" => "Specialcodeoffer", 'class' => 'custom-control-input offer_control', 'hiddenField' => false, $offer->code_offer == false ? '' : 'checked' => "checked"]) ?>
            <label class="custom-control-label txt-12 pt-1" for="Specialcodeoffer">
                <span rel="tooltip" data-html="true" data-container="body" title="Check if you have a special code you want to use." data-placement="right" class="txt-12lt cursor">Special code offer <i class="fa fa-info-circle" aria-hidden="true"></i></span>
            </label>
        </div>

    </div>
</div>


<div class="form-group link_offer_block">
    <label class="bold mb-0" for="sol"><span rel="tooltip" data-html="true" data-container="body" title="Add the url where your visitors can get their special offer." data-placement="right" class="cursor">If special offer url <i class="fa fa-info-circle txt-12lt " aria-hidden="true"></i></span> </label>
    <div class="mb-2 txt-12lt text-graylt">Add url to receive special if you have one.</div>
    <!-- <input type="email" class="form-control" id="sol" placeholder="http://www.mysite.com/linktoyouroffer"> -->
    <?= $this->Form->control('link', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control offer_control', 'placeholder' => 'http://www.mysite.com/linktoyouroffer', 'required', "type" => 'url', 'id' => 'link']) ?>
</div>

<div class="form-group code_offer_block">
    <label class="bold mb-0" for="soc"><span rel="tooltip" data-html="true" data-container="body" title="Add your special code here ONLY if you selected it above." data-placement="right" class="cursor">If special offer code <i class="fa fa-info-circle txt-12lt " aria-hidden="true"></i></span> </label>
    <div class="mb-2 txt-12lt text-graylt">This field is required for you to add your special offer code.</div>
    <!-- <input type="email" class="form-control" id="soc" placeholder="XcD124"> -->
    <?= $this->Form->control('code', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control offer_control', 'placeholder' => 'XcD124', 'required', 'id' => 'code']) ?>
</div>


<div class="form-group">
    <label class="bold mb-0" for="conditions">Conditions</label>
    <div class="mb-2 txt-12lt text-graylt">This field is required for your conditions.</div>
    <!-- <input type="email" class="form-control" id="conditions" placeholder="Redeem in store only!"> -->
    <?= $this->Form->control('conditions', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control offer_control', 'placeholder' => 'Redeem in store only!', 'required',  'id' => 'conditions']) ?>
</div>


<div class="form-group">
    <label class="bold mb-0" for="sod">Special offer description</label>
    <div class="mb-2 txt-12lt text-graylt">Give them a description of what your special is.</div>
    <?= $this->Form->control('description', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control offer_control', 'placeholder' => 'Free order of french fries with a purchase of any burger. One per customer. Offer valid for first visit only, no repeat visits will be allowed.', 'required', 'id' => 'sod']) ?>


</div>
<div class="mt-5 mb-3 bold">How your special offer will look</div>


<!-- Special Offer -->
<div class="card pt-4 pl-4 pr-4 mb-4">
    <!-- Ad -->
    <div class="media mb-4">
        <div id="offer_icon_block">
            <div class="u-avatar mr-4">
                <i class="fas fa-gift fa-3x"></i>
            </div>
        </div>
        <div class="media-body">
            <h4 class="d-inline-block mb-1">
                <a class="d-block h6 mb-0  bold" href="#"><span id="title_preview">Free offer, get it while it lasts!</span></a>
            </h4>
            <span class="d-block txt-12lt text-muted">Special from <?= $active_business->business_role->name ?> of <a class="bold" href="#"><?= $active_business->name ?></a> for <span id="offer_type">birthday</span>.</span>
        </div>
        <div class="text-right"> <button href="#" class="btn btn-sm btn-cta bold" type="button"><i class="fa fa-tag" aria-hidden="true"></i> &nbsp;Get Offer</button>

        </div>
    </div>
    <!-- End Ad -->
    <p><span id="description_preview">Free order of french fries with a purchase of any burger. One per customer. Offer valid for first visit only, no repeat visits will be allowed. </span> <span id="start_date_preview">10/13/2019</span><span id="stop_date_preview">10/13/2019</span> <span rel="tooltip" id="condition_preview" data-html="true" data-container="body" title="Redeem in store only!" data-placement="right" class="txt-12lt cursor"> <i class="fa fa-info-circle ml-2" aria-hidden="true"></i></span> </p>
</div>
<!-- End Special Offer -->

 <div style="width:99%" class="row bg-light p-2 borderlt ml-2 mb-4">
           <div class="col-md-3 mb-1 txt-14 bold">Special Offer Icon: </div><div class="col-md-9 mb-1">  <i class="fas fa-gift fa-lg"></i></div>
           <div class="col-md-3 mb-1 txt-14 bold"> Anniversary Icon:</div><div class="col-md-9 mb-1">  <i class="fas fa-heart fa-lg"></i></div>
          <div class="col-md-3 mb-1 txt-14 bold"> Birthday Icon: </div><div class="col-md-9 mb-1"> <i class="fas fa-birthday-cake fa-lg"></i></div>
          </div> 
<div class="mt-6">

    <label class="control-label"></label>
    <!-- <input class="btn btn-sm btn-primary bold" type="button" value="Create Special"> -->
    <?= $this->Form->button(__('Create Special Offer'), ['type' => 'submit', 'value' => "Save Special Offer", 'class' => 'btn btn-sm btn-primary bold', 'style' => '']); ?>
    <span></span>
    <input class="btn btn-link" type="button" onclick="goBack()" value="Cancel">

</div>
<?= $this->Form->end() ?>


<script>
    function goBack() {
        window.history.back();
    }

    function getOfferIcon() {
        var data = $('#offer_form').serialize();
        // var myform = document.getElementById("offer_form");
        // var data = new FormData(myform);
        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "POST",
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'getOfferIcon']); ?>",
            data: data,
            success: function(response) {
                if (response.success) {
                    $("#offer_icon_block").html(response.icon);
                }
            },
            error: function(error) {}
        });
    }

    function showOrHideDivs() {

        // if ($("input[name='link_offer']").val() == "1") {
        //     $('.link_offer_block').fadeIn();
        //     $('#link').prop('required', true);
        // } else {
        //     $('.link_offer_block').fadeOut();
        //     $('#link').prop('required', false);

        // }
        // if ($("input[name='code_offer']").val() == "1") {
        //     $('.code_offer_block').fadeIn();
        //     $('#code').prop('required', true);
        // } else {
        //     $('.code_offer_block').fadeOut();
        //     $('#code').prop('required', false);
        // }
        if ($("input[name='link_offer']").prop("checked")) {
            $('.link_offer_block').fadeIn();
            $('#link').prop('required', true);
        } else {
            $('.link_offer_block').fadeOut();
            $('#link').prop('required', false);

        }
        if ($("input[name='code_offer']").prop("checked")) {
            $('.code_offer_block').fadeIn();
            $('#code').prop('required', true);
        } else {
            $('.code_offer_block').fadeOut();
            $('#code').prop('required', false);
        }
    }

    function updatePreview() {
        getOfferIcon();
        showOrHideDivs();
        if ($("#title").val()) {
            $("#title_preview").text($("#title").val());
        }
        if ($("#sod").val()) {
            $("#description_preview").text($("#sod").val());
        }
        if ($("#start_date").val()) {
            $("#start_date_preview").text("─ Starts: " + $("#start_date").val());
        } else {
            $("#start_date_preview").text("");
        }
        if ($("#stop_date").val()) {
            $("#stop_date_preview").text(" - Ends: " + $("#stop_date").val());
        } else {
            $("#stop_date_preview").text("");
        }
        // $('#condition_preview').attr('title', $("#conditions").val());
        if ($("#conditions").val()) {
            $('#condition_preview').attr('data-original-title', $("#conditions").val());
        }
        if ($("input[name='birthday']").prop("checked")) {
            $("#offer_type").text("birthdays");
        } else if ($("input[name='anniversary']").prop("checked")) {
            $("#offer_type").text("anniversaries");
        } else {
            $("#offer_type").text("special offers");

        }
    }

    $(document).ready(function() {
        // var picker = $.SRCore.components.SRRangeDatepicker.init('.js-range-datepicker2');

        jQuery(document).on('keyup', '.offer_control', function(e) {
            e.preventDefault();
            updatePreview();
        });


        jQuery(document).on('change', '.offer_control', function(e) {
            e.preventDefault();
            updatePreview();
        });


        setTimeout(function() {
            updatePreview();
        }, 2000);

    });
</script>