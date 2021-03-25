<?php $this->assign('title', 'Top ' . (!empty($search_term) ? $search_term . " in " . (!empty($city) ? $city->name . ', ' . strtoupper($city->state->code) : '') : 'Businesses') . " - Updated regularly"); ?>
<?php $this->Paginator->setTemplates($this->Custom->paginatorTemplatesFrontend()); ?>
<!-- Explore CSS -->
<link rel="stylesheet" href="<?= $this->Url->build('/', ['fullBase' => true]); ?>assets/css/explore.css">
<?= $this->element('search_page_css') ?>
<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main">
    <div class="container-fluid">
        <div class="row">
            <!-- 1st column -->
            <div class="col-lg-5 col-md-5 col-12 js-scrollbar height-86vh">
                <div class="sidebar-none-columns mt-5 p-2">

                    <?php if (!empty($sponsoredListings)) { ?>
                        <h5 class="bold">Sponsored Results &nbsp;&nbsp;<span data-toggle="popover" data-html="true" data-placement="top" data-trigger="hover" data-content="<span class='small'>A business owner paid for this ad. For more information visit our business center.</span>"><i class="fa fa-info-circle" aria-hidden="true"></i></span></h5>

                        <?php foreach ($sponsoredListings as $data_key2 => $business2) : ?>
                            <?= $this->element('search_result_business', ['business' => $business2, 'data_key' => $data_key2, 'sponsored' => true]) ?>
                        <?php endforeach; ?>

                    <?php } ?>

                    <?php if (!empty($search_term)) { ?>
                        <h5 class="bold">Suggestions for
                            <?= !empty($search_term) ? $search_term . "" : "" ?>
                            <?php //echo str_replace("-", " ", $what); 
                            ?>
                            <span class="font-weight-normal"><?= (!empty($city) ?  "in " . $city->name . ', ' . strtoupper($city->state->code) : '') ?></span>

                        </h5><!-- Icon Blocks Section -->
                    <?php } else { ?>
                        <h5 class="bold">Top Businesses <?= (!empty($city) ? "in " . $city->name . ', ' . strtoupper($city->state->code) : '') ?></h5>
                    <?php } ?>
                    <div class="container space-top-1">
                        <div class="row">
                            <div class="col-md-4 font-size-11">

                                <?php if (!empty($filters)) { ?>
                                    <a href="#searchFilterModal" data-modal-target="#searchFilterModal" class="opensearchfilter">
                                        <span class="mdi mdi-sort-variant"></span> Filters
                                    </a> |
                                    <a href="<?= $this->Url->build(['controller' => "Search", 'action' => 'index', '?' => ['find' => $search_term, 'location' => (!empty($city) ? $city->name . "-" . $city->state->code : '')]]); ?>">Clear </a>
                                <?php } ?>
                            </div>
                            <!-- <div class="col-md-7">
                                <div class=" btn-group">
                                    <button type="button" class="borderlt btn btn-light btn-xs">$</button>
                                    <button type="button" class="borderlt btn btn-light btn-xs">$$</button>
                                    <button type="button" class="borderlt btn btn-light btn-xs">$$$</button>
                                    <button type="button" class="borderlt btn btn-light btn-xs">$$$$</button>
                                </div>
                            </div> -->
                            <div class="col-md-8">
                                <div class="text-right">

                                    <span class="mb-0 font-size-11">
                                        <?= $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total') ?>
                                    </span>

                                </div>
                            </div>

                            <!--<div style="width:760px" id="basicDropdownClick" class="dropdown-menu dropdown-unfold pt-3 pl-2 pr-2 border-top" aria-labelledby="basicDropdownClickInvoker">-->

                        </div>
                    </div>

                    <!-- End Icon Blocks Section -->
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="mb-0 explore-layout" style="width:100%;">
                            <div class="position-relative">


                            </div>

                        </span>

                        <!--<span class="mb-0 mr-1">-->
                        <!--	<span class="mb-0 font-size-12">-->
                        <?php
                        // if (count($data) > 0) {
                        // 	echo 'Showing ' . ($limit * ($page-1) + 1) . '-' . ($limit * ($page-1) + count($data)) . ' of ' . $total_count;
                        // } else {
                        // 	echo 'Showing 0';
                        // }
                        ?>
                        <!--	</span>-->
                        <!--</span>-->
                    </div>
                    <div class="mt-0 mr-3">
                        <hr> <!-- Reviews -->
                        <?php $map_data = []; ?>
                        <?php if (!$empty_result) : ?>
                            <?php
                            $maxpage = $total_count / $limit;
                            // $page = $page;
                            $total_count = $total_count;
                            foreach ($businesses as $data_key => $business) : ?>
                                <?= $this->element('search_result_business', ['business' => $business, 'data_key' => $data_key]) ?>
                            <?php endforeach; ?>
                        <?php else : /************************if no records found************************/ ?>
                            <div class='no_records_found'>
                                <div id='SVGheroSectionBg' class='svg-preloader position-relative gradient-half-primary-v3'>
                                    <div class='container space-2'>
                                        <div class='row align-items-lg-center'>
                                            <div class='col-lg-5 mb-7 mb-lg-0'>
                                                <!-- Info -->
                                                <h2 class='mb-4'>Sorry-we couldn't <span class='text-primary font-weight-semi-bold'>find</span> what you're
                                                    looking for...</h2>

                                                <!-- End Info -->
                                            </div>

                                            <div class='col-lg-7'>
                                                <!-- SVG Icon -->
                                                <figure class='ie-we-have-an-idea'>
                                                    <img class='js-svg-injector' src='<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/we-have-an-idea.svg' alt='Image Description' data-parent='#SVGheroSectionBg'>
                                                </figure>
                                                <!-- End SVG Icon -->
                                            </div>
                                        </div>
                                    </div>

                                    <!-- SVG Background -->
                                    <figure class='position-absolute right-0 bottom-0 left-0'>
                                        <img class='js-svg-injector' src='<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/wave-1-bottom-sm.svg' alt='Image Description' data-parent='#SVGheroSectionBg'>
                                    </figure>
                                    <!-- End SVG Background Section -->
                                </div>
                                <!-- End Hero Section -->
                                <div class='pl-8'>
                                    <h5 class='bold'>Suggestions for improving the results:</h5>
                                    <li>Clear the search filters.</li>
                                    <li>Try a different location.</li>
                                    <li>Check the spelling or try alternate spellings.</li>
                                    <li>Try a more general search such as (pizza, coffee, restaurants)</li><br>
                                    Is localinspire missing a business? <a href="<?= $this->Url->build(['controller' => "Businesses", 'action' => 'add']); ?>">Tell us more about it.</a><BR>

                                    <a href="<?= $this->Url->build(['controller' => "Search", 'action' => 'index', '?' => ['find' => $search_term, 'location' => (!empty($city) ? $city->name . "-" . $city->state->code : '')]]); ?>">Clear all Filters.</a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <!-- End Likes/Reply -->
                    </div>
                    <!-- End Reviews -->
                    <!--***************************PAGINATION start here********************-->


                    <!-- <center>
						
					</center> -->
                    <!--***************************PAGINATION end here********************-->
                    <div class="row">
                        <div class="offset-md-1 col-md-11">

                            <nav class="d-flex justify-content-between align-items-center" aria-label="Page navigation example">
                                <ul class="pagination">
                                    <?= $this->Paginator->first('<< ' . __('First')) ?>
                                    <?= $this->Paginator->prev('< ' . __('Previous')) ?>
                                    <?= $this->Paginator->numbers() ?>
                                    <?= $this->Paginator->next(__('Next') . ' >') ?>
                                    <?= $this->Paginator->last(__('Last') . ' >>') ?>
                                </ul>
                                <!-- <small class="text-muted"><?= $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total') ?></small> -->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 2nd column -->
            <div class="col col-md-7">

                <div id="map" class="map-columns pad2"></div><iframe width="100%" height="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=801 E Moore Ave, Terrell, TX 75160&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><!---
                <script src="https://maps.google.com/maps/api/js?sensor=false&key=AIzaSyCBcWbATo8-nsIYdQuGxm_QeZdtTMBjuwU" type="text/javascript"></script>--->
                <script>
                    var map_data = '<?=
                                        //$this->Custom->getVarJson(($business ?? []))
                                        !empty($businesses) ?  str_replace('\'', '\\\'', json_encode($businesses)) : json_encode([]);
                                    ?>';
                    // console.log(map_data);


                    window.map = new google.maps.Map(document.getElementById('map'), {
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });

                    var infowindow = new google.maps.InfoWindow();

                    var bounds = new google.maps.LatLngBounds();
                    var default_logo = '<?= $this->Url->build('/assets/img/new_map_icon3.png', ['fullBase' => true]); ?>';
                    var icon_lable = 0;
                    for (i = 0; i < map_data.length; i++) {
                        // var map_data[i] = map_data[i];
                        icon_lable = map_data[i]['id'];
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(map_data[i]['latitude'], map_data[i]['longitude']),
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
                                    '<div><img class="u-avatar square-img55 mr-3" src="' + map_data[i]['photo'] + '" alt="Image Description" style="float:left;"><div style="width:300px;"><a class="bold" href="' +
                                    map_data[i]['website'] + '"> ' + map_data[i]['name'] +
                                    '</a><br/>' + map_data[i]['categories'][0]['name'] +
                                    '<br>' + map_data[i]['erqwerwer'] + '</div></div>');
                                infowindow.open(map, marker);
                            }
                        })(marker, i));
                    }

                    // console.log(bounds);
                    // map.fitBounds(bounds);
                    // console.log(window.map.getZoom());
                    var listener = google.maps.event.addListener(map, "idle", function() {
                        // console.log(map.getZoom(10));
                        if (map.getZoom() > 18) map.setZoom(18);
                        google.maps.event.removeListener(listener);
                    });
                </script>

            </div>
        </div>

    </div>

</main>
<!-- ========== END MAIN CONTENT ========== -->

<!-- ========== SECONDARY CONTENTS ========== -->
<script>
    // $(document).ready(function() {

    var queryUrl = "<?= $this->Url->build($this->request->getRequestTarget(), ['fullBase' => true]); ?>";
    var checkboxes = [];
    var inputs = {};
    var ranges = {};
    var rmjs;
    // var rmjs = new Readmore('.filtergrid');

    function addToRanges(data) {
        // console.log(data);
        // console.log(data.input[0].attributes.filtername.value);

        var fname = data.input[0].attributes.filtername.value;
        if (fname) {
            ranges[fname] = data.from + "-" + data.to;
        }

        // console.log(ranges);
        const entries = Object.entries(ranges);
        for (const [key, value] of entries) {
            queryUrl = updateQueryString("range-" + key.replace("&", "and"), value, queryUrl);
        }
        // console.log(queryUrl);
    }


    $(function() {
        // document.addEventListener('custombox:overlay:complete', function() {
        //     // Overlay completed

        // });

        document.addEventListener('custombox:content:open', function() {
            // Overlay opened

        });



        jQuery(document).on('focus', '.timerange', function(e) {

            $(this).daterangepicker({
                timePicker: true,
                timePicker24Hour: false,
                timePickerIncrement: 1,
                timePickerSeconds: false,
                locale: {
                    format: 'h:mm A'
                }
            }).on('show.daterangepicker', function(ev, picker) {
                picker.container.find(".calendar-table").hide();
            }).on('cancel.daterangepicker', function(ev, picker) {
                //do something, like clearing an input
                $(this).val('');
            });

        });

        // $('input[name=filter]').change(function() {
        $('.filtercontrol').change(function() {
            // console.log($(this).val());
            // return;
            var value = $(this).val();

            var filtername = $(this).data('filtername');
            // value = value.replace(/-/g, "_");
            // filtername = filtername.replace(/-/g, "_");

            // console.log($(this).attr('type'));
            // console.log(filtername);

            var type = $(this).attr('type') ? $(this).attr('type') : $(this).data('type');


            if (type == "text" || type == "number") {
                // inputs.filtername = value;
                inputs[filtername] = value;
            }

            if (type == "checkbox") {
                if ($(this).is(':checked')) {
                    if (filtername) {
                        checkboxes.push(filtername);
                    }
                } else {
                    if (filtername) {
                        var index = checkboxes.indexOf(filtername);
                        if (index > -1) {
                            checkboxes.splice(index, 1);
                        }
                    }
                }
            }

            // console.log(inputs);
            // console.log(checkboxes);


            const entries = Object.entries(inputs);
            for (const [key, value] of entries) {
                queryUrl = updateQueryString(key.replace("&", "and"), value, queryUrl);
            }
            console.log(queryUrl);

            var filterStr = "";
            checkboxes.forEach(function(item, index) {
                filterStr += item.replace("&", "and") + ',';
            });

            String.prototype.reverse = function() {
                return this.split('').reverse().join('');
            };
            String.prototype.replaceLast = function(what, replacement) {
                return this.reverse().replace(new RegExp(what.reverse()), replacement.reverse()).reverse();
            };

            filterStr = filterStr.replaceLast(',', '');
            console.log(filterStr.replace(new RegExp(',' + '$'), ''));
            queryUrl = updateQueryString("filters", filterStr, queryUrl);
            console.log(queryUrl);

        });


        var ranges = {};
        $.SRCore.components.SRRangeSlider.init('.js-range-slider', {
            onFinish: function(data) {
                addToRanges(data);
            }
        });


        $('#researchform').submit(function(e) {
            e.preventDefault();
            window.location = queryUrl;
            // console.log(encodeURI(queryUrl));
            // console.log($('#researchform').serialize());
            // window.location = $(this).attr('action') + "?" + $('#researchform').serialize();
            // $('#researchform').submit();
        });



        // $('.timerange').daterangepicker({
        //     timePicker: true,
        //     startDate: moment().startOf('hour'),
        //     endDate: moment().startOf('hour').add(32, 'hour'),
        //     locale: {
        //         format: 'M/DD hh:mm A'
        //     }
        // });
    });


    $(document).ready(function() {
        var searchFilterModal = new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#searchFilterModal'
                // target: '#reportownerModal'
            }
        });

        jQuery(document).on('click', '.opensearchfilter', function(e) {
            e.preventDefault();
            // alert("yeah");
            // Custombox.modal.closeAll();
            // rmjs.destroy();

            searchFilterModal.open();

            setTimeout(function() {
                rmjs = new Readmore('.filtergrid', { //https://github.com/jedfoster/Readmore.js/tree/version-3.0
                    speed: 500,
                    collapsedHeight: 250,
                    blockCSS: 'display: block; width: 100%; margin-bottom:10px;  z-index:999999999999; ',
                    lessLink: '<a href="#">Close</a>',
                    moreLink: '<a href="#">Show more</a>'
                });


            }, 1500);

        });


    });
    //     marker.addListener('mouseover', function() {
    //     infowindow.open(map, this);
    // });
</script>

<?php if (!empty($filters)) { ?>
    <!-- Search Filter Modal Window -->
    <?= $this->element('search_filter_modal') ?>
    <!-- End Search Filter Modal Window -->

<?php } ?>