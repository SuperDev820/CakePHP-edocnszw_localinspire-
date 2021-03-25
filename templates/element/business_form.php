<?php echo $this->Form->create($business, ['id' => 'biz_form', 'class' => 'js-validate form form-horizontal', 'enctype' => 'multipart/form-data']) ?>


<h5 class="h5 bold pb-2">General Information</h5>

<!-- Listing Form -->
<div class="row mb-2">
    <div class="col-md-12">
        <!-- Input -->
        <div class="js-form-message mb-4">
            <label class="bold">
                Business Name
                <span class="text-danger">*</span>
            </label>
            <?= $this->Form->control('name', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Enter text', 'autocomplete' => 'off', 'required']) ?>
        </div>
        <!-- End Input -->
    </div>

    <div class="col-md-6">
        <!-- Input -->
        <div class="js-form-message mb-4">
            <label class="bold">
                Contact Name <span class="text-danger">*</span>
            </label>
            <?= $this->Form->control('contact_name', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'e.g John Smith', 'autocomplete' => 'off', 'required']) ?>

        </div>
        <!-- End Input -->
    </div>
    <div class="col-md-6">
        <div class="js-form-message mb-4">
            <label class="bold">
                Email <span class="text-danger">*</span>
            </label>
            <?= $this->Form->control('email', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Please enter your business email', 'autocomplete' => 'off', 'required']) ?>
        </div>
    </div>

    <div class="w-100"></div>

    <div class="col-md-6">
        <!-- Input -->
        <div class="js-form-message mb-4">
            <label class="bold">
                Phone <span class="text-danger">*</span>
            </label>
            <?= $this->Form->control('phone', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control',  "placeholder" => "1-1800-123-4567", 'autocomplete' => 'off', 'required']) ?>
        </div>
        <!-- End Input -->
    </div>
    <div class="col-md-6">

        <!-- Input -->
        <div class="js-form-message mb-4">
            <label class="bold">
                Fax
            </label>
            <?= $this->Form->control('fax', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Please enter your fax number', 'autocomplete' => 'off']) ?>
        </div>
        <!-- End Input -->
    </div>

    <div class="w-100"></div>

    <div class="col-md-12">
        <!-- Input -->
        <div class="js-form-message mb-4">
            <label class="bold">
                Website
            </label>

            <?= $this->Form->control('website', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Please enter your business website', 'autocomplete' => 'off',]) ?>

        </div>
        <!-- End Input -->
    </div>

    <div class="w-100"></div>



    <div class="col-md-12">
        <!-- Input -->
        <div class="js-focus-state form-group mb-4">
            <label class="bold">
                Facebook
            </label>
            <div class="input-group">
                <div id="dribbleProfileLabel" class="input-group-prepend">
                    <span class="input-group-text">https://facebook.com/</span>
                </div>

                <?= $this->Form->control('facebook_link', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Facebook link', 'autocomplete' => 'off',]) ?>
            </div>
            <span class="text-graylt">Add your Facebook profile name (e.g.
                localinspire)</span>
        </div>
        <!-- End Input -->
    </div>

    <div class="col-md-12">
        <!-- Input -->
        <div class="js-focus-state form-group mb-4">
            <label class="bold">
                Twitter
            </label>
            <div class="input-group">
                <div id="twitterProfileLabel" class="input-group-prepend">
                    <span class="input-group-text">https://twitter.com/</span>
                </div>
                <?= $this->Form->control('twitter_link', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Twitter link', 'autocomplete' => 'off']) ?>

            </div>
            <span class="text-graylt">Add your Twitter username (e.g. localinspire)</span>
        </div>
        <!-- End Input -->
    </div>

    <div class="col-md-12">
        <!-- Input -->
        <div class="js-focus-state form-group mb-4">
            <label class="bold">
                Linkedin
            </label>
            <div class="input-group">
                <div id="twitterProfileLabel" class="input-group-prepend">
                    <span class="input-group-text">https://linkedin.com/</span>
                </div>
                <?= $this->Form->control('linkedin_link', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'LinkedIn link', 'autocomplete' => 'off',]) ?>

            </div>
            <span class="text-graylt">Add your Linkedin username (e.g.
                localinspire)</span>
        </div>
        <!-- End Input -->
    </div>

    <div class="col-md-12">
        <!-- Input -->
        <div class="js-form-message js-focus-state form-group mb-2">
            <label class="bold">
                About Business <span class="text-danger">*</span>
            </label>
            <?= $this->Form->control('about', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Tell us something more about this business.', 'autocomplete' => 'off', "data-msg" => "Please enter your business description.", "data-error-class" => "u-has-error", "data-success-class" => "u-has-success", "required"]) ?>

        </div>
        <!-- End Input -->
    </div>

</div><style>.formheight</style>

<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
        <hr>
        <h4 class="h5 bold">Location</h4>
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 form-group mb-4">
                <label class="bold" for="address">Street address <span class="text-danger">*</span></label>
                <?= $this->Form->control('address', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control ', "style" => "height: 40px", 'placeholder' => '12505 E Northwest Hwy', 'autocomplete' => 'off', "required"]) ?>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 form-group mb-4">
                <label class="bold" for="additional_address">Additional address information</label>
                <?= $this->Form->control('additional_address', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Street number, intersection, plaza, square', 'autocomplete' => 'off']) ?>
                <span class="help" id="editmsg7"></span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-xs-12 col-md-12 form-group">
                <label class="bold" for="State">State/Province <span class="text-danger">*</span></label>
                <?= $this->Form->control('state_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $states, 'empty' => true, 'label' => false, "id" => "state_id", 'class' => 'select2 state_select', "style" => "width: 100%", 'required', 'default' => (!empty($business->city) ? $business->city->state_id : (!empty($currentUser->city) ? $currentUser->city->state_id : ''))]); ?>
                <span class="help" id="editmsg9"></span>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12 col-md-12 form-group mb-4">
                <div id="citydiv"></div>
                <span class="help" id="editmsg8"></span>
            </div>

        </div>
        <div class="row">

            <div class="col-md-6">
                <!-- Input -->
                <div class="js-form-message mb-4">
                    <label class="bold">
                        Zip/Postal Code <span class="text-danger">*</span>
                    </label>
                    <?= $this->Form->control('zip', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => '90706', 'autocomplete' => 'off', 'required', "type" => "text", "pattern" => "\d*", "maxlength" => "6", "minlength" => "4"]) ?>

                </div>
                <!-- End Input -->
            </div>

            <div class="col-md-6">
                <label class="bold" for="State">Country</label>
                <select name="country" id="country" class="form-control userinput">
                    <option value="US" selected>United States</option>
                </select>
                <span class="help" id="editmsg11"></span>
            </div>
        </div>


        <!-- Title -->
        <div class="mb-4">
            <h4 class="h5 bold">Location on Google Map</h4>
        </div>
        <!-- End Title -->

        <!-- Listing Form -->
        <div class="row mb-2">

            <div class="col-md-6">
                <!-- Input -->
                <div class="js-form-message mb-3">
                    <label class="bold">
                        Latitude:
                    </label>
                    <?= $this->Form->control('latitude', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => '', 'autocomplete' => 'off', 'required', 'readonly' => "readonly", 'value' => $currentLocation['lat']]) ?>


                </div>
                <!-- End Input -->
            </div>
            <div class="col-md-6">
                <!-- Input -->
                <div class="js-form-message mb-3">
                    <label class="bold">
                        Longitude:
                    </label>
                    <?= $this->Form->control('longitude', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control', 'placeholder' => '', 'autocomplete' => 'off', 'required', 'readonly' => "readonly", 'value' => $currentLocation['long']]) ?>

                </div>
                <!-- End Input -->
            </div>
            <div class="col-12 mb-4">
                <small class="text-muted mb-1">MAP COORDINATES (DRAG THE MAP TO ADJUST PIN)</small>
                <div id="googleMap" class="rounded" style="width:100%;height:300px;"></div>
            </div>
            <!-- End Input -->
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label class="bold" for="sic2category_id">SIC2 Category <span class="text-danger">*</span></label>
                <?= $this->Form->control('sic2category_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $sic2categories, 'empty' => true, 'label' => false, 'id' => 'sic2category_id', 'required', 'class' => 'form-control select2', "style" => "width: 100%", 'default' => $business->sic2category_id]); ?>
                <span class="help" id=""></span>
            </div>
        </div>
        <div id="sic4div">

        </div>

        <div id="sic8div">

        </div>



        <!-- <div class="row">
            <div class="col-md-12 form-group">
                <label class="bold" for="categories._ids">Main Category <span class="text-danger">*</span></label>
                <?php //echo $this->Form->control('categories._ids', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $categories, 'empty' => true, 'label' => false, 'id' => 'categories_select', 'required', 'class' => 'form-control categories_select', "style" => "width: 100%", 'default' => !empty($business->categories) ? $business->categories : null]); 
                ?>
                <span class="help" id=""></span>
            </div>
        </div> -->


        <div class="">
            <h2 class="h6 bold">Open hours <span class="text-danger">*</span></h2>
        </div>
        <div class="container-flude hour_schedule">
            <?php
            if (!empty($business->business_hours)) {

                foreach ($business->business_hours as $hour) {
            ?>
                    <div class="row one_schedule">
                        <div class="col-md-3 mb-1 mb-md-0 ">
                            <div class="input-group-pill mb-1 bold day"><?= $hour->day->name ?></div>
                        </div>
                        <div class="col-md-4 mb-1 mb-md-0">
                            <div class="input-group-pill mb-1 fromto"><?= $hour->opening_time ?> &nbsp;-&nbsp; <?= $hour->closing_time ?></div>
                            <input type="hidden" name="hours[<?= $hour->day_id ?>][opening_time]" value="<?= $hour->opening_time ?>">
                            <input type="hidden" name="hours[<?= $hour->day_id ?>][closing_time]" value="<?= $hour->closing_time ?>">
                        </div>
                        <div class="col-md-4 mb-1 mb-md-0">
                            <a class="remove" href="javascript:;">Remove</a>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3 mb-md-0">
                <div class="input-group mb-2">
                    <?= $this->Form->control('day_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => $days, 'empty' => false, 'label' => false, 'class' => 'form-control', "id" => "hday", "style" => "width: 100%"]); ?>
                </div>
            </div>

            <div class="col-md-3 mb-3 mb-md-0">
                <div class="input-group mb-2">
                    <select class="form-control" id="hstart_time">
                        <?php
                        $time = strtotime('00:00');
                        $step = 30;
                        for ($i = 0; $i < 48; $i++) {
                            $next = $step * $i;
                            $startTime = date("g:i a", strtotime('+' . $next . ' minutes', $time));
                            $select = ($startTime == "9:00 am") ? " selected" : "";
                            if ($startTime == "12:00AM") {
                                $add_text = " (midnight)";
                            } elseif ($startTime == "12:00PM") {
                                $add_text = " (noon)";
                            } else {
                                $add_text = "";
                            }

                        ?>
                            <option value="<?= $startTime ?>" <?= $select ?>>
                                <?= $startTime ?><?= $add_text ?>
                            </option>
                        <?php
                        }
                        ?>

                    </select>
                </div>
            </div>
            <div class="col-md-3 mb-3 mb-md-0">
                <div class="input-group mb-2">
                    <select class="form-control" id="hend_time">
                        <?php
                        $time = strtotime('00:30');
                        $step = 30;
                        for ($i = 0; $i < 60; $i++) {
                            $next = $step * $i;
                            $startTime = date("g:i a", strtotime('+' . $next . ' minutes', $time));
                            $select = ($startTime == "6:00 pm") ? " selected" : "";
                            if ($i < 47 && $startTime == "12:00AM") {
                                $add_text = " (midnight)";
                            } elseif ($i < 47 && $startTime == "12:00PM") {
                                $add_text = "(noon)";
                            } elseif ($i >= 47 && $startTime == "12:00AM") {
                                $add_text = " (midnight next day)";
                            } elseif ($i > 47) {
                                $add_text = " (next day)";
                            } else {
                                $add_text = "";
                            }
                        ?>
                            <option value="<?= $startTime ?>" <?= $select ?>>
                                <?= $startTime ?><?= $add_text ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>


            <div class="col-md-3 mb-3 mb-md-0">
                <div class="input-group-pill mb-2">
                    <button class="btn  btn-soft-secondary" type="button" onClick="add_hours();">Add
                        Hours</button>
                </div>
            </div>

            <div class="w-100 mt-3"></div>

        </div>
        <?php
        $business->is_closed_move = "";
        $move_business_name = "";
        $move_near = "";
        $close_till_date = "";
        if (isset($business['is_closed_move']) && $business['is_closed_move'] != null) {
            $is_closed_arr = explode("-", $business['is_closed_move']);
            $business->is_closed_move = $is_closed_arr[0];
            if ($business->is_closed_move == "0") {
            } elseif ($business->is_closed_move == "1") {
                $move_business_name = explode("@", $is_closed_arr[1])[0];
                $move_near = explode("@", $is_closed_arr[1])[1];
            } elseif ($is_close_move == "2") {
                $close_till_date = $is_closed_arr[1];
            }
        }
        ?>
        <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" class="custom-control-input" id="business_move_closed" name="is_closed_move" value="1" <?= $business->is_closed_move != "" ? " checked" : "" ?>>
            <label class="custom-control-label mb-2" for="business_move_closed">
                Business Closed or Moved
            </label>
            <div class="collapse <?= $business->is_closed_move != "" ? " show" : "" ?>" id="business_closed_collapse">
                <div class="custom-control custom-radio mb-2">
                    <input type="radio" id="Permanently" name="business_closed_move" value="0" class="custom-control-input" <?= ($business->is_closed_move == "" || $business->is_closed_move == "0") ? " checked" : "" ?>>
                    <label class="custom-control-label" for="Permanently">Permanently Closed</label>
                </div>
                <div class="custom-control custom-radio mb-2">
                    <input type="radio" id="Moved" name="business_closed_move" value="1" class="custom-control-input" <?= ($business->is_closed_move == "1") ? " checked" : "" ?>>
                    <label class="custom-control-label" for="Moved">Moved to New Location</label>
                </div>
                <div class="container collapse <?= ($business->is_closed_move == "1") ? " show" : "" ?>" id="move_new_location">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-3">
                                <label class="">
                                    Business Name
                                </label>

                                <?= $this->Form->control('move_business_name', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control',  "data-msg" => "Enter new location", "data-error-class" => "u-has-error", "data-success-class" => "u-has-success", 'id' => 'move_business_name', 'placeholder' =>  "", 'autocomplete' => 'off', ($business->is_closed_move  == "1" ? 'required' : '')]) ?>


                            </div>
                            <!-- End Input -->
                        </div>
                        <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-3">
                                <label class="">
                                    Near
                                </label>
                                <?= $this->Form->control('move_near', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control',  "data-msg" => "Enter new location", "data-error-class" => "u-has-error", "data-success-class" => "u-has-success", 'id' => 'move_near', 'placeholder' =>  "", 'autocomplete' => 'off', ($business->is_closed_move  == "1" ? 'required' : '')]) ?>


                            </div>
                            <!-- End Input -->
                        </div>
                        <!-- End Input -->
                    </div>
                </div>


                <div class="custom-control custom-radio mb-2">
                    <input type="radio" id="Temporarily" name="business_closed_move" value="2" class="custom-control-input" <?= ($business->is_closed_move == "2") ? " checked" : "" ?>>
                    <label class="custom-control-label" for="Temporarily">Temporarily Closed</label>
                </div>
                <div class="container collapse <?= ($business->is_closed_move == "2") ? " show" : "" ?>" id="temporarily_collapse">
                    <div class="row mb-2">
                        <div class="col-md-6" id="date_container">
                            <!-- Input -->
                            <div class="js-form-message mb-3">
                                <label class="">
                                    Closed Until <input class="form-control" id="close_till_date" name="close_till_date" value="<?= $business->close_till_date ?>" placeholder="" style="padding:0 10px; height:36px;" autocomplete="off" data-msg="Select date" data-error-class="u-has-error" data-success-class="u-has-success" aria-label="" <?= ($business->is_closed_move == "2") ? " required" : "" ?>>
                                </label>


                            </div>
                            <!-- End Input -->
                        </div>

                    </div>
                    <script>
                        $('#close_till_date').datepicker({
                            autoclose: true,
                            container: '#date_container'
                        });
                    </script>

                </div>
            </div>
        </div>

        <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" class="custom-control-input" id="duplicated" name="is_duplicate" value="1" <?= ($business['is_duplicate'] != null && $business['is_duplicate'] != "") ? " checked" : "" ?>>
            <label class="custom-control-label mb-2" for="duplicated">
                This is a duplicate of another business on LocalInspire
            </label>
        </div>


        <div class="row">
            <div class="col-md-12 form-group mb-4">
                <div id="subcatdiv">

                </div>
                <span class="help" id="editmsg8"></span>
            </div>

        </div>

        <hr>
        <div class="mt-5 mb-4 d-flex justify-content-between">
            <!-- Buttons -->
            <button type="submit" class="btn btn-sm btn-primary bold mr-1">Save
                Changes</button>

            <!-- End Buttons -->
        </div>
        <div class="alert alert-warning business_noti col-md-12 mt-3  mb-3" style="display: none;">
            <span class="text-dark"><b>Thank you</b> for sharing what you know about this place! We’ll review your add or edits as soon as possible and let you know when they have been accepted.</span>
        </div>
    </div>
</div>

<?= $this->Form->end() ?>


<script>
    var days_num = parseInt("<?= !empty($business->business_hours) ? count($business->business_hours) : '0' ?>")

    function add_hours() {
        if (days_num >= 7) {
            return false;
        }
        days_num++;
        var day_index = parseInt($('#hday').val());
        // var day = $('#hday').data('value');
        // var day = $('#hday option:selected').data('dval');
        var day = $('#hday option:selected').val();
        var day_text = $('#hday option:selected').text();
        var start_time = $('#hstart_time').val();
        var end_time = $('#hend_time').val();
        var html = '<div class="row one_schedule"><div class="col-md-3 mb-1 mb-md-0 ">'
        html += '<div class="input-group-pill mb-1 bold day" >' + day_text + '</div></div>';
        html += '<div class="col-md-4 mb-1 mb-md-0"><div class="input-group-pill mb-1 fromto"  >' + start_time +
            " &nbsp;-&nbsp; " + end_time + '</div> ';
        // html += '<input type="hidden" name="business_hours[]" value="' + day + "_" + start_time + "_" + end_time + '" />';
        // html += '<input type="hidden" name="business_hours['+day+']" value="' + day + "_" + start_time + "_" + end_time + '" />';
        html += '<input type="hidden" name="hours[' + day + '][opening_time]" value="' + start_time + '" />';
        html += '<input type="hidden" name="hours[' + day + '][closing_time]" value="' + end_time + '" />';
        html += '</div><div class="col-md-4 mb-1 mb-md-0"><a class="remove" href="javascript:;"  >Remove</a></div></div>';

        day_index++;
        day_index = (day_index + 7) % 7;

        $('#hday').val((day_index > 0 ? day_index : 7));

        $('.hour_schedule').append(html);
    }

    $('.hour_schedule').on('click', '.remove', function() {
        var parent = $(this).parents('.one_schedule');
        $(parent).remove();
        days_num--;
        // console.log(parent);
    })
    jQuery(document).on('change', 'input[id=business_move_closed]', function(e) {
        if ($(this).is(':checked')) {
            $('#business_closed_collapse').collapse('show');
        } else {
            $('#business_closed_collapse').collapse('hide');
        }
    })
    jQuery(document).on('change', 'input[name=business_closed_move]', function(e) {
        if ($(this).val() == "1") {
            $('#move_new_location').collapse('show');
            $('#temporarily_collapse').collapse('hide');
            $('input[name=move_business_name]').attr('required', true);
            $('input[name=move_near]').attr('required', true);
            $('input[name=close_till_date]').attr('required', false);
        } else if ($(this).val() == "2") {
            $('#temporarily_collapse').collapse('show');
            $('#move_new_location').collapse('hide');
            $('input[name=move_business_name]').attr('required', false);
            $('input[name=move_near]').attr('required', false);
            $('input[name=close_till_date]').attr('required', true);
        } else {
            $('#temporarily_collapse').collapse('hide');
            $('#move_new_location').collapse('hide');
            $('input[name=move_business_name]').attr('required', false);
            $('input[name=move_near]').attr('required', false);
            $('input[name=close_till_date]').attr('required', false);
        }
    })

    var map;
    var marker;
    var infoWindow;
    var $city = $('select[name=city_id]');
    var $state = $('select[name=state_id]');
    var $zip = $('input[name=zip]');
    var $country = $('select[name=country]');
    var $address = $('input[name=address]');
    var $add_address = $('input[name=additional_address]');
    var latitude = "<?= $currentLocation['lat'] ?>";
    var longitude = "<?= $currentLocation['long'] ?>";

    var city = "";

    jQuery(document).on('change', '.city_select', function(e) {
        //var selections = ( JSON.stringify($(this).select2('data')) );
        // var selected_state_id = $(this).select2('val');
        // console.log($(this).select2('text'));

        city = $(this).find(':selected').text();
        geocodePosition();

    });
    // $city.change(function() {

    // });
    $state.change(function() {
        geocodePosition();
    });
    $zip.change(function() {
        geocodePosition();
    });
    $address.change(function() {
        geocodePosition();
    });

    function geocodePosition() {


        // $('input[name=latitude]').val("");
        // $('input[name=longitude]').val("");
        // var city = $city.text();
        // var state = $state.text();
        // var city = $city.find("option:selected").text()
        var state = $state.find("option:selected").text();
        var zip = $zip.val();
        var address = $address.val();

        if (!city || !state || !zip || !address) return false;
        var full_address = address + ", " + city + ", " + state + " " + zip;
        console.log(full_address);
        geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            address: full_address
        }, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {

                var lat = results[0].geometry.location.lat();
                var lng = results[0].geometry.location.lng();
                console.log(lat);
                console.log(lng);
                $('input[name=latitude]').val(lat);
                $('input[name=longitude]').val(lng);
                marker.setMap(null);
                var myLatlng = new google.maps.LatLng(lat, lng);
                marker = new google.maps.Marker({
                    draggable: false,
                    position: myLatlng,
                    map: map,
                    title: "Your Business"
                });
                map.setCenter(myLatlng);
            } else {
                console.log("invalid address");
            }
        });

    }

    function myMap() {
        if (!latitude && !longitude) {
            var myLatlng = new google.maps.LatLng(32.7360, -96.2753);
        } else {
            var myLatlng = new google.maps.LatLng(latitude, longitude);
        }
        var myOptions = {
            zoom: 14,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById("googleMap"), myOptions);

        marker = new google.maps.Marker({
            draggable: false,
            position: myLatlng,
            map: map,
            title: "Your Business"
        });
        infoWindow = new google.maps.InfoWindow({
            content: "Your Business Address"
        });
        google.maps.event.addListener(marker, 'dragend', function(event) {
            document.getElementById("lat").value = event.latLng.lat();
            document.getElementById("long").value = event.latLng.lng();
            infoWindow.open(map, marker);
            geocodePosition();
        });

    }



    function getSubcategories(sic4category_id, selected_subcategories = null) {

        if (sic4category_id) {

            $('#subcatdiv').fadeOut();

            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'getFilters']); ?>",
                data: {
                    sic4category_id: sic4category_id,
                    selected_subcategories: selected_subcategories,
                    business_id: "<?= !empty($business) ? $business->id : '' ?>",
                },
                method: "post",
                success: function(response) {
                    $('#subcatdiv').html(response);
                    $('#subcatdiv').fadeIn("slow", function() {
                        // $('.selectpicker').selectpicker('destroy');
                        $('.subcategories_select').select2({
                            placeholder: 'Select one or more subcategories',
                            theme: "classic"
                            // theme: "bootstrap4"
                        });
                    });


                },
                error: function(error) {
                    console.log(error);
                }
            });

        }

    }

    function getSic4categories(sic2category_id) {
        if (sic2category_id) {
            $('#sic4div').fadeOut();
            $('#sic8div').fadeOut();

            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'getSic4categories']); ?>",
                data: {
                    sic2category_id: sic2category_id,
                    business_id: "<?= $business->id ?>",
                },
                method: "post",
                success: function(response) {
                    $('#sic4div').html(response);
                    $('#sic4div').fadeIn("slow", function() {
                        // $('.selectpicker').selectpicker('destroy');
                        $('#sic4category_id').select2({
                            placeholder: 'Select an option',
                            theme: "classic"
                            // theme: "bootstrap4"
                        });

                        setTimeout(function() {
                            getSic8categories($('#sic4category_id').select2('val'));
                            getSubcategories($('#sic4category_id').select2('val'), $('.subcategories_select').select2('val'));
                        }, 1000);

                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });

        }

    }

    function getSic8categories(sic4category_id) {
        if (sic4category_id) {
            $('#sic8div').fadeOut();

            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'getSic8categories']); ?>",
                data: {
                    sic4category_id: sic4category_id,
                    business_id: "<?= $business->id ?>",
                },
                method: "post",
                success: function(response) {
                    $('#sic8div').html(response);
                    $('#sic8div').fadeIn("slow", function() {
                        // $('.selectpicker').selectpicker('destroy');
                        $('#sic8category_id').select2({
                            placeholder: 'Select an option',
                            theme: "classic"
                            // theme: "bootstrap4"
                        });

                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });

        }

    }


    $(document).ready(function() {


        jQuery(document).on('change', '#sic2category_id', function(e) {

            //var selections = ( JSON.stringify($(this).select2('data')) );
            var sic2category_id = $(this).select2('val');
            // var selected_categories = $(this).select2('val');
            // var selected_subcategories = $('.subcategories_select').select2('val');
            //console.log(selected_subcategories);
            getSic4categories(sic2category_id);

        });


        setTimeout(function() {
            getSic4categories($('#sic2category_id').select2('val'));
        }, 2000);

        jQuery(document).on('change', '#sic4category_id', function(e) {

            //var selections = ( JSON.stringify($(this).select2('data')) );
            var sic4category_id = $(this).select2('val');
            var selected_subcategories = $('.subcategories_select').select2('val');
            //console.log(selected_subcategories);
            getSubcategories(sic4category_id, selected_subcategories);
            getSic8categories(sic4category_id);

        });


        $('#biz_form').on('submit', function(e) {
            e.preventDefault();
            if (!$(this).valid()) return false;
            if (loggedIn) {
                $('#biz_form').unbind('submit').submit();
            } else {
                $('.signuphide').hide();
                $(".loginn").trigger('click');
                isBizForm = true;
            }
        });

    });
</script>
<!-- Map JS (Please change the API key below. Read documentation for more info) -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRa91l5ZUbyWuMHzKFLAwSS7_OS5gntpo&callback=myMap" async defer></script>