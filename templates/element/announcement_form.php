<!-- class="js-validate" adding this, disables html validation-->
<?= $this->Form->create($announcement, ['class' => '', 'enctype' => 'multipart/form-data', 'id' => 'announcement_form']) ?>
<h4 class="bold">Announcements for your business</h4>
<div class="infobox mb-4"> Attract more customers with announcements! Give them a reason to visit and keep coming back when your business is slow.</div>


<div class="form-group mb-4">
    <label class="bold mb-0" for="at">Announcement title</label>
    <div class="mb-2 txt-12lt text-graylt">This field is required.</div>
    <!-- <input type="email" class="form-control" id="at" placeholder="Your announcement title"> -->
    <?= $this->Form->control('title', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control announcement_control', 'placeholder' => 'Your announcement title', 'required', 'id' => 'title']) ?>
</div>

<div class="form-group">
    <label class="bold mb-0" for="da">Describe your Anouncement <span class="small">420 characters left</span></label>
    <div class="mb-2 txt-12lt text-graylt">Tell us about your announcement, entice people to want to know more. (No links, phone numbers, or extra caps allowed)</div>
    <?= $this->Form->control('description', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control announcement_control', 'placeholder' => 'Tonight only... Falling-off-the-bone rotisserie chicken comes compliments of the wood-burning spit at this festive Caribbean eatery on Glendale...', 'required', "rows" => "3", 'id' => 'description']) ?>
    <!-- <textarea class="form-control" id="da" rows="3" placeholder="Tonight only... Falling-off-the-bone rotisserie chicken comes compliments of the wood-burning spit at this festive Caribbean eatery on Glendale..."></textarea> -->

</div>


<div class="form-group">
    <label class="bold mb-0" for="calltoactiontext">Call to Action Text <span class="small">(29 of 25 characters)</span> </label>
    <div class="mb-2 txt-12lt text-graylt">This field is required for your link button</div>
    <!-- <input type="email" class="form-control" id="Get it now!" placeholder="Get it now!"> -->
    <?= $this->Form->control('cta', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control announcement_control', 'placeholder' => 'Get it now!', 'id' => "cta"]) ?>
</div>


<div class="form-group">
    <label class="bold mb-0" for="link">Link to your desired location</label>
    <div class="mb-2 txt-12lt text-graylt">Do you have a link that tells more about this announcement? Leave blank if no link is available.</div>
    <!-- <input type="email" class="form-control" id="link" placeholder="http://www.mysite.com/linktoannouncement"> -->
    <?= $this->Form->control('link', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control announcement_control', 'placeholder' => 'http://www.mysite.com/linktoannouncement', 'type' => "url", "id" => "link"]) ?>
</div>



<div class="bold mt-3 mb-2">Set your dates</div>
<div class="mb-2 txt-12lt text-graylt">Announcements should be used to announce special events happing at your business, set dates only for the days of the events.</div>
<div class="row mb-4">
    <div class="col-md-6 mb-1">

        <!-- Datepicker -->
        <div id="datepickerWrapperFrom" class="u-datepicker input-group u-form">
            <div class="input-group-prepend u-form__prepend">
                <span class="input-group-text u-form__text">
                    <span class="fas fa-calendar-alt u-form__text-inner"></span>
                </span>
            </div>
            <!-- <input class="js-range-datepicker2 form-control bg-transparent rounded-right" type="text" placeholder="Start Date" aria-label="Start Date" data-rp-wrapper="#datepickerWrapperFrom" data-rp-date-format="d/m/Y"> -->
            <?= $this->Form->control('start_date', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'datepicker form-control bg-transparent rounded-right announcement_control', 'placeholder' => 'Start Date', 'type' => "text", "id" => "start_date", "aria-label" => "Start Date", "data-rp-wrapper" => "#datepickerWrapperFrom", "data-rp-date-format" => "d/m/Y", "value" => $this->Custom->dateFromTimestamp($announcement->start_date, "d/m/Y")]) ?>
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
            <!-- <input class="js-range-datepicker2 form-control bg-transparent rounded-right" type="text" placeholder="Stop Date" aria-label="Stop Date" data-rp-wrapper="#datepickerWrapperstop" data-rp-date-format="d/m/Y"> -->
            <?= $this->Form->control('stop_date', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'datepicker form-control bg-transparent rounded-right announcement_control', 'placeholder' => 'Stop Date', 'type' => "text", "id" => "stop_date", "aria-label" => "Stop Date", "data-rp-wrapper" => "#datepickerWrapperstop", "data-rp-date-format" => "d/m/Y", "value" => $this->Custom->dateFromTimestamp($announcement->stop_date, "d/m/Y")]) ?>
        </div>
        <!-- End Datepicker -->
    </div>
</div>



<div class="custom-control custom-checkbox mt-3">
    <!-- <input type="checkbox" class="custom-control-input" id="stylishCheckbox"> -->

    <?= $this->Form->checkbox('active', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'custom-control-input', $announcement->active == false ? '' : 'checked' => "checked", "id" => "stylishCheckbox"]) ?>
    <label class="custom-control-label" for="stylishCheckbox">
        Checking this box makes this announcement live on your listing, and means you agree to the guidelines.
    </label>
</div>



<div class="mt-5 mb-3 bold">How your announcement will look</div>


<div class="card pt-3 pl-3 pr-3 pb-0">

    <!-- Special Offer -->
    <div>
        <!-- Business Owner -->
        <div class="media mb-3">
            <img class="u-avatar rounded-circle mr-3" src="<?= !empty($active_business->user) ?  $this->Custom->getDp($active_business->user->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">

            <div class="media-body align-self-center">
                <h4 class="d-inline-block mb-0">
                    <a class="d-block h6 mb-0 bold" href="#"><span id="title_preview">Tonight Only!</span></a>
                </h4>
                <span class="d-block txt-12lt text-graylt">Announcement from <?= $active_business->business_role->name ?> of <a class="bold" href="#"><?= $active_business->name ?></a>.</span>
            </div>

            <div class="media-body text-right">
                <small class="d-block"><a href="#" target="_blank" class="btn btn-sm bold btn-recommend" id="cta_link"><span id="cta_preview">More Information</span></a></small>
            </div>
        </div>
        <!-- End Business Owner -->

        <p id=""><span id="description_preview">10/13/2019Tonight only... Falling-off-the-bone rotisserie chicken comes compliments of the wood-burning spit at this festive Caribbean eatery on Glendale...</span> <span id="start_date_preview">10/13/2019</span><span id="stop_date_preview">10/13/2019</span> </p>

    </div>
    <!-- End Special Offer -->
</div>
<div class="mt-6">
    <!-- <label class="control-label"></label>
    <input class="btn btn-sm btn-primary bold" type="button" value="Save Announcement"> -->

    <?= $this->Form->button(__('Save Announcement'), ['type' => 'submit', 'value' => "Save Announcement", 'class' => 'btn btn-sm btn-primary bold', 'style' => '']); ?>
</div>
<?= $this->Form->end() ?>



<script>
    $().popover({
        container: 'body'
    })

    function updatePreview() {
        $("#title_preview").text($("#title").val());
        $("#description_preview").text($("#description").val());
        $("#cta_preview").text($("#cta").val());
        $("#cta_link").attr('href', $("#link").val());
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
    }

    $(document).ready(function() {
        // var picker = $.SRCore.components.SRRangeDatepicker.init('.js-range-datepicker2');

        jQuery(document).on('keyup', '.announcement_control', function(e) {
            e.preventDefault();
            updatePreview();
        });


        jQuery(document).on('change', '.announcement_control', function(e) {
            e.preventDefault();
            updatePreview();
        });


        setTimeout(function() {
            updatePreview();
        }, 2000);
        // picker.config.onChange.push(function(selectedDates, dateStr) {
        //     console.log("changed");
        // });

        // initialization of custom select
        $('.js-select').selectpicker();
        $("[rel='tooltip']").tooltip();

        $('.thumbnail').hover(
            function() {
                $(this).find('.caption').slideDown(250); //.fadeIn(250)
            },
            function() {
                $(this).find('.caption').slideUp(250); //.fadeOut(205)
            }
        );
    });
</script>